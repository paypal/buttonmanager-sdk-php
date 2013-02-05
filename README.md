
PayPal PHP ButtonManager SDK
===============================

Prerequisites
-------------

PayPal's PHP ButtonManager SDK requires 

   * PHP 5.2 and above with curl/openssl extensions enabled
 
Installing the SDK
-------------------
   if not using composer 
   
   run installation script from buttonmanager-sdk-php/samples directory
   
    curl  https://raw.github.com/paypal/buttonmanager-sdk-php/composer/samples/install.php | php
    
        or 
        
    php install.php
    
   if using composer
   
   Run from buttonmanager-sdk-php/samples directory and after the installation set the path to config file in PPBootStrap.php, config file is in vendor/paypal/buttonmanager-sdk-php/config/
   
    composer update

Using the SDK
-------------

To use the SDK, 

   * Update the sdk_config.ini with your API credentials.
   * Require "PPBootStrap.php" in your application. [copy it from vendor/paypal/buttonmanager-sdk-php/sample/ if using composer]
   * To run samples : copy samples in [vendor/paypal/buttonmanager-sdk-php/] to root directory and run in browser
   * To build your own application:
   * Instantiate a service wrapper object.
   * Instantiate a request object as per your project's needs. All the API request and response 
     classes are available in services\PayPalAPIInterfaceService\PayPalAPIInterfaceServiceService.php
   * Invoke the appropriate method on the service object.


For example,

	 //sets config file path and loads all the classes
    require("PPBootStrap.php");

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

Using multiple SDKs together
----------------------------
*add the required sdk names to 'required' section of composer.json
*add the service endpoint to 'config/sdk_config.ini', for the endpoints refer the list below

Endpoint Configuration
---------------------------
*The list below specifies endpoints for different services, in SANDBOX and PRODUCTION, with their 
property keys and end-point as property values.


------------------------------SANDBOX------------------------------  
* Merchant/Button Manager Service (3 Token)  
service.EndPoint.PayPalAPI=https://api-3t.sandbox.paypal.com/2.0  
service.EndPoint.PayPalAPIAA=https://api-3t.sandbox.paypal.com/2.0  

* Merchant/Button Manager Service (Certificate)  
service.EndPoint.PayPalAPI=https://api.sandbox.paypal.com/2.0  
service.EndPoint.PayPalAPIAA=https://api.sandbox.paypal.com/2.0  

* AdaptiveAccounts Platform Service  
service.EndPoint.AdaptiveAccounts=https://svcs.sandbox.paypal.com/  

* AdaptivePayments Platform Service  
service.EndPoint.AdaptivePayments=https://svcs.sandbox.paypal.com/  

* Invoice Platform Service  
service.EndPoint.Invoice=https://svcs.sandbox.paypal.com/  

* Permissions Platform Service  
service.EndPoint.Permissions=https://svcs.sandbox.paypal.com/  

------------------------------PRODUCTION------------------------------  
* Merchant/Button Manager Service (3 Token)  
service.EndPoint.PayPalAPI=https://api-3t.paypal.com/2.0  
service.EndPoint.PayPalAPIAA=https://api-3t.paypal.com/2.0  

* Merchant/Button Manager Service (Certificate)  
service.EndPoint.PayPalAPI=https://api.paypal.com/2.0  
service.EndPoint.PayPalAPIAA=https://api.paypal.com/2.0  

* AdaptiveAccounts Platform Service  
service.EndPoint.AdaptiveAccounts=https://svcs.paypal.com/  

* AdaptivePayments Platform Service  
service.EndPoint.AdaptivePayments=https://svcs.paypal.com/  

* Invoice Platform Service  
service.EndPoint.Invoice=https://svcs.paypal.com/  

* Permissions Platform Service  
service.EndPoint.Permissions=https://svcs.paypal.com/  

For additional information please refer to https://www.x.com/developers/paypal/documentation-tools/api

Instant Payment Notification (IPN)
-----------------------------------
refer to the IPN-README in 'samples/IPN' directory

Getting help
------------

If you need help using the SDK, a new feature that you need or have a issue to report, please visit

   https://www.x.com/developers/paypal/forums/button-manager-api
   
     OR
   
   https://github.com/paypal/buttonmanager-sdk-php/issues 
