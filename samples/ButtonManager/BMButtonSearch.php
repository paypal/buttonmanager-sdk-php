<?php
use PayPal\PayPalAPI\BMButtonSearchReq;
use PayPal\PayPalAPI\BMButtonSearchRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
require_once('../PPBootStrap.php');

/*
 * The request contains optional fields that are not currently used. All hosted buttons are automatically requested.
 */
$buttonSearchRequest = new BMButtonSearchRequestType();
/*
 * (Required) Starting date for the search. The value must be in UTC/GMT format; for example, 2009-08-24T05:38:48Z. No wildcards are allowed. 
 */
$buttonSearchRequest->StartDate = $_REQUEST['startDate'];
/*
 * (Optional) Ending date for the search. The value must be in UTC/GMT format; for example, 2010-05-01T05:38:48Z. No wildcards are allowed. 
 */
$buttonSearchRequest->EndDate = $_REQUEST['endDate'];

$buttonSearchReq = new BMButtonSearchReq();
$buttonSearchReq->BMButtonSearchRequest = $buttonSearchRequest;

/*
 * 	 ## Creating service wrapper object
Creating service wrapper object to make API call and loading
Configuration::getAcctAndConfig() returns array that contains credential and config parameters
*/
$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
try {
	/* wrap API method calls on the service object with a try catch */
	$buttonSearchResponse = $paypalService->BMButtonSearch($buttonSearchReq);
} catch (Exception $ex) {
	require '../Error.php';
	exit;
}
echo "<table>";
echo "<tr><td>Ack :</td><td><div id='Ack'>$buttonSearchResponse->Ack</div> </td></tr>";
echo "</table>";

echo "<pre>";
	print_r($buttonSearchResponse);
echo "</pre>";
require_once '../Response.php';