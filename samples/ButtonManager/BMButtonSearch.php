<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');
require_once('PPLoggingManager.php');

$logger = new PPLoggingManager('Button Search');

$buttonSearchRequest = new BMButtonSearchRequestType();
$buttonSearchRequest->StartDate = $_REQUEST['startDate'];
$buttonSearchRequest->EndDate = $_REQUEST['endDate'];

$buttonSearchReq = new BMButtonSearchReq();
$buttonSearchReq->BMButtonSearchRequest = $buttonSearchRequest;

$paypalService = new PayPalAPIInterfaceServiceService();
$buttonSearchResponse = $paypalService->BMButtonSearch($buttonSearchReq);

echo "<table>";
echo "<tr><td>Ack :</td><td><div id='Ack'>$buttonSearchResponse->Ack</div> </td></tr>";
echo "</table>";

echo "<pre>";
	print_r($buttonSearchResponse);
echo "</pre>";
require_once '../Response.php';