PayPal PHP ButtonManager SDK
===============================

Prerequisites
-------------

PayPal's PHP ButtonManager SDK requires 

   * PHP 5.2 and above with curl/openssl extensions enabled
 
Installing the SDK
------------------

   if not using composer 
   
   Run the installation script from buttonmanager-sdk-php/samples directory
   
    curl  https://raw.github.com/paypal/buttonmanager-sdk-php/composer/samples/install.php | php
    
        or 
        
    php install.php
    
   if using composer (PHP V5.3+ only)
   
   Run the following command from the buttonmanager-sdk-php/samples directory and after the installation set the path to config file in PPBootStrap.php, config file is in vendor/paypal/buttonmanager-sdk-php/config/
   
    composer update

Using the SDK
-------------

To use the SDK, 

   * Update the sdk_config.ini with your API credentials.
   * Require "PPBootStrap.php" in your application. [copy it from vendor/paypal/buttonmanager-sdk-php/sample/ if using composer]
   * To run samples
      * Copy samples in [vendor/paypal/buttonmanager-sdk-php/] to root directory and run in browser
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

The SDK allows you to configure 

   * (Multiple) API account credentials.
   * HTTP connection parameters 
   * Logging

You can do this via

   * the `sdk_config.ini` file - You must define a _PP_CONFIG_PATH_ constant pointing to the absolute path where your configuration file resides, OR
   * a dynamic hashmap containing entries in the same format as the ini config file that you pass in to the service object
```php
    $config = array(
       'mode' => 'sandbox',
       'acct1.UserName' => 'jb-us-seller_api1.paypal.com',
       'acct1.Password' => 'WX4WTU3S8MY44S7F'
       .....
    );
    $service  = new PayPalAPIInterfaceServiceService($config); 
```

Please refer to the sample config file provided with this bundle.

Using multiple SDKs together
----------------------------

   * Just add the required sdk names to 'required' section of your composer.json file.


Instant Payment Notification (IPN)
-----------------------------------

refer to the IPN-README in 'samples/IPN' directory

Links
-----

   * API Reference - https://developer.paypal.com/webapps/developer/docs/classic/api/#bm
   * If you need help using the SDK, a new feature that you need or have a issue to report, please visit https://github.com/paypal/buttonmanager-sdk-php/issues 

