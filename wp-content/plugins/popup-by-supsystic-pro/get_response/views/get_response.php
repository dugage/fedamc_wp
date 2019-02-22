<?php
class get_responseViewPps extends viewPps {
	public function generateAdminFields($popup) {
		$isSupported = $this->getModule()->isSupported();
		if($isSupported) {
			// TODO: Correct this link
			$this->assign('helpImgLink', '');
			$this->assign('popup', $popup);
			framePps::_()->addScript('admin.'. $this->getCode(), $this->getModule()->getModPath(). 'js/admin.'. $this->getCode(). '.js');
		}
		$this->assign('isSupported', $isSupported);
		return parent::getContent('grAdminFields');
	}
}