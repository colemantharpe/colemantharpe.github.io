<?php
namespace Kiosk\Library;


/**
 * Class AvePublishingAccess
 * @package Kiosk\Library
 * Require mCrypt extension
 * @see http://www.php.net/manual/fr/book.mcrypt.php
 */
class AvePublishingAccess {

    function __construct() {
        $this->_loadConf();
    }

    public function send($data) {
        return $this->_send($data);
    }

    protected function _send($data) {
        $device_id      = '3';
        $version        = '10';
        $app_certificate = CERT_BUNDLE_ID;
		$pat = $data->pattern;
		$ser = $data->service;
		$debug = isset($data->debug);
		$locale = isset($data->locale) ? $data->locale : "fr";

        if (!isset($data->uid) || empty($data->uid)) {
            $data->uid = "undefined";
        }

        $data->appCertificate = $app_certificate;
        $data->version        = $version;
        $data->deviceId       = $device_id;

        $data = json_encode($data);

        $pub_key = openssl_get_publickey(CERT_SERVER_CERT_X509);
        openssl_seal($data, $crypted, $env_key, array($pub_key));
        openssl_free_key($pub_key);

        $app_pkey = openssl_get_privatekey(CERT_APP_PKEY);
        openssl_private_encrypt(md5($crypted), $crypt, $app_pkey);
        openssl_free_key($app_pkey);

        $data_package          = new \stdClass();
        $data_package->crypt   = base64_encode($crypt);
        $data_package->crypted = base64_encode($crypted);
        $data_package->envKey  = base64_encode($env_key[0]);

        $data_package = base64_encode(json_encode($data_package));

        $data = array(
                'locale'         => $locale,
                'deviceId'       => $device_id,
                'data'           => $data_package,
                'appCertificate' => CERT_BUNDLE_ID,
                'version'        => $version
        );

        $curl = curl_init(CERT_URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

        // debug : Logging queries
        if ($debug) {
			error_log('######################################################');
			error_log($pat.' / '.$ser);
			error_log(http_build_query($data));
			error_log('######################################################');
		}

        $header   = array();
        $header[] = 'Content-type: application/x-www-form-urlencoded';
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($curl);
        curl_close($curl);

        return $this->_read($result);
    }


    protected function _read( $response) {
        $data = json_decode( $response);

        if(is_null($data)) {
            $this->_error('No Data');
            return false;
        }

        if (isset($data->data) && is_object($data->data)) {
            $crypted = base64_decode($data->data->seal->crypted);
            $env_key = base64_decode($data->data->seal->envKey);
            $crypt   = base64_decode($data->data->crypt);

            $pub_key = openssl_get_publickey(CERT_SERVER_CERT_X509);
            openssl_public_decrypt($crypt, $crypt_free, $pub_key);
            openssl_free_key($pub_key);

            if (md5($crypted) == $crypt_free) {
                $app_pkey = openssl_get_privatekey(CERT_APP_PKEY);
                if (openssl_open($crypted, $crypted_free, $env_key, $app_pkey)) {
                    $data->data = json_decode($crypted_free);
                    return $data;
                } else {
                    $this->_error('Decrypts fail');
                }
                openssl_free_key($app_pkey);
            } else {
                $this->_error('Signature fail');
            }
        } else {
            return $data;
        }

        return false;
    }

    /**
     * Raise an HTTP 500 error
     * @param $string
     */
    protected function _error($string) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        echo $string;
    }


    public function parseResult($data) {
        if (!is_null($data) && is_object($data) && !is_null($data->result) && !is_null($data->result->status)) {
            $error  = true;
            $result = null;
            switch ($data->result->status) {
                case "0":
                    $error  = false;
                    $result = $data->data;
                    break;
                case "1":
                    $result = "No connection.";
                    break;
                case "2" :
                    $result = "Session already exists.";
                    break;
                case "3" :
                    $result = "No session.";
                    break;
                case "4" :
                    $result = "User session already exists.";
                    break;
                case "5" :
                    $result = "Bad parameters.";
                    break;
                case "6" :
                    $result = "Bad application.";
                    break;
                case "7" :
                    $result = "Server error.";
                    break;
                case "101" :
                    $result = "Database error.";
                    break;
                case "102" :
                    $result = "Action failed.";
                    break;
                case "103" :
                    $result = "Missing fields.";
                    break;
                case "104" :
                    $result = "Timeout.";
                    break;
                case "105" :
                    $result = "Malformed data.";
                    break;
                case "201" :
                    $result = "No server connection.";
                    break;
                case "202" :
                    $result = "Bad login.";
                    break;
                case "203" :
                    $result = "Invalid login.";
                    break;
                case "204" :
                    $result = "Invalid password.";
                    break;
                case "205" :
                    $result = "Login already used.";
                    break;
                case "206" :
                    $result = "User creation failed.";
                    break;
                case "309" :
                    $result = "Issue not aquired.";
                    break;
                case "1000" :
                    $result = "Unknown error.";
                    break;
            }

            if ($error) {
                Debug::log($data);
                Debug::log($result);
                Debug::log($_REQUEST);

                return false;
            } else {
                return $result;
            }
        } else {
            if ($data === false) {
                return false;
            } else {
                Debug::log("Malformed result data : ");
                Debug::log($data);
            }
        }
    }

