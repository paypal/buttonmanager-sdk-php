<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php');
require_once('PPLoggingManager.php');

$logger = new PPLoggingManager('Crete Button');

$buttonVar = array("item_name=" . $_REQUEST['itemName'],
					"return=" . $_REQUEST['returnURL'],
					"business=" . $_REQUEST['businessMail'],
					"amount=" . $_REQUEST['amt']);

if($_REQUEST['buttonType'] == "PAYMENTPLAN") {
	$paymentPeriod = new InstallmentDetailsType();
	$paymentPeriod->Amount = $_REQUEST['installmentAmt'];
	$paymentPeriod->BillingFrequency = $_REQUEST['billingFreq'];
	$paymentPeriod->BillingPeriod = $_REQUEST['billingPeriod'];
	$paymentPeriod->TotalBillingCycles  = $_REQUEST['billingCycles'];

	$optionSelectionDetails = new OptionSelectionDetailsType();
	$optionSelectionDetails->OptionType = $_REQUEST['optionType'];
	$optionSelectionDetails->PaymentPeriod = array($paymentPeriod);

	$optionDetails = new OptionDetailsType("CreateButtonOption");
	$optionDetails->OptionSelectionDetails = array($optionSelectionDetails);
} elseif($_REQUEST['buttonType'] == "AUTOBILLING") {
	$buttonVar[] = "min_amount=" . $_REQUEST['minAmt'];
} elseif($_REQUEST['buttonType'] == "GIFTCERTIFICATE") {
	$buttonVar[] = "shopping_url=" . $_REQUEST['shoppingUrl'];
} elseif($_REQUEST['buttonType'] == "PAYMENT") {
	$buttonVar[] = "subtotal=" . $_REQUEST['subTotal'];
} elseif($_REQUEST['buttonType'] == "SUBSCRIBE") {
	$buttonVar[] = "a3=" . $_REQUEST['subAmt'];
	$buttonVar[] = "p3=" . $_REQUEST['subPeriod'];
	$buttonVar[] = "t3=" . $_REQUEST['subInterval'];
}

$createButtonRequest = new BMCreateButtonRequestType();
$createButtonRequest->ButtonCode = $_REQUEST['buttonCode'];
$createButtonRequest->ButtonType = $_REQUEST['buttonType'];
$createButtonRequest->ButtonVar = $buttonVar;
if($_REQUEST['buttonType'] == "PAYMENTPLAN") {
	$createButtonRequest->OptionDetails = array($optionDetails);
}

$createButtonReq = new BMCreateButtonReq();
$createButtonReq->BMCreateButtonRequest = $createButtonRequest;

$paypalService = new PayPalAPIInterfaceServiceService();
try {
	$createButtonResponse = $paypalService->BMCreateButton($createButtonReq);
} catch (Exception $ex) {
	require '../Error.php';
	exit;
}
if(isset($createButtonResponse)) {
	echo "<table>";
	echo "<tr><td>Ack :</td><td><div id='Ack'>$createButtonResponse->Ack</div> </td></tr>";
	echo "<tr><td>HostedButtonID :</td><td><div id='HostedButtonID'>". $createButtonResponse->HostedButtonID ."</div> </td></tr>";
	echo "<tr><td>Email :</td><td><div id='Email'>". $createButtonResponse->Email ."</div> </td></tr>";
	echo "</table>";
			
	echo "<pre>";
	print_r($createButtonResponse);
	echo "</pre>";
}
require_once '../Response.php';