<?php if(!$this->isSupported) { ?>
<tr class="ppsPopupSubDestOpts ppsPopupSubDestOpts_infusionsoft">
	<th scope="row">
		<?php _e('Not supported by Server', PPS_LANG_CODE)?>
		<i class="fa fa-question supsystic-tooltip-bottom" title="<?php echo esc_html(__('Not supported on your server', PPS_LANG_CODE))?>"></i>
	</th>
	<td>
		<?php _e('This module require to have cUrl library for PHP on server installed and PHP version to be at least 5.3. Please contact your hosting provider and ask them to enable cUrl for you, this is Free library, and check your PHP version.', PPS_LANG_CODE)?>
	</td>
</tr>	
<?php } elseif(!$this->isAutentificated) { ?>
<tr class="ppsPopupSubDestOpts ppsPopupSubDestOpts_infusionsoft">
	<th scope="row">
		<?php _e('InfusionSoft Setup', PPS_LANG_CODE)?>
		<i class="fa fa-question supsystic-tooltip" title="<?php echo esc_html(__('You must authorize to use InfusionSoft features', PPS_LANG_CODE))?>"></i>
	</th>
	<td>
		<a class="button button-primary" href="<?php echo $this->authUrl?>"><?php _e('Authorize in InfusionSoft')?></a>
	</td>
</tr>	
<?php }?>