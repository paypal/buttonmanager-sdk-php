<?php
use PayPal\EBLBaseComponents\ItemTrackingDetailsType;
use PayPal\PayPalAPI\BMSetInventoryReq;
use PayPal\PayPalAPI\BMSetInventoryRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;

require_once('../PPBootStrap.php');

/*
 * Use the BMSetInventory API operation to set the inventory level and inventory management features for the specified button. 
 * When you set the inventory level for a button, PayPal can track inventory, calculate the gross profit associated with sales, send you an alert when inventory drops below a specified quantity, and manage sold out conditions. 
 */

/*
 * (Optional) Item tracking details for the button
 */
$itemTrackingDetails = new ItemTrackingDetailsType();
$itemTrackingDetails->ItemQty = $_REQUEST['itemQty'];
$itemTrackingDetails->ItemCost = $_REQUEST['itemCost'];

/*
 * (Required) The ID of the hosted button whose inventory you want to set.
 *  (Required) Whether to track inventory levels associated with the button. It is one of the following values:

    0 - do not track inventory

    1 - track inventory
 (Required) Whether to track the gross profit associated with inventory changes. It is one of the following values:

    0 - do not track the gross profit

    1 - track the gross profit

Note: The gross profit is calculated as the price of the item less its cost, multiplied by the change in the inventory level since the last call to BMSetInventory
 */
$bmSetInventoryReqest = new BMSetInventoryRequestType($_REQUEST['hostedID'], $_REQUEST['trackInv'], $_REQUEST['trackPnl']);
$bmSetInventoryReqest->ItemTrackingDetails = $itemTrackingDetails;

$bmSetInventoryReq = new BMSetInventoryReq();
$bmSetInventoryReq->BMSetInventoryRequest = $bmSetInventoryReqest;
/*
 * 	 ## Creating service wrapper object
Creating service wrapper object to make API call and loading
Configuration::getAcctAndConfig() returns array that contains credential and config parameters
*/
$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
try {
	$bmSetInventoryResponse = $paypalService->BMSetInventory($bmSetInventoryReq);
} catch (Exception $ex) {
	require '../Error.php';
	exit;
}
echo "<table>";
echo "<tr><td>Ack :</td><td><div id='Ack'>$bmSetInventoryResponse->Ack</div> </td></tr>";
echo "</table>";

echo "<pre>";
print_r($bmSetInventoryResponse);
echo "</pre>";
require_once '../Response.php';