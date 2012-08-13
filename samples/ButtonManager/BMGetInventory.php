<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');
require_once('PPLoggingManager.php');

$logger = new PPLoggingManager('BMGetInventory');

$BMGetInventoryReqest = new BMGetInventoryRequestType();
$BMGetInventoryReqest->HostedButtonID = $_REQUEST['hostedID'];

$BMGetInventoryReq = new BMGetInventoryReq();
$BMGetInventoryReq->BMGetInventoryRequest = $BMGetInventoryReqest;

$paypalService = new PayPalAPIInterfaceServiceService();
$BMGetInventoryResponse = $paypalService->BMGetInventory($BMGetInventoryReq);
echo "<pre>";
print_r($BMGetInventoryResponse);
echo "</pre>";
require_once '../Response.php';