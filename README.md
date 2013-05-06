
# PayPal PHP ButtonManager SDK

## Prerequisites

PayPal's PHP ButtonManager SDK requires 

   * PHP 5.2 and above 
   * curl/openssl PHP extensions 
 
## Running the sample

To run the bundled sample, copy the samples folder to your web server root. You will then need to install the SDK as a dependency using either composer (PHP V5.3+ only) or by running a custom installation script provided with the SDK.


If using composer, run `composer update` from the samples folder. Otherwise, run install.php from buttonmanager-sdk-php/samples directory
   
    curl  https://raw.github.com/paypal/buttonmanager-sdk-php/stable/samples/install.php | php
    
        or 
        
    php install.php


## Using the SDK


To use the SDK,

   * Create a composer.json file and install the SDK as a dependency using composer or the install.php script. You can use the composer.json in the samples folder as a starting point.
   * Require `vendor/autoload.php` OR `PPBootStrap.php` in your application depending on whether you used composer or the custom installer.
   * Choose how you would like to configure the SDK - You can either
      * Create a `sdk_config.ini` file and set the PP_CONFIG_PATH constant to point to the directory where this file exists OR
	  * Create a hashmap containing configuration parameters and pass it to the service object.
   * Instantiate a service wrapper object and a request object as per your project's needs.
   * Invoke the appropriate method on the service object passing in the request object.

For example,

	 //sets config file path and loads all the classes
    require("PPBootStrap.php");

	$buttonSearchReq = new BMButtonSearchReq();
	$buttonSearchReq->BMButtonSearchRequest = new BMButtonSearchRequestType();
	......

	$paypalService = new PayPalAPIInterfaceServiceService();
	$buttonSearchResponse = $paypalService->BMButtonSearch($buttonSearchReq);
	
	if($strtoupper($buttonSearchResponse->Ack) == 'SUCCESS') {
		// Success
	}

## Authentication

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
  
 
## SDK Configuration


The SDK allows you to configure the following using the sdk_config.ini file

   * Integration mode (sandbox / live)
   * (Multiple) API account credentials.
   * HTTP connection parameters
   * Logging 

Alternatively, dynamic configuration values can be set by passing a map of credential and config values (if config map is passed the config file is ignored)
```php
    $config = array(
       'mode' => 'sandbox',
       'acct1.UserName' => 'jb-us-seller_api1.paypal.com',
       'acct1.Password' => 'WX4WTU3S8MY44S7F'
       .....
    );
    $service  = new PayPalAPIInterfaceServiceService($config); 
```

Please refer to the sample config file provided with this bundle for more.

## Instant Payment Notification (IPN)

Please refer to the IPN-README in 'samples/IPN' directory

## Links

   * API Reference - https://developer.paypal.com/webapps/developer/docs/classic/api/#bm
   * If you need help using the SDK, a new feature that you need or have a issue to report, please visit https://github.com/paypal/buttonmanager-sdk-php/issues 