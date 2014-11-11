<?php 

/**
 * AUTO GENERATED code for PayPalAPIInterfaceService
 */
class PayPalAPIInterfaceServiceService extends PPBaseService {

	// Service Version
	private static $SERVICE_VERSION = "106.0";

	// Service Name
	private static $SERVICE_NAME = "PayPalAPIInterfaceService";

    // SDK Name
	protected static $SDK_NAME = "buttonmanager-php-sdk";
	
	// SDK Version
	protected static $SDK_VERSION = "2.6.107";

	public function __construct($config = null) {
		parent::__construct(self::$SERVICE_NAME, 'SOAP', $config);
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
		$apiContext = new PPApiContext($this->config);
        $handlers = array(
            new PPMerchantServiceHandler($apiCredential, self::$SDK_NAME, self::$SDK_VERSION),
        );
		$resp = $this->call('PayPalAPI', 'BMCreateButton', $bMCreateButtonReq, $apiContext, $handlers);
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
		$apiContext = new PPApiContext($this->config);
        $handlers = array(
            new PPMerchantServiceHandler($apiCredential, self::$SDK_NAME, self::$SDK_VERSION),
        );
		$resp = $this->call('PayPalAPI', 'BMUpdateButton', $bMUpdateButtonReq, $apiContext, $handlers);
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
		$apiContext = new PPApiContext($this->config);
        $handlers = array(
            new PPMerchantServiceHandler($apiCredential, self::$SDK_NAME, self::$SDK_VERSION),
        );
		$resp = $this->call('PayPalAPI', 'BMManageButtonStatus', $bMManageButtonStatusReq, $apiContext, $handlers);
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
		$apiContext = new PPApiContext($this->config);
        $handlers = array(
            new PPMerchantServiceHandler($apiCredential, self::$SDK_NAME, self::$SDK_VERSION),
        );
		$resp = $this->call('PayPalAPI', 'BMGetButtonDetails', $bMGetButtonDetailsReq, $apiContext, $handlers);
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
		$apiContext = new PPApiContext($this->config);
        $handlers = array(
            new PPMerchantServiceHandler($apiCredential, self::$SDK_NAME, self::$SDK_VERSION),
        );
		$resp = $this->call('PayPalAPI', 'BMSetInventory', $bMSetInventoryReq, $apiContext, $handlers);
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
		$apiContext = new PPApiContext($this->config);
        $handlers = array(
            new PPMerchantServiceHandler($apiCredential, self::$SDK_NAME, self::$SDK_VERSION),
        );
		$resp = $this->call('PayPalAPI', 'BMGetInventory', $bMGetInventoryReq, $apiContext, $handlers);
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
		$apiContext = new PPApiContext($this->config);
        $handlers = array(
            new PPMerchantServiceHandler($apiCredential, self::$SDK_NAME, self::$SDK_VERSION),
        );
		$resp = $this->call('PayPalAPI', 'BMButtonSearch', $bMButtonSearchReq, $apiContext, $handlers);
		$ret->init(PPUtils::xmlToArray($resp));
		return $ret;
	}
	 
}