    /**
     * Load configuration from certificate.php
     * If the file is missing, generate it from certificate.aveapp
     */
    protected function _loadConf() {
        $certificateFolder = __DIR__ . '/../certificates/';

        $generatedCertificate = $certificateFolder . 'certificate.php';
        $pathRebuild = $certificateFolder . 'build-certificate.php';
        if( file_exists( $pathRebuild)) {

            // Write the "certificate.php" file
            $this->_writeConf();

            // Remove the "build-certificate.php" file
            unlink( $pathRebuild);
        }

        require_once( $generatedCertificate);
    }

    /**
     * Generate the "certificate.php" file from the "certificate.aveapp" file
     * @throws \Exception if the file cannot be written
     */
    protected function _writeConf() {
        $certificateFolder      = __DIR__ . '/../certificates/';
        $generatedCertificate   = $certificateFolder . 'certificate.php';

        /// Load content of aveapp file and parse it
        $domSrc = file_get_contents( $certificateFolder . 'certificate.aveapp');
        $dom    = new \DomDocument();
        $dom->loadXML($domSrc);

        $url             = '';
        $bundle_id       = '';
        $server_cert     = '';
        $application_key = '';

        /// Check and save coreUrl
        $access = $dom->getElementsByTagName('access');
        if ($access->length > 0) {
            $access = $access->item(0);
            $core   = $access->getElementsByTagName('coreUrl');
            if ($core->length > 0) {
                $core = $core->item(0);
                $url  = $this->_decrypt_aes(base64_decode($core->nodeValue));
            }
        }

        /// Check and save bundleId
        $app = $dom->getElementsByTagName('applicationDetails');
        if ($app->length > 0) {
            $app    = $app->item(0);
            $bundle = $app->getElementsByTagName('bundleId');
            if ($bundle->length > 0) {
                $bundle    = $bundle->item(0);
                $bundle_id = $this->_decrypt_aes(base64_decode($bundle->nodeValue));
            }
        }

        /// Check and save serverKey
        $server = $dom->getElementsByTagName('serverKey');
        if ($server->length > 0) {
            $server      = $server->item(0);
            $server_cert = $this->_decrypt_aes(base64_decode($server->nodeValue));
        }

        /// Check and save applicationKey
        $appli = $dom->getElementsByTagName('applicationKey');
        if ($appli->length > 0) {
            $appli           = $appli->item(0);
            $application_key = $this->_decrypt_aes(base64_decode($appli->nodeValue));
        }

        $config = '<?php' . PHP_EOL;
        $config .= 'define("CERT_URL"               , "' . addslashes( trim( $url)) . '");' . PHP_EOL;
        $config .= 'define("CERT_BUNDLE_ID"         , "' . addslashes( trim( $bundle_id)) . '");' . PHP_EOL;
        $config .= 'define("CERT_SERVER_CERT_X509"  , "' . addslashes( trim( $server_cert)) . '");' . PHP_EOL;
        $config .= 'define("CERT_APP_PKEY"          , "' . addslashes( trim( $application_key)) . '");' . PHP_EOL;

        /// Write the certificate.php file
        $isWritten = file_put_contents( $generatedCertificate, $config);
        if( false === $isWritten){
            throw new \Exception( "Unable to write file $generatedCertificate (Check rights - The folder should be writable by the WebServer user (eg: www-data))");
        }
    }

    /**
     * Decrypt the content of an aveapp node
     * @param string $pData The encoded content
     * @return string The decoded content
     * @todo Mcrypt extension is deprecated since PHP 7.1. Use openSSL
     */
    protected function _decrypt_aes($pData) {
        $cle_taille = mcrypt_module_get_algo_key_size(MCRYPT_RIJNDAEL_128);
        $iv_size    = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $iv         = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $key        = "ceciestlaclemaisjepensequeelleestbeaucouptroplonguepourpasser";
        $key        = substr($key, 0, $cle_taille);
        $dcrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $pData, MCRYPT_MODE_ECB, $iv);

        return $dcrypttext;
    }

}
