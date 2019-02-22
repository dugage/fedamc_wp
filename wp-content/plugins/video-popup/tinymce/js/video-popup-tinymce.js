/*
	Video PopUp for TinyMCE | v1.0.0
	By Alobaidi
	http://wp-plugins.in
*/

(function() {

	tinymce.PluginManager.add('video_popup_tinymce', function( editor, url ) {

		editor.addButton( 'video_popup_tinymce', {

			text: false,

			title: editor.getLang('video_popup_translation_vars.b_title'),

			icon: 'vp-mce-icon',

			onclick: function() {
				var vptmceGetSelection = tinyMCE.activeEditor.selection;

				var vptmceSelectedText = vptmceGetSelection.getContent( { format: "text" } );

				if( !vptmceSelectedText ){
					alert( editor.getLang('video_popup_translation_vars.e_alert') );
					return false;
				}

				var vptmceGetHref = vptmceGetSelection.getNode().getAttribute('href');

				var vptmceGetYTID = vptmceGetSelection.getNode().getAttribute('data-ytid');

				if( vptmceGetYTID && ( vptmceGetHref.match(/(youtube.com)/) || vptmceGetHref.match(/(youtu.be)/) ) ){
					var vptmceGetHref = 'https://www.youtube.com/watch?v='+vptmceGetYTID+'';
				}

				var vptmceGetTitle = vptmceGetSelection.getNode().getAttribute('title');

				var vptmceGetAutoplay = vptmceGetSelection.getNode().getAttribute('data-autoplay');

				var vptmceGetRel = vptmceGetSelection.getNode().getAttribute('rel');

				var vptmceGetSoundCloud = vptmceGetSelection.getNode().getAttribute('data-soundcloud');

				var vptmceGetDisWrap = vptmceGetSelection.getNode().getAttribute('data-dwrap');

				if( vptmceGetSoundCloud == '1' ){
					var vptmceGetHref = vptmceGetSelection.getNode().getAttribute('data-soundcloud-url');
				}

				if( vptmceGetAutoplay ){
					var vpmce_autoplayCheckbox = true;
				}else{
					var vpmce_autoplayCheckbox = false;
				}

				if( vptmceGetRel ){
					var vpmce_relCheckbox = true;
				}else{
					var vpmce_relCheckbox = false;
				}

				if( vptmceGetDisWrap || video_popup_translation_vars.unprm_r_border ){
					var vpmce_DisWrap = true;
				}else{
					var vpmce_DisWrap = false;
				}

				var vp_tinymce_screen_height = jQuery(window).height();

				if( vp_tinymce_screen_height < 747 && vp_tinymce_screen_height > 500 ){
					var vp_tinymce_class = 'vp_tinymce_not_hd vp_tinymce_wrap';
				}
				else if( vp_tinymce_screen_height < 501 ){
					var vp_tinymce_class = 'vp_tinymce_is_tab vp_tinymce_wrap';
				}
				else{
					var vp_tinymce_class = 'vp_tinymce_is_hd vp_tinymce_wrap';
				}

				function vp_rec_links(){
					jQuery(document).ready(function(){
						var mk_btn = '<button class="button vp-make-video" title="Free tools to create professional videos, intros, advertisements, animations, slideshows and music visualizations without any technical skills in minutes." onClick="window.open('+"'https://www.renderforest.com/signup?afil_link=fb69b32110f9d9a709086d018bc09701'"+');">Make Video</button>';
						var et_btn = '<button class="button" title="Get collection of 88 WordPress themes for $80 only! Try it, a 30-Day Money Back Guarantee!" onClick="window.open('+"'http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=24967&tid1=vp_plugin_mce&url=35248'"+');">Elegant Themes</button>';
						var divi_btn = '<button class="button" title="'+editor.getLang('video_popup_translation_vars.b_tol_divi')+'" onClick="window.open('+"'http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=24967&url=21533&tid1=vp_plugin_mce_divi'"+');">'+editor.getLang('video_popup_translation_vars.b_txt_divi')+'</button>';
						var mts_btn = '<button class="button" title="Get collection of 102 WordPress themes for $19 only! Try it, a 30-Day Money Back Guarantee!" onClick="window.open('+"'https://mythemeshop.com/theme-category/popular-wordpress-themes/?ref=qassimdev&campaign=vp_plugin_mce'"+');">MyThemeShop</button>';
						var bh_btn = '<button class="button" title="The Best Web and WordPress Hosting. Try it, a 30-Day Money Back Guarantee!" onClick="window.open('+"'https://www.bluehost.com/track/wptime/vp-plugin-mce'"+');">Bluehost</button>';
						var sg_btn = '<button class="button" title="Fastest SSD Web and WordPress Hosting. Try it, a 30-Day Money Back Guarantee!" onClick="window.open('+"'https://www.siteground.com/go/vp_plugin_mce'"+');">SiteGround</button>';
						jQuery(mk_btn+et_btn+divi_btn+mts_btn+bh_btn+sg_btn).appendTo(".mce-vp_rec_links_node");
					});
				}

				editor.windowManager.open( {

					title: editor.getLang('video_popup_translation_vars.w_title'),

					classes: vp_tinymce_class,

					body: [
							{
								type: 'textbox',
								name: 'vpmce_LinkText',
								label: editor.getLang('video_popup_translation_vars.o_l_text'),
								value: vptmceSelectedText,
								minWidth: 750
							},

							{
								type: 'textbox',
								name: 'vpmce_URL',
								label: editor.getLang('video_popup_translation_vars.o_l_url'),
								value: vptmceGetHref,
								minWidth: 750,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_url'),
								classes: 'vpmce_url_c'
							},

							{
								type: 'textbox',
								name: 'vpmce_Title',
								label: editor.getLang('video_popup_translation_vars.o_l_title'),
								value: vptmceGetTitle,
								minWidth: 750,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_title'),
								classes: 'vpmce_title_c'
							},

							{
								type: 'textbox',
								name: 'vpmce_imageLink',
								label: editor.getLang('video_popup_translation_vars.o_l_image_link'),
								value: '',
								minWidth: 750,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_image_link')
							},

							{
								type: 'textbox',
								label: editor.getLang('video_popup_translation_vars.o_l_shortcode'),
								value: video_popup_translation_vars.o_v_shortcode,
								minWidth: 750,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_shortcode'),
								classes: 'vp_shortcode_node_val',
								onclick: function( e ) {
									document.getElementsByClassName('mce-vp_shortcode_node_val')[0].select();
								}
							},

							{
								type: 'checkbox',
								name: 'vpmce_rel_nofollow',
								label: editor.getLang('video_popup_translation_vars.o_l_relnofollow'),
								checked: vpmce_relCheckbox,
								maxWidth: 20,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_relnofollow'),
								classes: 'vpmce_nofollow_c'
							},

							{
								type: 'checkbox',
								name: 'vpmce_autoplay',
								label: editor.getLang('video_popup_translation_vars.o_l_autoplay'),
								maxWidth: 20,
								checked: vpmce_autoplayCheckbox,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_autoplay')
							},

							{
								type: 'checkbox',
								name: 'vpmce_dis_wrap',
								label: editor.getLang('video_popup_translation_vars.o_l_dis_wrap_prm'),
								tooltip: editor.getLang('video_popup_translation_vars.o_t_dis_wrap_prm'),
								checked: vpmce_DisWrap,
								maxWidth: 20
							},

							{
								type: 'checkbox',
								name: 'vpmce_dis_rel',
								label: editor.getLang('video_popup_translation_vars.o_l_dis_rel_vid'),
								checked: false,
								maxWidth: 20,
								disabled: true,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_dis_rel_vid')
							},

							{
								type: 'checkbox',
								name: 'vpmce_dis_controls',
								label: editor.getLang('video_popup_translation_vars.o_l_dis_cont_vid'),
								checked: false,
								maxWidth: 20,
								disabled: true,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_dis_cont_vid')
							},

							{
								type: 'checkbox',
								name: 'vpmce_dis_info',
								label: editor.getLang('video_popup_translation_vars.o_l_dis_info'),
								checked: false,
								maxWidth: 20,
								disabled: true,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_dis_info')
							},

							{
								type: 'checkbox',
								name: 'vpmce_dis_iv',
								label: editor.getLang('video_popup_translation_vars.o_l_dis_iv'),
								checked: false,
								maxWidth: 20,
								disabled: true,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_dis_iv')
							},

							{
								type: 'checkbox',
								name: 'vpmce_display_yt_img',
								label: editor.getLang('video_popup_translation_vars.o_l_display_yt_img'),
								checked: false,
								maxWidth: 20,
								disabled: true,
								tooltip: editor.getLang('video_popup_translation_vars.o_t_display_yt_img')
							},

							{
								type: 'textbox',
								name: 'vpmce_time',
								label: editor.getLang('video_popup_translation_vars.o_l_starting_time'),
								tooltip: editor.getLang('video_popup_translation_vars.o_t_starting_time'),
								value: '',
								disabled: true,
								maxWidth: 76
							},

							{
								type: 'textbox',
								name: 'vpmce_ending_time',
								label: editor.getLang('video_popup_translation_vars.o_l_ending_time'),
								tooltip: editor.getLang('video_popup_translation_vars.o_t_ending_time'),
								value: '',
								disabled: true,
								maxWidth: 76
							},

							{
								type: 'textbox',
								name: 'vpmce_width',
								label: editor.getLang('video_popup_translation_vars.o_l_width'),
								tooltip: editor.getLang('video_popup_translation_vars.o_t_width'),
								value: '',
								disabled: true,
								maxWidth: 76
							},

							{
								type: 'textbox',
								name: 'vpmce_height',
								label: editor.getLang('video_popup_translation_vars.o_l_height'),
								tooltip: editor.getLang('video_popup_translation_vars.o_t_height'),
								value: '',
								disabled: true,
								maxWidth: 76
							},

							{
								type: 'textbox',
								name: 'vpmce_olcolor',
								label: editor.getLang('video_popup_translation_vars.o_l_olcolor'),
								tooltip: editor.getLang('video_popup_translation_vars.o_t_olcolor'),
								value: '',
								disabled: true,
								maxWidth: 76,
								classes: 'vp_overlay_color_node_val'
							},

							{
								type: 'button',
								text: editor.getLang('video_popup_translation_vars.b_txt_doc'),
								tooltip: editor.getLang('video_popup_translation_vars.b_tol_doc'),
								maxWidth: 220,
								classes: 'vp_doc_link_node',
								onclick: function( e ) {
									window.open('https://wp-plugins.in/VideoPopUp-Usage');
								}
							},

							{
								type: 'button',
								text: editor.getLang('video_popup_translation_vars.o_l_shortcode_usage'),
								tooltip: editor.getLang('video_popup_translation_vars.o_t_shortcode_usage'),
								maxWidth: 220,
								classes: 'vp_admin_link_node',
								onclick: function( e ) {
									window.open(video_popup_translation_vars.shortcode_usage);
								}
							},

							{
								type: 'button',
								text: editor.getLang('video_popup_translation_vars.o_l_gen_settings'),
								tooltip: editor.getLang('video_popup_translation_vars.o_t_gen_settings'),
								maxWidth: 220,
								classes: 'vp_admin_link_node',
								onclick: function( e ) {
									window.open(video_popup_translation_vars.gen_settings);
								}
							},

							{
								type: 'button',
								text: editor.getLang('video_popup_translation_vars.o_l_on_pageload'),
								tooltip: editor.getLang('video_popup_translation_vars.o_t_on_pageload'),
								maxWidth: 220,
								classes: 'vp_admin_link_node',
								onclick: function( e ) {
									window.open(video_popup_translation_vars.on_pageload);
								}
							},

							{
								type: 'button',
								text: editor.getLang('video_popup_translation_vars.b_txt_prm_extension'),
								tooltip: editor.getLang('video_popup_translation_vars.b_tol_prm_extension'),
								maxWidth: 220,
								classes: 'vp_buy_extension_btn',
								onclick: function( e ) {
									window.open('https://wp-plugins.in/Get-VP-Premium-Extension');
								}
							},

							{
								type: 'label',
								text: editor.getLang('video_popup_translation_vars.b_txt_rec_links'),
								classes: 'vp_rec_links_node'
							},

							{
								type: 'label',
								style: "font-size:12px !important;color:#0299ad !important; text-decoration:underline !important;",
								text: editor.getLang('video_popup_translation_vars.b_txt_why_see'),
								tooltip: editor.getLang('video_popup_translation_vars.b_tol_why_see'),
								minWidth: 750,
								classes: 'vp_why_ads_node'
							}
					],

					onsubmit: function(e) {

						if( e.data.vpmce_rel_nofollow === true){
							var vpAttrRel = ' rel="nofollow"';
						}else{
							var vpAttrRel = null;
						}

						if( e.data.vpmce_Title ){
							var vpAttrTitle = ' title="'+e.data.vpmce_Title+'"';
						}else{
							var vpAttrTitle = null;
						}

						if( e.data.vpmce_dis_wrap === true){
							var vpAttrDisWrap = ' data-dwrap="1"';
						}else{
							var vpAttrDisWrap = null;
						}

						if( e.data.vpmce_autoplay === true){
							var vpAttrAutoplay = ' data-autoplay="1"';
							var soundcloudAutoPlay = '&vp_soundcloud_a=true';
						}else{
							var vpAttrAutoplay = null;
							var soundcloudAutoPlay = '&vp_soundcloud_a=false';
						}

						if( e.data.vpmce_URL.match(/(soundcloud.com)/) ){
							var link_class = 'vp-sc-type';
						}else if( e.data.vpmce_URL.match(/(vimeo.com)/) ){
							var link_class = 'vp-vim-type';
						}else if( e.data.vpmce_URL.match(/(youtube.com)/) || e.data.vpmce_URL.match(/(youtu.be)/) ){
							var link_class = 'vp-yt-type';
						}else{
							var link_class = 'vp-mp4-type';
						}

						if( vpAttrAutoplay ){
							var vpAttrClass = ' class="vp-a '+link_class+'"';
						}else{
							var vpAttrClass = ' class="vp-s '+link_class+'"';
						}

						if( e.data.vpmce_URL.match(/(soundcloud.com)/) ){
							var vpAttrYouTubeVideoID = null;
							var vp_url = '#';
							var vp_sc_url = video_popup_translation_vars.soundcloud_url + e.data.vpmce_URL + soundcloudAutoPlay;
							var vpAttSoundCloud = ' data-soundcloud="1" data-soundcloud-url="'+e.data.vpmce_URL+'" data-embedsc="'+vp_sc_url+'"';
						}else{
							if( e.data.vpmce_URL ){
								if( e.data.vpmce_URL.match(/(youtu.be)/) || e.data.vpmce_URL.match(/(youtube.com)/) ){
									if( e.data.vpmce_URL.match(/(youtube.com)/) ){
                    					var split_c = "v=";
                    					var split_n = 1;
                					}

                					if( e.data.vpmce_URL.match(/(youtu.be)/) ){
                    					var split_c = "/";
                    					var split_n = 3;
                					}

                					var getYouTubeVideoID = e.data.vpmce_URL.split(split_c)[split_n];

               					 	var cleanVideoID = getYouTubeVideoID.replace(/(&)+(.*)/, "");

               					 	var vpAttrYouTubeVideoID = ' data-ytid="'+cleanVideoID+'"';

               					 	var vp_url = 'https://www.youtube.com/watch?v='+cleanVideoID+'';
								}else{
									var vpAttrYouTubeVideoID = null;
									var vp_url = e.data.vpmce_URL;
								}
							}else{
								var vpAttrYouTubeVideoID = null;
								var vp_url = '#';
							}
							var vpAttSoundCloud = null;
						}

						var vpLinkAttrs = vpAttrTitle+vpAttSoundCloud+vpAttrRel+vpAttrAutoplay+vpAttrDisWrap+vpAttrClass+vpAttrYouTubeVideoID;

						if( e.data.vpmce_imageLink ){
							var vp_get_the_image = '<img class="vp-img" src="'+e.data.vpmce_imageLink+'">';
							var vp_the_element = '<p class="vp-img-paragraph"><a href="'+vp_url+'"'+vpLinkAttrs+'>'+vp_get_the_image+'</a></p>';
						}else{
							var vp_the_element = '<a href="'+vp_url+'"'+vpLinkAttrs+'>'+e.data.vpmce_LinkText+'</a>';
						}

                		editor.insertContent(vp_the_element);
            		}

				})
			
				vp_rec_links();
			}

		});

	});

})();