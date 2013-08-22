<?php
use PayPal\PayPalAPI\BMCreateButtonReq;
use PayPal\PayPalAPI\BMCreateButtonRequestType;
use PayPal\PayPalAPI\InstallmentDetailsType;
use PayPal\PayPalAPI\OptionDetailsType;
use PayPal\PayPalAPI\OptionSelectionDetailsType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
require_once('../PPBootStrap.php');

/*
 * Use the BMCreateButton API operation to create a Website Payments Standard button. You an create either a button that is hosted on PayPal or a non-hosted button. 
 * The request fields specify the characteristics of your button, which include associated menu items related to the button. You can specify up to 5 menu items, each of which can include up to 10 possible selections.
 */

/*
 * (Optional) HTML standard button variables
 */
$buttonVar = array("item_name=" . $_REQUEST['itemName'],
					"return=" . $_REQUEST['returnURL'],
					"business=" . $_REQUEST['businessMail'],
					"amount=" . $_REQUEST['amt']);

/*
 *  (Required) The kind of button you want to create. It is one of the following values:

    BUYNOW - Buy Now button

    CART - Add to Cart button

    GIFTCERTIFICATE - Gift Certificate button

    SUBSCRIBE - Subscribe button

    DONATE - Donate button

    UNSUBSCRIBE - Unsubscribe button

    VIEWCART - View Cart button

    PAYMENTPLAN - Installment Plan button; since version 63.0

    AUTOBILLING - Automatic Billing button; since version 63.0

    PAYMENT - Pay Now button; since version 65.1

Note: Do not specify BUYNOW if BUTTONCODE=TOKEN; specify PAYMENT instead. Do not specify PAYMENT if BUTTONCODE=HOSTED. 
 */
if($_REQUEST['buttonType'] == "PAYMENTPLAN") {
	$paymentPeriod = new InstallmentDetailsType();
	/*
	 * (Optional) The base amount to bill for the cycle.
	 */
	$paymentPeriod->Amount = $_REQUEST['installmentAmt'];
	/*
	 * (Optional) The installment cycle frequency in units, e.g. if the billing frequency is 2 and the billing period is Month, the billing cycle is every 2 months. The default billing frequency is 1.
	 */
	$paymentPeriod->BillingFrequency = $_REQUEST['billingFreq'];
	/*
	 *  (Optional) The installment cycle unit, which is one of the following values:

    NoBillingPeriodType - None (default)

    Day

    Week

    SemiMonth

    Month

    Year

	 */
	$paymentPeriod->BillingPeriod = $_REQUEST['billingPeriod'];
	/*
	 * (Optional) The total number of billing cycles, regardless of the duration of a cycle; 1 is the default
	 */
	$paymentPeriod->TotalBillingCycles  = $_REQUEST['billingCycles'];

	$optionSelectionDetails = new OptionSelectionDetailsType();
	/*
	 *  (Optional) The installment option type for an OPTIONnNAME, which is one of the following values:

    FULL - Payment in full

    VARIABLE - Variable installments

    EMI - Equal installments

Note: Only available for Installment Plan buttons. 
	 */
	$optionSelectionDetails->OptionType = $_REQUEST['optionType'];
	/*
	 * (Optional) Information about an installment option
	 */
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
if(isset($_REQUEST['notifyURL']))
{
	$buttonVar[] = "notify_url=" . $_REQUEST['notifyURL'];
}

$createButtonRequest = new BMCreateButtonRequestType();
/*
 *  (Optional) The kind of button code to create. It is one of the following values:

    HOSTED - A secure button stored on PayPal; default for all buttons except View Cart, Unsubscribe, and Pay Now

    ENCRYPTED - An encrypted button, not stored on PayPal; default for View Cart button

    CLEARTEXT - An unencrypted button, not stored on PayPal; default for Unsubscribe button

    TOKEN - A secure button, not stored on PayPal, used only to initiate the Hosted Solution checkout flow; default for Pay Now button. Since version 65.1

 */
$createButtonRequest->ButtonCode = $_REQUEST['buttonCode'];
/*
 *  (Required) The kind of button you want to create. It is one of the following values:

    BUYNOW - Buy Now button

    CART - Add to Cart button

    GIFTCERTIFICATE - Gift Certificate button

    SUBSCRIBE - Subscribe button

    DONATE - Donate button

    UNSUBSCRIBE - Unsubscribe button

    VIEWCART - View Cart button

    PAYMENTPLAN - Installment Plan button; since version 63.0

    AUTOBILLING - Automatic Billing button; since version 63.0

    PAYMENT - Pay Now button; since version 65.1

Note: Do not specify BUYNOW if BUTTONCODE=TOKEN; specify PAYMENT instead. Do not specify PAYMENT if BUTTONCODE=HOSTED. 
 */
$createButtonRequest->ButtonType = $_REQUEST['buttonType'];
$createButtonRequest->ButtonVar = $buttonVar;
if($_REQUEST['buttonType'] == "PAYMENTPLAN") {
	$createButtonRequest->OptionDetails = array($optionDetails);
}

$createButtonReq = new BMCreateButtonReq();
$createButtonReq->BMCreateButtonRequest = $createButtonRequest;

/*
 * 	 ## Creating service wrapper object
Creating service wrapper object to make API call and loading
Configuration::getAcctAndConfig() returns array that contains credential and config parameters
*/
$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
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