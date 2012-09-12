<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');
require_once('PPLoggingManager.php');

$logger = new PPLoggingManager('BMGetButtonDetails');

$BMGetButtonDetailsReqest = new BMGetButtonDetailsRequestType();
$BMGetButtonDetailsReqest->HostedButtonID = $_REQUEST['hostedID'];

$BMGetButtonDetailsReq = new BMGetButtonDetailsReq();
$BMGetButtonDetailsReq->BMGetButtonDetailsRequest = $BMGetButtonDetailsReqest;

$paypalService = new PayPalAPIInterfaceServiceService();
$BMGetButtonDetailsResponse = $paypalService->BMGetButtonDetails($BMGetButtonDetailsReq);

echo "<table>";
echo "<tr><td>Ack :</td><td><div id='Ack'>$BMGetButtonDetailsResponse->Ack</div> </td></tr>";
echo "<tr><td>HostedButtonID :</td><td><div id='HostedButtonID'>". $BMGetButtonDetailsResponse->HostedButtonID ."</div> </td></tr>";
echo "<tr><td>Email :</td><td><div id='Email'>". $BMGetButtonDetailsResponse->Email ."</div> </td></tr>";
echo "</table>";

echo "<pre>";
print_r($BMGetButtonDetailsResponse);
echo "</pre>";
require_once '../Response.php';