<?php
require_once('../PPBootStrap.php');

$logger = new PPLoggingManager('BMManageButtonStatus');

$bmManageButtonStatusReqest = new BMManageButtonStatusRequestType();
$bmManageButtonStatusReqest->HostedButtonID = $_REQUEST['hostedID'];
$bmManageButtonStatusReqest->ButtonStatus = $_REQUEST['buttonStatus'];

$BMManageButtonStatusReq = new BMManageButtonStatusReq();
$BMManageButtonStatusReq->BMManageButtonStatusRequest = $bmManageButtonStatusReqest;

$paypalService = new PayPalAPIInterfaceServiceService();
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