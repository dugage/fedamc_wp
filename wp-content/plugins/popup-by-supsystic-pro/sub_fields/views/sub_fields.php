<?php
class sub_fieldsViewPps extends viewPps {
	public function displayAdminControls() {
		$this->assign('availableHtmlTypes', array(
			'text' => __('Text', PPS_LANG_CODE),
			'textarea' => __('Text area', PPS_LANG_CODE),
			'selectbox' => __('Select box', PPS_LANG_CODE),
			'hidden' => __('Hidden Field', PPS_LANG_CODE),
		));
		parent::display('sfAdminControls');
	}
}
