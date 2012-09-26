\<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');
require_once('PPLoggingManager.php');

$logger = new PPLoggingManager('BMGetButtonDetails');

$bmGetButtonDetailsReqest = new BMGetButtonDetailsRequestType($_REQUEST['hostedID']);
$bmGetButtonDetailsReq = new BMGetButtonDetailsReq();
$bmGetButtonDetailsReq->BMGetButtonDetailsRequest = $bmGetButtonDetailsReqest;

$paypalService = new PayPalAPIInterfaceServiceService();
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