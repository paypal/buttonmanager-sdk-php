
PayPal PHP ButtonManager SDK
===============================


This is a "Work in progress" SDK. If you are looking for a ButtonManager SDK, please see 

https://www.x.com/developers/paypal/documentation-tools/paypal-sdk-index#buttonmanagernew

  OR 

https://github.com/paypal/SDKs/tree/master/ButtonManager/buttonmanager-php-sdk



Prerequisites
-------------

PayPal's PHP ButtonManager SDK requires 

   * PHP 5.2 and above with curl/openssl extensions enabled
  

Using the SDK
-------------

To use the SDK, 

   * Copy the config and lib folders into your project. Modify the config file sdk_config.ini to suit your needs.
   * Make sure that the lib folder in your project is available in PHP's include path
   * Include the services\PayPalAPIInterfaceService\PayPalAPIInterfaceServiceService.php 
     file in your code.
   * Instantiate a service wrapper object.
   * Instantiate a request object as per your project's needs. All the API request and response 
     classes are available in services\PayPalAPIInterfaceService\PayPalAPIInterfaceServiceService.php
   * Invoke the appropriate method on the service object.


For example,

	require_once('services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');	require_once('PPLoggingManager.php');

	$buttonSearchReq = new BMButtonSearchReq();
	$buttonSearchReq->BMButtonSearchRequest = new BMButtonSearchRequestType();
	......

	$paypalService = new PayPalAPIInterfaceServiceService();
	$buttonSearchResponse = $paypalService->BMButtonSearch($buttonSearchReq);
	
	$ack = strtoupper($buttonSearchResponse->Ack); 
	if($ack == 'SUCCESS') {
		// Success
	}


The SDK provides multiple ways to authenticate your API call.

	$paypalService = new PayPalAPIInterfaceServiceService();
	
	// Use the default account (the first account) configured in sdk_config.ini
	$response = $paypalService->BMButtonSearch($buttonSearchReq);	

	// Use a specific account configured in sdk_config.inig
	$response = $paypalService->BMButtonSearch($buttonSearchReq, 'jb-us-seller_api1.paypal.com');	
	 
	// Pass in a dynamically created API credential object
    $cred = new PPCertificateCredential("username", "password", "path-to-pem-file");
    $cred->setThirdPartyAuthorization(new PPTokenAuthorization("accessToken", "tokenSecret"));
	$response = $paypalService->BMButtonSearch($buttonSearchReq, $cred);	
  
 

SDK Configuration
-----------------

replace the API credential in config/sdk_config.ini . You can use the configuration file to configure

   * (Multiple) API account credentials.
   * Service endpoint and other HTTP connection parameters 
   * Logging

Please refer to the sample config file provided with this bundle.



Getting help
------------

If you need help using the SDK, a new feature that you need or have a issue to report, please visit

   https://www.x.com/developers/paypal/forums/button-manager-api
   
     OR
   
   https://github.com/paypal/buttonmanager-sdk-php/issues 
