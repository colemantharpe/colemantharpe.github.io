window.configKiosk={"remoteUrl":"php/kiosk.php","searchApiUrl":"http://rls-cloudconnect.aquafadas.com/search/api/v1/","language":{"locale":"en","availableLocales":["en","fr","es"]},"authConfig":{"forceLogin":true,"showForgotPassword":true,"showCreateAccount":true,"sessionKeyPrefix":"sessionId.","isAnonKeyPrefix":"isAnon.","userIdKeyPrefix":"userId."},"analytics":{"autoPageTrack":true,"vendors":{"google_analytics":{"trackId":"UA-35040354-1","options":{"appName":"defaultAppName"},"map":{"se_banner_click":{"action":"\"se_banner_click\"","category":"\"se_\" + (categoryName ? categoryName : issueName ? titleName + \"_\" + issueName : titleName)","dimension6":"storeModelName","dimension7":"language"},"se_spotlight_click":{"action":"\"se_spotlight_click\"","category":"\"se_\" + (label ? label : spotlightItemReferenceType === \"category\" ? categoryName : spotlightItemReferenceType === \"title\" ? titleName : issueName)","label":"issueName ? \"se_\" + titleName + \"_\" + issueName : undefined","dimension6":"storeModelName","dimension7":"language"},"se_list_click":{"action":"\"se_list_click\"","category":"\"se_\" + listLabel","label":"issueName ? \"se_ti_\" + titleName + \"_\" + issueName : \"se_tt_\" + titleName","dimension6":"storeModelName","dimension7":"language"},"se_list_seeAll":{"action":"\"se_list_seeAll\"","category":"\"se_\" + listLabel","dimension6":"storeModelName","dimension7":"language"},"se_grid_click":{"action":"\"se_grid_click\"","category":"\"se_\" + listLabel","label":"issueName ? \"se_ti_\" + titleName + \"_\" + issueName : \"se_tt_\" + titleName","dimension6":"storeModelName","dimension7":"language"},"se_grid_seeAll":{"action":"\"se_grid_seeAll\"","category":"\"se_\" + listLabel","dimension6":"storeModelName","dimension7":"language"},"se_videoItem_plays":{"action":"\"se_videoItem_plays\"","category":"\"se_\" + videoTitle","label":"\"se_video_\" + videoUrl","dimension6":"storeModelName","dimension7":"language"},"se_featuredItem_click":{"action":"\"se_featuredItem_click\"","category":"\"se_\" + featuredItemId","label":"\"se_\" + itemName","dimension6":"storeModelName","dimension7":"language"},"vl_title_click":{"action":"\"vl_title_click\"","category":"\"tt_\" + titleName"},"va_login":{"action":"\"va_login\"","category":"\"va_account_event\""},"va_logout":{"action":"\"va_logout\"","category":"\"va_account_event\""},"va_skipLogin":{"action":"\"va_skipLogin\"","category":"\"va_account_event\""},"va_signup":{"action":"\"va_signup\"","category":"\"va_account_event\""},"va_signup_success":{"action":"\"va_signup_success\"","category":"\"va_account_event\""},"ks_download":{"action":"\"ks_download\"","category":"\"ti_\" + titleName + \"_\" + issueName","label":"from === \"se_spotlightReference\" ? \"se_spotlightReference\" : undefined","dimension3":"\"full\""},"ks_download_fail":{"action":"\"ks_download_fail\"","category":"\"ti_\" + titleName + \"_\" + issueName","label":"from === \"se_spotlightReference\" ? \"se_spotlightReference\" : undefined","dimension3":"\"full\"","dimension5":"errorType"},"ks_download_success":{"action":"\"ks_download_success\"","category":"\"ti_\" + titleName + \"_\" + issueName","label":"from === \"se_spotlightReference\" ? \"se_spotlightReference\" : undefined","dimension3":"\"full\""},"ks_read":{"action":"\"ks_read\"","category":"\"ti_\" + titleName + \"_\" + issueName","label":"from === \"se_spotlightReference\" ? \"se_spotlightReference\" : undefined","dimension3":"\"full\""},"ks_language_switch":{"action":"\"ks_language_switch\"","category":"\"ks_language_switch_event_\" + language"},"vsh_search_request":{"action":"\"vsh_search_request\"","category":"\"vsh_searchTerms_\" + searchTerms","dimension4":"resultCount"},"vsh_searchResult_click":{"action":"\"vsh_searchResult_click\"","category":"\"ti_\" + titleName + \"_\" + issueName"},"vsh_header_click":{"action":"\"vsh_header_click\"","category":"\"ti_\" + titleName + \"_\" + issueName"},"vsh_article_click":{"action":"\"vsh_article_click\"","category":"\"ti_\" + titleName + \"_\" + issueName"}}},"piwik":{"trackId":"","options":{"siteId":1},"map":{"se_banner_click":{"action":"\"se_banner_click\"","category":"\"se_\" + (categoryName ? categoryName : issueName ? titleName + \"_\" + issueName : titleName)"},"se_spotlight_click":{"action":"\"se_spotlight_click\"","category":"\"se_\" + (label ? label : spotlightItemReferenceType === \"category\" ? categoryName : spotlightItemReferenceType === \"title\" ? titleName : issueName)","label":"issueName ? \"se_\" + titleName + \"_\" + issueName : undefined"},"se_list_click":{"action":"\"se_list_click\"","category":"\"se_\" + listLabel","label":"issueName ? \"se_ti_\" + titleName + \"_\" + issueName : \"se_tt_\" + titleName"},"se_list_seeAll":{"action":"\"se_list_seeAll\"","category":"\"se_\" + listLabel"},"se_grid_click":{"action":"\"se_grid_click\"","category":"\"se_\" + listLabel","label":"issueName ? \"se_ti_\" + titleName + \"_\" + issueName : \"se_tt_\" + titleName"},"se_grid_seeAll":{"action":"\"se_grid_seeAll\"","category":"\"se_\" + listLabel"},"se_videoItem_plays":{"action":"\"se_videoItem_plays\"","category":"\"se_\" + videoTitle","label":"\"se_video_\" + videoUrl"},"se_featuredItem_click":{"action":"\"se_featuredItem_click\"","category":"\"se_\" + featuredItemId","label":"\"se_\" + itemName"},"vl_title_click":{"action":"\"vl_title_click\"","category":"\"tt_\" + titleName"},"va_login":{"action":"\"va_login\"","category":"\"va_account_event\""},"va_logout":{"action":"\"va_logout\"","category":"\"va_account_event\""},"va_skipLogin":{"action":"\"va_skipLogin\"","category":"\"va_account_event\""},"va_signup":{"action":"\"va_signup\"","category":"\"va_account_event\""},"va_signup_success":{"action":"\"va_signup_success\"","category":"\"va_account_event\""},"ks_download":{"action":"\"ks_download\"","category":"\"ti_\" + titleName + \"_\" + issueName","label":"from === \"se_spotlightReference\" ? \"se_spotlightReference\" : undefined"},"ks_download_fail":{"action":"\"ks_download_fail\"","category":"\"ti_\" + titleName + \"_\" + issueName","label":"from === \"se_spotlightReference\" ? \"se_spotlightReference\" : undefined"},"ks_download_success":{"action":"\"ks_download_success\"","category":"\"ti_\" + titleName + \"_\" + issueName","label":"from === \"se_spotlightReference\" ? \"se_spotlightReference\" : undefined"},"ks_read":{"action":"\"ks_read\"","category":"\"ti_\" + titleName + \"_\" + issueName","label":"from === \"se_spotlightReference\" ? \"se_spotlightReference\" : undefined"},"ks_language_switch":{"action":"\"ks_language_switch\"","category":"\"ks_language_switch_event_\" + language"},"vsh_search_request":{"action":"\"vsh_search_request\"","category":"\"vsh_search_event\"","label":"searchTerms"},"vsh_searchResult_click":{"action":"\"vsh_searchResult_click\"","category":"categoryName ? \"cn_\" + categoryName : issueName ? \"ti_\" + titleName + \"_\" + issueName : \"tt_\" + titleName"}}},"localytics":{"trackId":"","map":{"se_banner_click":{"tagEvent":"\"se_banner_click\"","Banner Reference":"\"se_\" + (categoryName ? categoryName : issueName ? titleName + \"_\" + issueName : titleName)"},"se_spotlight_click":{"tagEvent":"\"se_spotlight_click\"","Spotlight Item Name":"\"se_\" + (label ? label : spotlightItemReferenceType === \"category\" ? categoryName : spotlightItemReferenceType === \"title\" ? titleName : issueName)","Issue":"issueName ? \"se_\" + titleName + \"_\" + issueName : undefined"},"se_list_click":{"tagEvent":"\"se_list_click\"","List Name":"\"se_\" + listLabel","Clicked Item Name":"issueName ? \"se_ti_\" + titleName + \"_\" + issueName : \"se_tt_\" + titleName"},"se_list_seeAll":{"tagEvent":"\"se_list_seeAll\"","List Name":"\"se_\" + listLabel"},"se_grid_click":{"tagEvent":"\"se_grid_click\"","List Name":"\"se_\" + listLabel","Clicked Item Name":"issueName ? \"se_ti_\" + titleName + \"_\" + issueName : \"se_tt_\" + titleName"},"se_grid_seeAll":{"tagEvent":"\"se_grid_seeAll\"","List Name":"\"se_\" + listLabel"},"se_videoItem_plays":{"tagEvent":"\"se_videoItem_plays\"","Video Item ID":"\"se_\" + videoTitle","Video URL":"\"se_video_\" + videoUrl","Video Name":"videoName"},"se_featuredItem_click":{"tagEvent":"\"se_featuredItem_click\"","Featured Item ID":"\"se_\" + featuredItemId","Clicked Item ID":"\"se_\" + itemName"},"vl_title_click":{"tagEvent":"\"vl_title_click\"","Title Clicked":"titleName"},"va_login":{"tagEvent":"\"va_login\""},"va_logout":{"tagEvent":"\"va_logout\""},"va_skipLogin":{"tagEvent":"\"va_skipLogin\""},"va_signup":{"tagEvent":"\"va_signup\""},"va_signup_success":{"tagEvent":"\"va_signup_success\""},"ks_download":{"tagEvent":"\"ks_download\"","Title":"titleName","Issue":"issueName","Downloaded From":"from","Content Type":"\"fullIssue\""},"ks_download_fail":{"tagEvent":"\"ks_download_fail\"","Title":"titleName","Issue":"issueName","Error type":"errorType","Downloaded From":"from"},"ks_download_success":{"tagEvent":"\"ks_download_success\"","Title":"titleName","Issue":"issueName","Downloaded From":"from"},"ks_read":{"tagEvent":"\"ks_read\"","Title":"titleName","Issue":"issueName","Read From":"from","Content Type":"\"full\""},"Content Viewed":{"tagEvent":"\"Localytics Content Viewed\"","Title":"titleName","Issue":"issueName","Content Type":"from === \"detailView\" ? \"detailView\" : \"fullContent\""},"ks_language_switch":{"tagEvent":"\"ks_language_switch\"","Language Chosen":"language"},"vsh_search_request":{"tagEvent":"\"Searched\"","contentType":"","resultCount":"resultCount","Search Terms":"searchTerms"},"vsh_searchResult_click":{"tagEvent":"\"vsh_searchResult_click\"","Issue":"issueName","Title":"titleName","Category":"categoryName"}}}}},"navigation":{"defaultHome":"home","item":[{"name":"Home","key":"home","translate":"navigation.home","enabled":true},{"name":"Titles","key":"titles","translate":"navigation.title","enabled":true},{"name":"Library","key":"library","translate":"navigation.library","enabled":true}],"right":["search","category","language","connection"],"connection":["profile","logout"]},"home":{"storemodelKey":"frontend","storemodelLocale":"fr"},"offline":{"thumbnail":{"height":200,"width":200}},"app":{"access":{"mode":"PREPRODUCTION","coreUrl":"https://stg-cloudconnect.aquafadas.com/kiosk/applicationController.php","portalUrl":"http://stg-cloudconnect.aquafadas.com/www/","mediaUrl":"https://stg-cloudconnect.aquafadas.com/media","kyashuUrl":"https://kyashu.aquafadas.com/wsapi/KyashuDownload.php?service=KS-AvePublishingPreprod"},"applicationDetails":{"uid":"gqqi","bundleId":"com.gmail.wow","name":"wow","iconUrl":"http://stg-cloudconnect.aquafadas.com/kiosk/media/4611686000000000041.png"}},"meta":{"title":"Web Kiosk","author":"Aquafadas","description":"","logo":"assets/images/logo.png"},"theme":{"night":true},"firebase":{"apiKey":"AIzaSyACBtuOwnbDktUQ-p2QAOL59notfqTQAVI","authDomain":"annotations-test.firebaseapp.com","databaseURL":"https://annotations-test.firebaseio.com","storageBucket":"annotations-test.appspot.com","messagingSenderId":"87785425828"},"debug":true,"kioskVersion":"2.7.2"};