<!doctype html>
<?php
$identifier = $_POST["identifier"];
$old = $_POST["password1"];
$new = $_POST["password2"];
$data = array("old" => "$old", "new" => "$new");
			  
$url ="http://34.203.6.144//spf/v20/user/{$identifier}/password/change";
			  
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($array));
curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type:application/x-www-form-urlencoded',                                                                                
    'Accept:application/json'));
curl_setopt($curl, CURLOPT_HEADER, true);
$result = curl_exec($curl);
if(curl_errno($curl)){
    echo 'Request Error:' . curl_error($curl);
}
?>

<html ng-app="aqf.webkiosk" aqf-config="config">
<head>
<meta charset="UTF-8">
	<title ng-bind="config.meta.title"></title>
	<meta name="description" content="{{config.meta.description}}">
	<meta name="author" content="{{config.meta.author}}">
	<link rel="stylesheet" href="styles/vendor.css">
	<link rel="stylesheet" href="styles/styles.css">
</head>

<body>
	<div aqf-config="forgotPasswordController.kioskConfig">
	<div class="logo-forgot-password text-center">
		<img ng-src="{{forgotPasswordController.kioskConfig.meta.logo}}">
	</div>
	<div class="awk-forgot-password">
		<div class="forgot-password-header">
			<h1 translate="forgotpassword.forgotpassword"></h1>
		</div>
		<div class="forgot-password-content">
			<div class="messages">
				<h3>The server returned the code <?php if(curl_errno($curl)){
    echo 'Request Error:' . curl_error($curl);}?><br>
					The password has been changed for the account <?php echo $_POST["identifier"]; ?><br>
					Your old password is: <?php echo $_POST["password1"] ?><br>
					The new password is <?php echo $_POST["password2"]; ?></h3>
				 
			</div>
		</div>
		<div class="login-footer ng-scope" ng-if="authComponentController.kioskConfig.authConfig.showCreateAccount ||
		 authComponentController.kioskConfig.authConfig.showForgotPassword" style="text-align: center; padding-bottom: 10px"><strong>
			<a href="#//" translate="forgotpassword.home">Home</strong></a> | <a class="ng-scope" ui-sref="forgotPassword" ng-if="authComponentController.kioskConfig.authConfig.showForgotPassword" href="#//forgot-password"><strong class="ng-scope" translate="authComponent.forgotPassword">Forgot Password?</strong></a>
		</div>
	</div>
	</div>
Welcome <?php echo $_POST["identifier"]; ?><br>
Your old password is: <?php echo $_POST["password1"] ?><br>
Your new password is: <?php echo $_POST["password2"]; ?>
</body>
</html>
