<?php
use PayPal\PayPalAPI\BMGetInventoryReq;
use PayPal\PayPalAPI\BMGetInventoryRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
require_once('../PPBootStrap.php');

/*
 * Use the BMGetInventory API operation to determine the inventory levels and other inventory-related information for a button and menu items associated with the button. Typically, you call BMGetInventory to obtain field values before calling BMSetInventory to change the inventory levels. 
 */

/*
 * (Required) The ID of the hosted button whose inventory information you want to obtain.
 */
$bmGetInventoryReqest = new BMGetInventoryRequestType($_REQUEST['hostedID']);
$bmGetInventoryReq = new BMGetInventoryReq();
$bmGetInventoryReq->BMGetInventoryRequest = $bmGetInventoryReqest;
/*
Configuration::getAcctAndConfig() returns array that contains credential and config parameters
*/
$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
try {
	$bmGetInventoryResponse = $paypalService->BMGetInventory($bmGetInventoryReq);
} catch (Exception $ex) {
	require '../Error.php';
	exit;
}	

echo "<table>";
echo "<tr><td>Ack :</td><td><div id='Ack'>$bmGetInventoryResponse->Ack</div> </td></tr>";
echo "<tr><td>HostedButtonID :</td><td><div id='HostedButtonID'>$bmGetInventoryResponse->HostedButtonID</div> </td></tr>";
echo "</table>";

echo "<pre>";
print_r($bmGetInventoryResponse);
echo "</pre>";
require_once '../Response.php';