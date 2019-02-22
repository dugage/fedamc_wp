<?php if(!$this->isSupported) { ?>
<tr class="ppsPopupSubDestOpts ppsPopupSubDestOpts_get_response">
	<th scope="row">
		<?php _e('Not supported by Server', PPS_LANG_CODE)?>
		<i class="fa fa-question supsystic-tooltip-bottom" title="<?php echo esc_html(__('Not supported on your server', PPS_LANG_CODE))?>"></i>
	</th>
	<td>
		<?php _e('This module require to have cUrl library for PHP on server installed. Please contact your hosting provider and ask them to enable cUrl for you, this is Free library.', PPS_LANG_CODE)?>
	</td>
</tr>	
<?php } else {?>
<tr class="ppsPopupSubDestOpts ppsPopupSubDestOpts_get_response">
	<th scope="row">
		<?php _e('API Key', PPS_LANG_CODE)?>
		<i class="fa fa-question supsystic-tooltip-bottom" title="<?php echo esc_html(sprintf(__('You can find it under your GetResponse Account -> GetResponse API, here is <a href="%s" class="ppsGrHelpApiKeyLink">help screenshot</a>', PPS_LANG_CODE), $this->helpImgLink))?>"></i>
	</th>
	<td>
		<?php echo htmlPps::text('params[tpl][sub_gr_api_key]', array(
			'value' => (isset($this->popup['params']['tpl']['sub_gr_api_key']) ? $this->popup['params']['tpl']['sub_gr_api_key'] : ''),
		))?>
	</td>
</tr>
<tr class="ppsPopupSubDestOpts ppsPopupSubDestOpts_get_response">
	<th scope="row">
		<?php _e('Campaigns for subscribe', PPS_LANG_CODE)?>
		<i class="fa fa-question supsystic-tooltip-bottom" title="<?php _e('Select Campaigns for subscribe. They are taken from your GetResponse account.', PPS_LANG_CODE)?>"></i>
	</th>
	<td>
		<div id="ppsSubGrListsShell" style="display: none;">
			<?php echo htmlPps::selectlist('params[tpl][sub_gr_lists]', array(
				'value' => (isset($this->popup['params']['tpl']['sub_gr_lists']) ? $this->popup['params']['tpl']['sub_gr_lists'] : ''),
				//'options' => array('' => __('Loading...', PPS_LANG_CODE)),
				'attrs' => 'id="ppsSubGrLists" class="chosen" data-placeholder="'. __('Choose Lists', PPS_LANG_CODE). '"',
			))?>
		</div>
		<span id="ppsSubGrMsg"></span>
	</td>
</tr>
<?php }?>

