
PayPal PHP ButtonManager SDK
===============================

Prerequisites
-------------

PayPal's PHP ButtonManager SDK requires 

 * PHP 5.2 and above with curl extension enabled
  

Using the SDK
-------------

To use the SDK, 

* Copy the config and lib folders into your project.
* Make sure that the lib folder in your project is available in PHP's include path
* Include the services\PayPalAPIInterfaceService\PayPalAPIInterfaceServiceService.php file in your code.
* Create a service wrapper object
* Create a request object as per your project's needs. All the API request and response classes are available in services\PayPalAPIInterfaceService\PayPalAPIInterfaceServiceService.php
* Invoke the appropriate method on the request object.


For example,

	require_once('services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');	require_once('PPLoggingManager.php');

    $buttonSearchRequest = new BMButtonSearchRequestType();
	$buttonSearchRequest->Version = 86.0;
	
	$buttonSearchReq = new BMButtonSearchReq();
	$buttonSearchReq->BMButtonSearchRequest = $buttonSearchRequest;
	......

	$paypalService = new PayPalAPIInterfaceServiceService();
	$buttonSearchResponse = $paypalService->BMButtonSearch($buttonSearchReq);
	
	$ack = strtoupper($buttonSearchResponse->Ack);
 
	if($ack == 'SUCCESS') {
		// Success
	}
  
 

SDK Configuration
-----------------

replace the API credential in config/sdk_config.ini . You can use the configuration file to configure

 * (Multiple) API account credentials.
 * Service endpoint and other HTTP connection parameters 


Please refer to the sample config file provided with this bundle.
