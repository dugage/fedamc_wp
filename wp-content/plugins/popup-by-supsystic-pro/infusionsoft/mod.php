<?php
/**
 * THIS MODULE IS NOT READY FOR PRODUCTION!!!!
 */
class infusionsoftPps extends modulePps {
	public function init() {
		parent::init();
		dispatcherPps::addFilter('subDestList', array($this, 'addSubDestList'));
		add_action('init', array($this, 'trySetAuthCode'));
		
	}
	public function isSupported() {
		return function_exists('curl_setopt') && version_compare(phpversion(), '5.3', '>=');
	}
	public function addSubDestList($subDestList) {
		$subDestList['infusionsoft'] = array('label' => __('InfusionSoft', PPS_LANG_CODE), 'require_confirm' => false);
		return $subDestList;
	}
	public function trySetAuthCode() {
		$from = reqPps::getVar('from', 'get');
		$code = reqPps::getVar('code', 'get');
		if($from == 'infusionsoft' && !empty($code) && is_admin() && framePps::_()->getModule('user')->isAdmin()) {
			$this->getModel()->saveAccessToken( $code );
			redirectPps(
				uriPps::_(
					array_merge(
							array('baseUrl' => uriPps::getCurrent()), uriPps::getGetParams(array('from', 'code'))
					)
				)
			);
		}
	}
}

