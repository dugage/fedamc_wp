var g_ppsOnExitPopups = [];
jQuery(document).bind('ppsAfterPopupsInit', function(e, popups){
	for(var i = 0; i < ppsPopups.length; i++) {
		if(ppsPopups[ i ].params.main.show_on == 'on_exit') {
			g_ppsOnExitPopups.push( ppsPopups[ i ] );
		}
	}
	if(g_ppsOnExitPopups.length) {
		_ppsBindOnExitEvent();
	}
});
function _ppsBindOnExitEvent() {
	jQuery(document).mouseout(function(e){
		e = e ? e : window.event;
        var from = e.relatedTarget || e.toElement;
        if (!from || from.nodeName == "HTML") {
			if(e.clientY <= 0 && g_ppsOnExitPopups && g_ppsOnExitPopups.length) {
				for(var i = 0; i < g_ppsOnExitPopups.length; i++) {
					if(!g_ppsOnExitPopups[ i ].is_visible && !g_ppsOnExitPopups[ i ].is_rendered) {
						ppsCheckShowPopup( g_ppsOnExitPopups[ i ] );
					}
				}
			}
        }
	});
}