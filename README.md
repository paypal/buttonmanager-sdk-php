# PayPal PHP ButtonManager SDK

## Migrating from 3.x to 4.x

We have made a change to 4.x to make it compatible with other PayPal Classic SDKs.

- Change references from `\PayPal\Service\PayPalAPIInterfaceServiceService` to `\PayPal\Service\ButtonManagerService`.

## Prerequisites

PayPal's PHP ButtonManager SDK requires:

   * PHP 5.3 and above
   * curl/openssl PHP extensions
 
## Running the sample

To run the bundled sample, first copy the samples folder to your web server root. You will then need to install the SDK as a dependency using either composer (PHP v5.3+ only).

run `composer update` from the samples folder.

## Using the SDK

To use the SDK,

   * Create a composer.json file with the following contents.
```json
{
    "name": "me/shopping-cart-app",
    "require": {
        "paypal/buttonmanager-sdk-php": "4.*"
    }
}
```

   * Install the SDK as a dependency using composer.
   * Require `vendor/autoload.php` in your application.
   * Choose how you would like to configure the SDK - You can either:
      * Create a hashmap containing configuration parameters and pass it to the service object, OR
      * Create a `sdk_config.ini` file and set the PP_CONFIG_PATH constant to point to the directory where this file exists.
   * Instantiate a service wrapper object and a request object as per your project's needs.
   * Invoke the appropriate method on the service object.

For example,

```php
    // Sets config file path(if config file is used) and registers the classloader
    require("PPBootStrap.php");
    
    use PayPal\PayPalAPI\BMButtonSearchReq;
    use PayPal\PayPalAPI\BMButtonSearchRequestType;
    use PayPal\Service\ButtonManagerService;
    
    // Array containing credentials and confiuration parameters. (not required if config file is used)
    $config = array(
       'mode' => 'sandbox',
       'acct1.UserName' => 'jb-us-seller_api1.paypal.com',
       'acct1.Password' => 'WX4WTU3S8MY44S7F',
       "acct1.Signature" => "AFcWxV21C7fd0v3bYYYRCpSSRl31A7yDhhsPUU2XhtMoZXsWHFxu-RWy"
       .....
    );
    
    $buttonSearchReq = new BMButtonSearchReq();
    $buttonSearchReq->BMButtonSearchRequest = new BMButtonSearchRequestType();
    ......
    
    $buttonManagerService = new ButtonManagerService($config);
    $buttonSearchResponse = $buttonManagerService->BMButtonSearch($buttonSearchReq);
    
    if(strtoupper($buttonSearchResponse->Ack) == 'SUCCESS') {
        // Success
    }
```

## Authentication

The SDK provides multiple ways to authenticate your API call.

```php
    use PayPal\Auth\PPCertificateCredential;
    use PayPal\Auth\PPTokenAuthorization;
    
    $buttonManagerService = new ButtonManagerService($config);
    
    // Use the default account (the first account) configured in sdk_config.ini
    $response = $buttonManagerService->BMButtonSearch($buttonSearchReq);
    
    // Use a specific account configured in sdk_config.ini
    $response = $buttonManagerService->BMButtonSearch($buttonSearchReq, 'jb-us-seller_api1.paypal.com');	
    
    // Pass in a dynamically created API credential object
    $cred = new PPCertificateCredential("username", "password", "path-to-pem-file");
    $cred->setThirdPartyAuthorization(new PPTokenAuthorization("accessToken", "tokenSecret"));
    $response = $buttonManagerService->BMButtonSearch($buttonSearchReq, $cred);
```  
 
## SDK Configuration


The SDK allows you to configure the following parameters:

   * Integration mode (`sandbox`/`live`)
   * (Multiple) API account credentials
   * HTTP connection parameters
   * Logging

Dynamic configuration values can be set by passing a map of credential and config values (if config map is passed the config file is ignored)
```php
    $config = array(
       'mode' => 'sandbox',
       'acct1.UserName' => 'jb-us-seller_api1.paypal.com',
       'acct1.Password' => 'WX4WTU3S8MY44S7F'
       .....
    );
    $service  = new ButtonManagerService($config); 
```
Alternatively, you can configure the SDK via the sdk_config.ini file. 
  
```php
    define('PP_CONFIG_PATH', '/directory/that/contains/sdk_config.ini');
    $service  = new ButtonManagerService();
```

You can refer full list of configuration parameters in [wiki](https://github.com/paypal/sdk-core-php/wiki/Configuring-the-SDK) page.

## Instant Payment Notification (IPN)

Please refer to the IPN-README in 'samples/IPN' directory

## POODLE Update
- Because of the Poodle vulnerability, PayPal has disabled SSLv3.
- To enable TLS encryption, the changes were made to [PPHttpConfig.php](https://github.com/paypal/sdk-core-php/blob/master/lib/PayPal/Core/PPHttpConfig.php#L11) in [SDK Core](https://github.com/paypal/sdk-core-php/) to use a cipher list specific to TLS encryption.
``` php
    /**
     * Some default options for curl
     * These are typically overridden by PPConnectionManager
     */
    public static $DEFAULT_CURL_OPTS = array(
        CURLOPT_SSLVERSION => 1,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT        => 60,   // maximum number of seconds to allow cURL functions to execute
        CURLOPT_USERAGENT      => 'PayPal-PHP-SDK',
        CURLOPT_HTTPHEADER     => array(),
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_SSL_VERIFYPEER => 1,
        CURLOPT_SSL_CIPHER_LIST => 'TLSv1',
    );
```
- There are two primary changes done to curl options:
    - CURLOPT_SSLVERSION is set to 1 . See [here](http://curl.haxx.se/libcurl/c/CURLOPT_SSLVERSION.html) for more information
    - CURLOPT_SSL_CIPHER_LIST was set to TLSv1, See [here](http://curl.haxx.se/libcurl/c/CURLOPT_SSL_CIPHER_LIST.html) for more information

## Links

   * API Reference - https://developer.paypal.com/webapps/developer/docs/classic/api/#button-manager
   * If you need help using the SDK, an issue to report, please visit https://github.com/paypal/buttonmanager-sdk-php/issues 
