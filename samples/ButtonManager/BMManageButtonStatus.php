<?php
use PayPal\PayPalAPI\BMManageButtonStatusReq;
use PayPal\PayPalAPI\BMManageButtonStatusRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
require_once('../PPBootStrap.php');
/*
 * Use the BMManageButtonStatus API operation to change the status of a hosted button. Currently, you can only delete a button 
 */

$bmManageButtonStatusReqest = new BMManageButtonStatusRequestType();
/*
 * (Required) The ID of the hosted button whose status you want to change.
 */
$bmManageButtonStatusReqest->HostedButtonID = $_REQUEST['hostedID'];
/*
 *  (Required) The new status of the button. It is one of the following values:

    DELETE - the button is deleted from PayPal

 */
$bmManageButtonStatusReqest->ButtonStatus = $_REQUEST['buttonStatus'];

$BMManageButtonStatusReq = new BMManageButtonStatusReq();
$BMManageButtonStatusReq->BMManageButtonStatusRequest = $bmManageButtonStatusReqest;
/*
 * 	 ## Creating service wrapper object
Creating service wrapper object to make API call and loading
Configuration::getAcctAndConfig() returns array that contains credential and config parameters
*/
$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
try {
	$bmManageButtonStatusResponse = $paypalService->BMManageButtonStatus($BMManageButtonStatusReq);
} catch (Exception $ex) {
	require '../Error.php';
	exit;
}

echo "<table>";
echo "<tr><td>Ack :</td><td><div id='Ack'>$bmManageButtonStatusResponse->Ack</div> </td></tr>";
echo "</table>";

echo "<pre>";
print_r($bmManageButtonStatusResponse);
echo "</pre>";
require_once '../Response.php';