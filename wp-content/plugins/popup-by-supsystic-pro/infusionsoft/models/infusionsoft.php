<?php
class infusionsoftModelPps extends modelPps {
	private $_client = null;
	private $_lastRequireConfirm = false;
	
	private $_apiId = 'epfkdyv7r96gweukawn8w4s5';
	private $_apiSecret = 'FtX23GhvGJ';
	private $_apiRedirect = 'http://supsystic.com/infusionsoft/index.php';
	public function getClient() {
		if($this->_client)
			return $this->_client;
		if(!class_exists('Infusionsoft')) {
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'Infusionsoft.php');
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'InfusionsoftException.php');
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'Token.php');
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'TokenExpiredException.php');
			
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'curl.php');
			
			/*require_once($this->getModule()->getModDir(). 'classes'. DS. 'Http'. DS. 'SerializerInterface.php');
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'Http'. DS. 'InfusionsoftSerializer.php');
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'Http'. DS. 'ClientInterface.php');
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'Http'. DS. 'GuzzleClient.php');
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'Http'. DS. 'CurlClient.php');*/
			
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'Api'. DS. 'AbstractApi.php');
			require_once($this->getModule()->getModDir(). 'classes'. DS. 'Api'. DS. 'ContactService.php');
		}
		$this->_client = new \Infusionsoft\Infusionsoft(array(
			'clientId' => $this->_apiId,
			'clientSecret' => $this->_apiSecret,
			'redirectUri' => $this->_apiRedirect,
		));
		$tokenData = $this->_getTokenData();
		if($tokenData 
			&&($tokenData->accessToken || $tokenData->refreshToken) 
			&& (!isset($tokenData->extraInfo['error']) || !$tokenData->extraInfo['error'])
		) {
			$this->_client->setToken( $tokenData );
		}
		try {
			$tokenObj = $this->_client->refreshAccessToken();
			if($tokenObj && isset($tokenObj->extraInfo) && isset($tokenObj->extraInfo['error']) && !empty($tokenObj->extraInfo['error'])) {
				$this->_client->setToken(null);
			} else {
				$this->_saveTokenData( $tokenObj );
			}
		} catch(TokenExpiredException $e) {
			$this->_client->setToken(null);
		}
		return $this->_client;
	}
	public function isAutentificated() {
		$client = $this->getClient();
		return $client->getToken() ? true : false;
	}
	public function getAuthUrl() {
		return $this->getClient()->getAuthorizationUrl(base64_encode(uriPps::getFullUrl()));
	}
	public function saveAccessToken($code) {
		if(!empty($code)) {
			$client = $this->getClient();
			$token = $client->requestAccessToken($code);
			if(!empty($token)) {
				$this->_saveTokenData( $token );
			}
		}
	}
	private function _saveTokenData($token) {
		framePps::_()->getModule('options')->getModel()->save('infusionsoft_access_token', serialize($token));
	}
	private function _getTokenData() {
		$token = framePps::_()->getModule('options')->get('infusionsoft_access_token');
		if(!empty($token)) {
			return unserialize($token);
		}
		return false;
	}
	public function subscribe($d, $popup, $validateIp = false) {
		$email = isset($d['email']) ? trim($d['email']) : false;
		if(!empty($email)) {
			if(is_email($email)) {
				if(!$validateIp || $validateIp && framePps::_()->getModule('subscribe')->getModel()->checkOftenAccess(array('only_check' => true))) {
					$client = $this->getClient();
					try {
						//$client->refreshAccessToken();
					} catch(TokenExpiredException $e) {
						$this->pushError(__('Administrator of this site need to re-autentificate in InfusionSoft system from admin area', PPS_LANG_CODE));
						return false;
					} catch(Exception $e) {
						$this->pushError($e->getMessage());
						return false;
					}
					
					$addData = array('Email' => $email);
					$name = isset($d['name']) ? trim($d['name']) : '';

					if(!empty($name)) {
						$firstLastName = explode(' ', $name);
						$addData['FirstName'] = $firstLastName[ 0 ];
						if(isset($firstLastName[ 1 ]) && !empty($firstLastName[ 1 ])) {
							$addData['LastName'] = $firstLastName[ 1 ];
						}
					}

					if(isset($popup['params']['tpl']['sub_fields'])
						&& !empty($popup['params']['tpl']['sub_fields'])
					) {
						foreach($popup['params']['tpl']['sub_fields'] as $k => $f) {
							if(in_array($k, array('name', 'email'))) continue;	// Ignore standard fields
							if(isset($d[ $k ])) {
								$addData[ $k ] = $d[ $k ]; 
							}
						}
					}
					try {
						$res = $client->contacts()->addWithDupCheck($addData, 'Email');
					} catch(Exception $e) {
						$this->pushError($e->getMessage());
						return false;
					}
					var_dump($res);
					return true;
				}
			} else
				$this->pushError (framePps::_()->getModule('subscribe')->getModel()->getInvalidEmailMsg($popup), 'email');
		} else
			$this->pushError (framePps::_()->getModule('subscribe')->getModel()->getInvalidEmailMsg($popup), 'email');
		return false;
	}
	public function requireConfirm() {
		if($this->_lastRequireConfirm)
			return true;
		$destData = framePps::_()->getModule('subscribe')->getDestByKey( $this->getCode() );
		return $destData['require_confirm'];
	}
}