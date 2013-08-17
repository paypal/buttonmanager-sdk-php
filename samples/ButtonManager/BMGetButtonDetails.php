<?php
use PayPal\PayPalAPI\BMGetButtonDetailsReq;
use PayPal\PayPalAPI\BMGetButtonDetailsRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
require_once('../PPBootStrap.php');

/*
 * Use the BMGetButtonDetails API operation to obtain information about a hosted Website Payments Standard button. You can use this information to set the fields that have not changed when updating a button. 
 */

/*
 * (Required) The ID of the hosted button whose details you want to obtain.
 */
$bmGetButtonDetailsReqest = new BMGetButtonDetailsRequestType($_REQUEST['hostedID']);
$bmGetButtonDetailsReq = new BMGetButtonDetailsReq();
$bmGetButtonDetailsReq->BMGetButtonDetailsRequest = $bmGetButtonDetailsReqest;

/*
 * 	 ## Creating service wrapper object
Creating service wrapper object to make API call and loading
Configuration::getAcctAndConfig() returns array that contains credential and config parameters
*/
$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
try {
	$bmGetButtonDetailsResponse = $paypalService->BMGetButtonDetails($bmGetButtonDetailsReq);
} catch (Exception $ex) {
	require '../Error.php';
	exit;
}
echo "<table>";
echo "<tr><td>Ack :</td><td><div id='Ack'>$bmGetButtonDetailsResponse->Ack</div> </td></tr>";
echo "<tr><td>HostedButtonID :</td><td><div id='HostedButtonID'>". $bmGetButtonDetailsResponse->HostedButtonID ."</div> </td></tr>";
echo "<tr><td>Email :</td><td><div id='Email'>". $bmGetButtonDetailsResponse->Email ."</div> </td></tr>";
echo "</table>";

echo "<pre>";
print_r($bmGetButtonDetailsResponse);
echo "</pre>";
require_once '../Response.php';