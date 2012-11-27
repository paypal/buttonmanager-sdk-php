<?php 
require_once 'PPBaseService.php';
require_once 'PayPalAPIInterfaceService.php';

/**
 * AUTO GENERATED code for PayPalAPIInterfaceService
 */
class PayPalAPIInterfaceServiceService extends PPBaseService {

	// Service Version
	private static $SERVICE_VERSION = "94.0";

	// Service Name
	private static $SERVICE_NAME = "PayPalAPIInterfaceService";

    // SDK Name
	private static $SDK_NAME = "sdkname";
	
	// SDK Version
	private static $SDK_VERSION = "sdkversion";

	public function __construct() {
		parent::__construct(self::$SERVICE_NAME, 'SOAP', array('PPMerchantServiceHandler'));
	}

	private function setStandardParams(AbstractRequestType $request) {
		if ($request->Version == NULL) {
			$request->Version = self::$SERVICE_VERSION;
		}
	}

	/**
	 * Service Call: BMCreateButton
	 * @param BMCreateButtonReq $bMCreateButtonReq
	 * @param mixed $apiCredential - Optional API credential - can either be
	 * 		a username configured in sdk_config.ini or a ICredential object
	 *      created dynamically 		
	 * @return BMCreateButtonResponseType
	 * @throws APIException
	 */
	public function BMCreateButton($bMCreateButtonReq, $apiCredential = NULL) {
		$this->setStandardParams($bMCreateButtonReq->BMCreateButtonRequest);
		$ret = new BMCreateButtonResponseType();
		$resp = $this->call("BMCreateButton", $bMCreateButtonReq, $apiCredential);
		$ret->init(PPUtils::xmlToArray($resp));
		return $ret;
	}
	 

	/**
	 * Service Call: BMUpdateButton
	 * @param BMUpdateButtonReq $bMUpdateButtonReq
	 * @param mixed $apiCredential - Optional API credential - can either be
	 * 		a username configured in sdk_config.ini or a ICredential object
	 *      created dynamically 		
	 * @return BMUpdateButtonResponseType
	 * @throws APIException
	 */
	public function BMUpdateButton($bMUpdateButtonReq, $apiCredential = NULL) {
		$this->setStandardParams($bMUpdateButtonReq->BMUpdateButtonRequest);
		$ret = new BMUpdateButtonResponseType();
		$resp = $this->call("BMUpdateButton", $bMUpdateButtonReq, $apiCredential);
		$ret->init(PPUtils::xmlToArray($resp));
		return $ret;
	}
	 

	/**
	 * Service Call: BMManageButtonStatus
	 * @param BMManageButtonStatusReq $bMManageButtonStatusReq
	 * @param mixed $apiCredential - Optional API credential - can either be
	 * 		a username configured in sdk_config.ini or a ICredential object
	 *      created dynamically 		
	 * @return BMManageButtonStatusResponseType
	 * @throws APIException
	 */
	public function BMManageButtonStatus($bMManageButtonStatusReq, $apiCredential = NULL) {
		$this->setStandardParams($bMManageButtonStatusReq->BMManageButtonStatusRequest);
		$ret = new BMManageButtonStatusResponseType();
		$resp = $this->call("BMManageButtonStatus", $bMManageButtonStatusReq, $apiCredential);
		$ret->init(PPUtils::xmlToArray($resp));
		return $ret;
	}
	 

	/**
	 * Service Call: BMGetButtonDetails
	 * @param BMGetButtonDetailsReq $bMGetButtonDetailsReq
	 * @param mixed $apiCredential - Optional API credential - can either be
	 * 		a username configured in sdk_config.ini or a ICredential object
	 *      created dynamically 		
	 * @return BMGetButtonDetailsResponseType
	 * @throws APIException
	 */
	public function BMGetButtonDetails($bMGetButtonDetailsReq, $apiCredential = NULL) {
		$this->setStandardParams($bMGetButtonDetailsReq->BMGetButtonDetailsRequest);
		$ret = new BMGetButtonDetailsResponseType();
		$resp = $this->call("BMGetButtonDetails", $bMGetButtonDetailsReq, $apiCredential);
		$ret->init(PPUtils::xmlToArray($resp));
		return $ret;
	}
	 

	/**
	 * Service Call: BMSetInventory
	 * @param BMSetInventoryReq $bMSetInventoryReq
	 * @param mixed $apiCredential - Optional API credential - can either be
	 * 		a username configured in sdk_config.ini or a ICredential object
	 *      created dynamically 		
	 * @return BMSetInventoryResponseType
	 * @throws APIException
	 */
	public function BMSetInventory($bMSetInventoryReq, $apiCredential = NULL) {
		$this->setStandardParams($bMSetInventoryReq->BMSetInventoryRequest);
		$ret = new BMSetInventoryResponseType();
		$resp = $this->call("BMSetInventory", $bMSetInventoryReq, $apiCredential);
		$ret->init(PPUtils::xmlToArray($resp));
		return $ret;
	}
	 

	/**
	 * Service Call: BMGetInventory
	 * @param BMGetInventoryReq $bMGetInventoryReq
	 * @param mixed $apiCredential - Optional API credential - can either be
	 * 		a username configured in sdk_config.ini or a ICredential object
	 *      created dynamically 		
	 * @return BMGetInventoryResponseType
	 * @throws APIException
	 */
	public function BMGetInventory($bMGetInventoryReq, $apiCredential = NULL) {
		$this->setStandardParams($bMGetInventoryReq->BMGetInventoryRequest);
		$ret = new BMGetInventoryResponseType();
		$resp = $this->call("BMGetInventory", $bMGetInventoryReq, $apiCredential);
		$ret->init(PPUtils::xmlToArray($resp));
		return $ret;
	}
	 

	/**
	 * Service Call: BMButtonSearch
	 * @param BMButtonSearchReq $bMButtonSearchReq
	 * @param mixed $apiCredential - Optional API credential - can either be
	 * 		a username configured in sdk_config.ini or a ICredential object
	 *      created dynamically 		
	 * @return BMButtonSearchResponseType
	 * @throws APIException
	 */
	public function BMButtonSearch($bMButtonSearchReq, $apiCredential = NULL) {
		$this->setStandardParams($bMButtonSearchReq->BMButtonSearchRequest);
		$ret = new BMButtonSearchResponseType();
		$resp = $this->call("BMButtonSearch", $bMButtonSearchReq, $apiCredential);
		$ret->init(PPUtils::xmlToArray($resp));
		return $ret;
	}
	 
}
?>