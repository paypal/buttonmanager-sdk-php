<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');
require_once('PPLoggingManager.php');

$logger = new PPLoggingManager('BMGetButtonDetails');

$itemTrackingDetails = new ItemTrackingDetailsType();
$itemTrackingDetails->ItemQty = $_REQUEST['itemQty'];
$itemTrackingDetails->ItemCost = $_REQUEST['itemCost'];

$bmSetInventoryReqest = new BMSetInventoryRequestType($_REQUEST['hostedID'], $_REQUEST['trackInv'], $_REQUEST['trackPnl']);
$bmSetInventoryReqest->ItemTrackingDetails = $itemTrackingDetails;

$bmSetInventoryReq = new BMSetInventoryReq();
$bmSetInventoryReq->BMSetInventoryRequest = $bmSetInventoryReqest;

$paypalService = new PayPalAPIInterfaceServiceService(); 
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