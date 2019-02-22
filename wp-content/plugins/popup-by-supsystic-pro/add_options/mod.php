<?php
class add_optionsPps extends modulePps {
	public function init() {
		parent::init();
		dispatcherPps::addAction('editPopupMainOptsCloseOn', array($this, 'showAdminOption'));
		dispatcherPps::addFilter('popupCss', array($this, 'modifyPopupCss'), 10, 2);
		dispatcherPps::addFilter('popupListBeforeRender', array($this, 'checkPopupListBeforeRender'));
		dispatcherPps::addFilter('popupCheckCondition', array($this, 'modifyPopupsCheckCondition'));
		add_filter('comment_post_redirect', array($this, 'modifyRedirectAfterCommentAdd'), 10, 2);
		add_shortcode(PPS_SHORTCODE, array($this, 'showPopupShortcode'));
	}
	public function modifyPopupsCheckCondition($condition) {
		// Do not render "after comment" popups if this is not required
		if(!$this->_canShowAfterComment()) {
			$popupModel = framePps::_()->getModule('popup')->getModel();
			$showOnCommentId = $popupModel->getShowOnIdByKey('after_comment');
			if($showOnCommentId) {
				$condition .= ' AND show_on != '. $showOnCommentId;
			}
		}
		return $condition;
	}
	private function _canShowAfterComment() {
		$afterCommentAddedTime = (int) reqPps::getVar('ppsCtAdded', 'get');
		return ($afterCommentAddedTime && time() - $afterCommentAddedTime < 10);
	}
	public function showAdminOption($popup) {
		$this->getView()->showAdminOption( $popup );
	}
	public function modifyPopupCss($css, $popup) {
		// Hide close button
		if(isset($popup['params']['main']['close_on']) 
			&& in_array($popup['params']['main']['close_on'], array('after_action'))
		) {
			$css .= '#ppsPopupShell_'. $popup['view_id']. ' .ppsPopupClose { display: none !important; }';
		}
		return $css;
	}
	public function checkPopupListBeforeRender($popups) {
		if(!empty($popups)) {
			$needLoadAssets = false;
			foreach($popups as $p) {
				if(isset($p['params'])) {
					if(isset($p['params']['main']['close_on']) 
						&& in_array($p['params']['main']['close_on'], array('after_action', 'after_time'))
					) {
						$needLoadAssets = true;
						break;
					}
					if(isset($p['params']['main']['show_on']) 
						&& in_array($p['params']['main']['show_on'], array('page_bottom', 'after_inactive', 'after_comment', 'link_follow'))
					) {
						$needLoadAssets = true;
						break;
					}
				}
			}
			if($needLoadAssets) {
				$this->loadAssets();
			}
		}
		return $popups;
	}
	public function loadAssets() {
		framePps::_()->addScript('frontend.add_options', $this->getModPath(). 'js/frontend.add_options.js', array('jquery'));
	}
	public function modifyRedirectAfterCommentAdd($location, $comment) {
		$popupModel = framePps::_()->getModule('popup')->getModel();
		$showOnCommentId = $popupModel->getShowOnIdByKey('after_comment');
		if($showOnCommentId) {
			$popupsShowAfterComment = $popupModel->addWhere(array('show_on' => $showOnCommentId))->addWhere(array('active' => 1))->getCount();
			if($popupsShowAfterComment) {	// PopUps with such type exists
				$urlComment = explode('#', $location);
				$url = $urlComment[0];
				$url .= (strpos($url, '?') ? '&' : '?'). 'ppsCtAdded='. time();
				$urlComment[0] = $url;
				$location = implode('#', $urlComment);
			}
		}
		return $location;
	}
	public function showPopupShortcode($params) {
		$id = isset($params['id']) ? (int) $params['id'] : 0;
		if(!$id && isset($params[0]) && !empty($params[0])) {	// For some reason - for some cases it convert space in shortcode - to %20 im this place
			$id = explode('=', $params[0]);
			$id = isset($id[1]) ? (int) $id[1] : 0;
		}
		return '<script> jQuery(document).ready(function(){ setTimeout(function(){ ppsCheckShowPopup('. $id. '); }, 100) }); </script>';
	}
}

