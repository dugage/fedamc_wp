<?php
/*------------- THEME OPTIONS START -------------*/
function mulada_santanize( $input ) {
		return $input;
}

/*-- FONT CUSTOMIZE START --*/
new theme_customizer();
class theme_customizer
{
    public function __construct()
    {
        add_action( 'customize_register', array(&$this, 'customize_manager_demo' ));
    }

    public function customizer_admin() {
        add_theme_page( esc_html__( 'Customize', 'mulada' ), esc_html__( 'Customize', 'mulada' ), 'edit_theme_options', 'customize.php' );
    }

    public function customize_manager_demo( $wp_manager )
    {
        $this->demo_section( $wp_manager );
        $this->custom_sections( $wp_manager );
    }

    private function demo_section( $wp_manager )
    {
        $wp_manager->add_section( 'customiser_demo_section', array(
            'title'          => esc_html__( 'Default Demo Controls', 'mulada' ),
        ) );
    }

    private function custom_sections( $wp_manager )
    {
        $wp_manager->add_section( 'customiser_demo_custom_section', array(
            'title'          => esc_html__( 'Custom Controls Demo', 'mulada' ),
        ) );

        require_once get_template_directory() . '/include/functions/google-font-dropdown-custom-control.php';
        $wp_manager->add_setting( 'heading-font', array(
            'default'        => '',
			'sanitize_callback' => 'mulada_santanize'
        ) );
		
        $wp_manager->add_control( new mulada_Google_Font_Dropdown_Custom_Control( $wp_manager, 'heading-font', array(
            'label'   => esc_html__( 'Heading Font', 'mulada' ),
            'section' => 'font',
            'settings'   => 'heading-font',
        ) ) );
		
        $wp_manager->add_setting( 'text-font', array(
            'default'        => '',
			'sanitize_callback' => 'mulada_santanize'
        ) );
		
        $wp_manager->add_control( new mulada_Google_Font_Dropdown_Custom_Control( $wp_manager, 'text-font', array(
            'label'   => esc_html__( 'Text Font', 'mulada' ),
            'section' => 'font',
            'settings'   => 'text-font',
        ) ) );
		
        $wp_manager->add_setting( 'menu-font', array(
            'default'        => '',
			'sanitize_callback' => 'mulada_santanize'
        ) );
		
        $wp_manager->add_control( new mulada_Google_Font_Dropdown_Custom_Control( $wp_manager, 'menu-font', array(
            'label'   => esc_html__('Menu Font', 'mulada' ),
            'section' => 'font',
            'settings'   => 'menu-font',
        ) ) );
		
        $wp_manager->add_setting( 'theme-one-font', array(
            'default'        => 'Droid Serif',
			'sanitize_callback' => 'mulada_santanize'
        ) );
		
        $wp_manager->add_control( new mulada_Google_Font_Dropdown_Custom_Control( $wp_manager, 'theme-one-font', array(
            'label'   => esc_html__('Theme One Font', 'mulada' ),
            'section' => 'font',
            'settings'   => 'theme-one-font',
        ) ) );
		
        $wp_manager->add_setting( 'theme-two-font', array(
            'default'        => 'Droid Sans',
			'sanitize_callback' => 'mulada_santanize'
        ) );
		
        $wp_manager->add_control( new mulada_Google_Font_Dropdown_Custom_Control( $wp_manager, 'theme-two-font', array(
            'label'   => esc_html__('Theme Two Font', 'mulada' ),
            'section' => 'font',
            'settings'   => 'theme-two-font',
        ) ) );
    }

}
/*-- FONT CUSTOMIZE END --*/

function mulada_customizer( $wp_customize ) {

/*-- FONTS START --*/
	$wp_customize->add_section( 'font', array(
        'title' => esc_html__( 'Fonts', 'mulada' ),
        'description' => esc_html__( 'Theme font settings.', 'mulada' ),
    ) );
	
/*-- FONT FAMILY STYLE --*/
	$wp_customize->add_setting( 'font_family_style', array(
		'default' => '900italic,900,800italic,800,700,700italic,600,600italic,500,500italic,400,400italic,300,300italic,200,200italic,100,100italic',
		'sanitize_callback' => 'jupios_santanize'
	) );

	$wp_customize->add_control( 'font_family_style', array(
		'label' => esc_html__( 'Font Styles', 'mulada' ),
		'section' => 'font',
	) );

/*-- CYRILLIC EXT FONT --*/
	$wp_customize->add_setting( 'font_cyrillic_ext', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'font_cyrillic_ext', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Include Cyrillic Extended (cyrillic-ext)', 'mulada' ),
        'section' => 'font',
    ) );

/*-- GREEK EXT FONT --*/
	$wp_customize->add_setting( 'font_greek_ext', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'font_greek_ext', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Include Greek Extended (greek-ext)', 'mulada' ),
        'section' => 'font',
    ) );

/*-- GREEK FONT --*/
	$wp_customize->add_setting( 'font_greek', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'font_greek', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Include Greek (greek)', 'mulada' ),
        'section' => 'font',
    ) );

/*-- VIETNAMESE FONT --*/
	$wp_customize->add_setting( 'font_vietnamese', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'font_vietnamese', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Include Vietnamese (vietnamese)', 'mulada' ),
        'section' => 'font',
    ) );

/*-- CYRILLIC FONT --*/
	$wp_customize->add_setting( 'font_cyrillic', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'font_cyrillic', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Include Cyrillic (cyrillic)', 'mulada' ),
        'section' => 'font',
    ) );
	
/*-- H1 --*/
	$wp_customize->add_setting( 'h1_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'h1_font_size', array(
		'label' => esc_html__( 'h1', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- H2 --*/
	$wp_customize->add_setting( 'h2_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'h2_font_size', array(
		'label' => esc_html__( 'h2', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- H3 --*/
	$wp_customize->add_setting( 'h3_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'h3_font_size', array(
		'label' => esc_html__( 'h3', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- H4 --*/
	$wp_customize->add_setting( 'h4_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'h4_font_size', array(
		'label' => esc_html__( 'h4', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- H5 --*/
	$wp_customize->add_setting( 'h5_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'h5_font_size', array(
		'label' => esc_html__( 'h5', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- H6 --*/
	$wp_customize->add_setting( 'h6_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'h6_font_size', array(
		'label' => esc_html__( 'h6', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- BODY FONT SIZE --*/
	$wp_customize->add_setting( 'body_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'body_font_size', array(
		'label' => esc_html__( 'Body Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- BODY LINE HEIGHT  --*/
	$wp_customize->add_setting( 'body_line_height', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'body_line_height', array(
		'label' => esc_html__( 'Body Font Line Height (Exm. 1.8)', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- MENU FONT SIZE --*/
	$wp_customize->add_setting( 'menu_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'menu_font_size', array(
		'label' => esc_html__( 'Header Menu Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- SUB MENU FONT SIZE --*/
	$wp_customize->add_setting( 'sub_menu_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'sub_menu_font_size', array(
		'label' => esc_html__( 'Header Submenu Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- POST CONTENT FONT SIZE --*/
	$wp_customize->add_setting( 'post_content_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'post_content_font_size', array(
		'label' => esc_html__( 'Post Content Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- POST TITLE FONT SIZE --*/
	$wp_customize->add_setting( 'post_title_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'post_title_font_size', array(
		'label' => esc_html__( 'Post Title Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- POST TAGS FONT SIZE --*/
	$wp_customize->add_setting( 'post_tags_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'post_tags_font_size', array(
		'label' => esc_html__( 'Post Tags Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- PAGE CONTENT FONT SIZE --*/
	$wp_customize->add_setting( 'page_content_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'page_content_font_size', array(
		'label' => esc_html__( 'Page Content Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- PAGE TITLE FONT SIZE --*/
	$wp_customize->add_setting( 'page_title_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'page_title_font_size', array(
		'label' => esc_html__( 'Page Title Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- HOME WIDGET & SIDEBAR FONT SIZE --*/
	$wp_customize->add_setting( 'home_widget_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'home_widget_font_size', array(
		'label' => esc_html__( 'Home & Sidebar Widget Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- FOOTER WIDGET FONT SIZE --*/
	$wp_customize->add_setting( 'footer_widget_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'footer_widget_font_size', array(
		'label' => esc_html__( 'Footer Widget Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- FOOTER CONTENT FONT SIZE --*/
	$wp_customize->add_setting( 'footer_content_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'footer_content_font_size', array(
		'label' => esc_html__( 'Footer Content Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- COPYRIGHT FONT SIZE --*/
	$wp_customize->add_setting( 'copyright_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'copyright_font_size', array(
		'label' => esc_html__( 'Footer Copyright Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- BLOCKQUOTE FONT SIZE --*/
	$wp_customize->add_setting( 'blockquote_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'blockquote_font_size', array(
		'label' => esc_html__( 'Blockquote Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- CATEGORY TITLE FONT SIZE --*/
	$wp_customize->add_setting( 'category_title_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'category_title_font_size', array(
		'label' => esc_html__( 'Category Title Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- CATEGORY TITLE NAME FONT SIZE --*/
	$wp_customize->add_setting( 'category_title_name_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'category_title_name_font_size', array(
		'label' => esc_html__( 'Category Title Name Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- 404 TITLE FONT ONE SIZE --*/
	$wp_customize->add_setting( 'error_text_one_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'error_text_one_font_size', array(
		'label' => esc_html__( '404 Text One Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- 404 TEXT FONT TWO SIZE --*/
	$wp_customize->add_setting( 'error_text_two_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'error_text_two_font_size', array(
		'label' => esc_html__( '404 Text Two Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- INPUT FONT SIZE --*/
	$wp_customize->add_setting( 'input_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'input_font_size', array(
		'label' => esc_html__( 'Input Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
	
/*-- BUTTON FONT SIZE --*/
	$wp_customize->add_setting( 'button_font_size', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'button_font_size', array(
		'label' => esc_html__( 'Button Font Size', 'mulada' ),
        'type' => 'number',
		'section' => 'font',
	) );
/*-- FONTS END --*/

/*-- GENERAL START --*/
	$wp_customize->add_section( 'generalsettings', array(
        'title' => esc_html__( 'General', 'mulada' ),
        'description' => esc_html__( 'General theme settings.', 'mulada' ),
    ) );
	
/*-- SIDEBAR POSITION --*/
	$wp_customize->add_setting( 'sidebar_position', array(
		'default' => 'right',
		'sanitize_callback' => 'mulada_santanize'
	) );
	 
	$wp_customize->add_control( 'sidebar_position', array(
		'type' => 'radio',
		'label' => esc_html__( 'General Sidebar Position', 'mulada' ),
		'section' => 'generalsettings',
		'choices' => array(
			'left' => esc_html__( 'Left', 'mulada' ),
			'right' => esc_html__( 'Right', 'mulada' ),
			'nosidebar' => esc_html__( 'Sidebar None', 'mulada' ),
		),
	) );
	
/*-- LAYOUT STYLE --*/
	$wp_customize->add_setting( 'layout_style', array(
		'default' => 'default',
		'sanitize_callback' => 'mulada_santanize'
	) );
	 
	$wp_customize->add_control( 'layout_style', array(
		'type' => 'radio',
		'label' => esc_html__( 'Layout Style', 'mulada' ),
		'section' => 'generalsettings',
		'choices' => array(
			'default' => esc_html__( 'Default', 'mulada' ),
			'boxed' => esc_html__( 'Boxed', 'mulada' ),
		),
	) );
	
/*-- LOADER --*/
	$wp_customize->add_setting( 'mulada_loader', array(
		'default' => 'active',
		'sanitize_callback' => 'mulada_santanize'
	) );
	 
	$wp_customize->add_control( 'mulada_loader', array(
		'type' => 'radio',
		'label' => esc_html__( 'Loader', 'mulada' ),
		'section' => 'generalsettings',
		'choices' => array(
			'active' => esc_html__( 'Active', 'mulada' ),
			'inactive' => esc_html__( 'Inactive', 'mulada' ),
		),
	) );
/*-- GENERAL END --*/

/*-- HEADER START --*/
	$wp_customize->add_section( 'headerelement', array(
        'title' => esc_html__( 'Header', 'mulada' ),
        'description' => esc_html__( 'Theme header settings.', 'mulada' ),
    ) );
	
/*-- HEADER LOGO --*/
	$wp_customize->add_setting( 'mulada_logo', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
 
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mulada_logo', array(
        'label'    => esc_html__( 'Header Logo Upload', 'mulada' ),
		'section' => 'headerelement',
    ) ) );
	
/*-- HEADER SEARCH HIDE --*/
	$wp_customize->add_setting( 'hide_header_search', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_header_search', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Header Search', 'mulada' ),
        'section' => 'headerelement',
    ) );

/*-- ALTERNATIVE HEADER SOCIAL MEDIA HIDE --*/
	$wp_customize->add_setting( 'hide_alternative_header_social', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_alternative_header_social', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Alternative Header Social Media', 'mulada' ),
        'section' => 'headerelement',
    ) );

/*-- HEADER MENU BUTTON HIDE --*/
	$wp_customize->add_setting( 'hide_header_menu_button', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_header_menu_button', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Header Menu Button', 'mulada' ),
        'section' => 'headerelement',
    ) );
	
/*-- HEADER TOP --*/
	$wp_customize->add_setting( 'header_fixed', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'header_fixed', array(
		'label' => esc_html__( 'Header Fixed', 'mulada' ),
        'type' => 'checkbox',
        'section' => 'headerelement',
	) );
	
/*-- HEADER LOGO HEIGHT --*/
	$wp_customize->add_setting( 'logo_height', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'logo_height', array(
		'label' => esc_html__( 'Logo Height (px)', 'mulada' ),
        'type' => 'number',
        'section' => 'headerelement',
	) );
	
/*-- HEADER LOGO WIDTH --*/
	$wp_customize->add_setting( 'logo_width', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'logo_width', array(
		'label' => esc_html__( 'Logo Width (px)', 'mulada' ),
        'type' => 'number',
        'section' => 'headerelement',
	) );
/*-- HEADER END --*/

/*-- CATEGORY & ARCHIVE START --*/
	$wp_customize->add_section( 'categoryarchive', array(
        'title' => esc_html__( 'Category & Archive', 'mulada' ),
        'description' => esc_html__( 'Theme category & archive settings.', 'mulada' ),
    ) );

/*-- CATEGORY & ARCHIVE EXCERPT HIDE --*/
	$wp_customize->add_setting( 'hide_categoryarchive_excerpt', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_categoryarchive_excerpt', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Excerpt', 'mulada' ),
		'section' => 'categoryarchive',
    ) );

/*-- CATEGORY & ARCHIVE CATEGORY NAME HIDE --*/
	$wp_customize->add_setting( 'hide_categoryarchive_name', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_categoryarchive_name', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Category Name', 'mulada' ),
		'section' => 'categoryarchive',
    ) );

/*-- CATEGORY & ARCHIVE POST SHARE --*/
	$wp_customize->add_setting( 'hide_categoryarchive_post_share', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_categoryarchive_post_share', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Post Share', 'mulada' ),
		'section' => 'categoryarchive',
    ) );

/*-- CATEGORY & ARCHIVE POST INFORMATION HIDE --*/
	$wp_customize->add_setting( 'hide_categoryarchive_post_information', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_categoryarchive_post_information', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Post Information', 'mulada' ),
		'section' => 'categoryarchive',
    ) );

/*-- CATEGORY & ARCHIVE POST READ MORE HIDE --*/
	$wp_customize->add_setting( 'hide_categoryarchive_post_read_more', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_categoryarchive_post_read_more', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Post Read More', 'mulada' ),
		'section' => 'categoryarchive',
    ) );

/*-- CATEGORY & ARCHIVE POST FEATURED IMAGE HIDE --*/
	$wp_customize->add_setting( 'hide_categoryarchive_featured_image', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_categoryarchive_featured_image', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Post Featured Image', 'mulada' ),
		'section' => 'categoryarchive',
    ) );

/*-- CATEGORY & ARCHIVE TITLE HIDE --*/
	$wp_customize->add_setting( 'hide_categoryarchive_title', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_categoryarchive_title', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Category & Archive Title', 'mulada' ),
		'section' => 'categoryarchive',
    ) );

/*-- HOME TITLE HIDE --*/
	$wp_customize->add_setting( 'hide_home_title', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_home_title', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Home Title', 'mulada' ),
		'section' => 'categoryarchive',
    ) );
/*-- CATEGORY & ARCHIVE END --*/

/*-- PAGES & POSTS START --*/
	$wp_customize->add_section( 'pagepost', array(
        'title' => esc_html__( 'Pages & Posts', 'mulada' ),
        'description' => esc_html__( 'The settings of the page and post.', 'mulada' ),
    ) );

/*-- RELATED POSTS HIDE --*/
	$wp_customize->add_setting( 'hide_related_posts', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_related_posts', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Related Posts', 'mulada' ),
        'section' => 'pagepost',
    ) );
	
/*-- POST AUTHOR INFO HIDE --*/
	$wp_customize->add_setting( 'hide_post_author_info', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_post_author_info', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Post Author Info', 'mulada' ),
        'section' => 'pagepost',
    ) );
	
/*-- POST NAVIGATION HIDE --*/
	$wp_customize->add_setting( 'hide_post_navigation', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_post_navigation', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Post Navigation', 'mulada' ),
        'section' => 'pagepost',
    ) );
	
/*-- POST FEATURED IMAGE HIDE --*/
	$wp_customize->add_setting( 'hide_post_featured_image', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_post_featured_image', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Post Featured Image', 'mulada' ),
        'section' => 'pagepost',
    ) );
	
/*-- POST COMMENT AREA HIDE --*/
	$wp_customize->add_setting( 'hide_post_comment', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_post_comment', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Post Comment Area', 'mulada' ),
        'section' => 'pagepost',
    ) );
	
/*-- POST INFORMATION HIDE --*/
	$wp_customize->add_setting( 'hide_post_information', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_post_information', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Hide Post Information', 'mulada' ),
		'section' => 'pagepost',
	) );
	
/*-- POST SHARE HIDE --*/
	$wp_customize->add_setting( 'hide_post_share', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_post_share', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Hide Post Share', 'mulada' ),
		'section' => 'pagepost',
	) );
	
/*-- POST TAGS HIDE --*/
	$wp_customize->add_setting( 'hide_post_tags', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_post_tags', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Hide Post Tags', 'mulada' ),
		'section' => 'pagepost',
	) );
	
/*-- POST RELATED LIMIT --*/
	$wp_customize->add_setting( 'post_related_limit', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'post_related_limit', array(
		'label' => esc_html__( 'Post Related Posts Count', 'mulada' ),
        'type' => 'number',
		'section' => 'pagepost',
	) );	
/*-- PAGES & POSTS SETINGS END --*/

/*-- SOCIAL MEDIA START --*/
	$wp_customize->add_section( 'socialmedia', array(
		'title' => esc_html__( 'Social Media', 'mulada' ),
        'description' => esc_html__( 'The settings of the social media.', 'mulada' ),
	) );
	
/*-- FACEBOOK --*/
	$wp_customize->add_setting( 'mulada_facebook', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_facebook', array(
		'label' => esc_html__( 'Facebook URL', 'mulada' ),
		'section' => 'socialmedia',
	) );

/*-- GOOGLE PLUS --*/
	$wp_customize->add_setting( 'mulada_googleplus', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_googleplus', array(
		'label' => esc_html__( 'Google+ URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- INSTAGRAM --*/
	$wp_customize->add_setting( 'mulada_instagram', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_instagram', array(
		'label' => esc_html__( 'Instagram URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- LINKEDIN --*/
	$wp_customize->add_setting( 'mulada_linkedin', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_linkedin', array(
		'label' => esc_html__( 'Linkedin URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- VINE --*/
	$wp_customize->add_setting( 'mulada_vine', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_vine', array(
		'label' => esc_html__( 'Vine URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
		
/*-- TWITTER --*/
	$wp_customize->add_setting( 'mulada_twitter', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_twitter', array(
		'label' => esc_html__( 'Twitter URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
		
/*-- PINTEREST --*/
	$wp_customize->add_setting( 'mulada_pinterest', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_pinterest', array(
		'label' => esc_html__( 'Pinterest URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
		
/*-- RSS --*/
	$wp_customize->add_setting( 'mulada_rss', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_rss', array(
		'label' => esc_html__( 'RSS URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- YOUTUBE --*/
	$wp_customize->add_setting( 'mulada_youtube', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_youtube', array(
		'label' => esc_html__( 'YouTube URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- BEHANCE --*/
	$wp_customize->add_setting( 'mulada_behance', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_behance', array(
		'label' => esc_html__( 'Behance URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- DEVIANTART --*/
	$wp_customize->add_setting( 'mulada_deviantart', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_deviantart', array(
		'label' => esc_html__( 'DeviantArt URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- DIGG --*/
	$wp_customize->add_setting( 'mulada_digg', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_digg', array(
		'label' => esc_html__( 'Digg URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- DRIBBBLE --*/
	$wp_customize->add_setting( 'mulada_dribbble', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_dribbble', array(
		'label' => esc_html__( 'Dribbble URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- FLICKR --*/
	$wp_customize->add_setting( 'mulada_flickr', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_flickr', array(
		'label' => esc_html__( 'Flickr URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- GITHUB --*/
	$wp_customize->add_setting( 'mulada_github', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_github', array(
		'label' => esc_html__( 'GitHub URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- LAST.FM --*/
	$wp_customize->add_setting( 'mulada_lastfm', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_lastfm', array(
		'label' => esc_html__( 'Last.fm URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- REDDIT --*/
	$wp_customize->add_setting( 'mulada_reddit', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_reddit', array(
		'label' => esc_html__( 'Reddit URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- SOUNDCLOUD --*/
	$wp_customize->add_setting( 'mulada_soundcloud', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_soundcloud', array(
		'label' => esc_html__( 'SoundCloud URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- TUMBLR --*/
	$wp_customize->add_setting( 'mulada_tumblr', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_tumblr', array(
		'label' => esc_html__( 'Tumblr URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- VIMEO --*/
	$wp_customize->add_setting( 'mulada_vimeo', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_vimeo', array(
		'label' => esc_html__( 'Vimeo URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- VK --*/
	$wp_customize->add_setting( 'mulada_vk', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_vk', array(
		'label' => esc_html__( 'VK URL', 'mulada' ),
		'section' => 'socialmedia',
	) );
	
/*-- MEDIUM --*/
	$wp_customize->add_setting( 'mulada_medium', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'mulada_medium', array(
		'label' => esc_html__( 'Medium URL', 'mulada' ),
		'section' => 'socialmedia',
	) );

/*-- GENERAL POST SHARE HIDE --*/
	$wp_customize->add_setting( 'hide_general_post_share', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_general_post_share', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide General Post Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );

/*-- USER PROFILE SOCIAL LINKS HIDE --*/
	$wp_customize->add_setting( 'user_profile_social_links_hide', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'user_profile_social_links_hide', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide User Profile Social Links', 'mulada' ),
        'section' => 'socialmedia',
    ) );

/*-- SOCIAL SHARE HIDE --*/
	$wp_customize->add_setting( 'social_share_hide', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_hide', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Post Social Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );

/*-- SOCIAL SHARE ICONS --*/
	$wp_customize->add_setting( 'social_share_facebook', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_facebook', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Facebook Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_twitter', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_twitter', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Twitter Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_googleplus', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_googleplus', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Google+ Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_linkedin', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_linkedin', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Linkedin Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_pinterest', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_pinterest', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Pinterest Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_reddit', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_reddit', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Reddit Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_delicious', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_delicious', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Delicious Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_stumbleupon', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_stumbleupon', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Stumbleupon Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_tumblr', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_tumblr', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Tumblr Share', 'mulada' ),
        'section' => 'socialmedia',
    ) );
/*-- SOCIAL MEDIA END  --*/

/*-- FOOTER START --*/	
	$wp_customize->add_section( 'footer', array(
        'title' => esc_html__( 'Footer', 'mulada' ),
        'description' => esc_html__( 'Theme footer settings.', 'mulada' ),
    ) );

/*-- FOOTER SOCIAL MEDIA  HIDE --*/
	$wp_customize->add_setting( 'hide_footer_social_media', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_footer_social_media', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Footer Social Media', 'mulada' ),
        'section' => 'footer',
    ) );

/*-- FOOTER TOP WIDGET HIDE --*/
	$wp_customize->add_setting( 'hide_top_footer_widget', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_top_footer_widget', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Footer Top Widget Area', 'mulada' ),
        'section' => 'footer',
    ) );

/*-- FOOTER BOTTOM WIDGET HIDE --*/
	$wp_customize->add_setting( 'hide_bottom_footer_widget', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_bottom_footer_widget', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Footer Bottom Widget Area', 'mulada' ),
        'section' => 'footer',
    ) );
	
/*-- FOOTER HIDE --*/
	$wp_customize->add_setting( 'hide_footer', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_footer', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Footer', 'mulada' ),
        'section' => 'footer',
    ) );
	
/*-- COPYRIGHT HIDE --*/
	$wp_customize->add_setting( 'hide_copyright', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_copyright', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Copyright', 'mulada' ),
        'section' => 'footer',
    ) );
	
/*-- FOOTER LOGO HIDE --*/
	$wp_customize->add_setting( 'hide_footer_logo', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( 'hide_footer_logo', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Footer Logo', 'mulada' ),
        'section' => 'footer',
    ) );
	
/*-- FOOTER LOGO --*/
	$wp_customize->add_setting( 'mulada_footer_logo', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
 
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mulada_footer_logo', array(
        'label'    => esc_html__( 'Footer Logo Upload', 'mulada' ),
		'section' => 'footer',
    ) ) );
	
/*-- FOOTER SOCIAL MEDIA BACKGROUND --*/
	$wp_customize->add_setting( 'mulada_social_media_bg', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
 
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mulada_social_media_bg', array(
        'label'    => esc_html__( 'Footer Social Media Background Upload', 'mulada' ),
		'section' => 'footer',
    ) ) );
	
/*-- COPYRIGHT TEXT --*/
	$wp_customize->add_setting( 'copyright_text', array(
		'default' => esc_html__( '', 'mulada' ),
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'copyright_text', array(
		'label' => esc_html__( 'Copyright Text', 'mulada' ),
        'section' => 'footer',
	) );
/*-- FOOTER END --*/	

/*-- CUSTOM COLOR START --*/
/*-- WRAPPER BACKGROUND --*/	
	$wp_customize->add_setting( 'wrapper_background', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wrapper_background', array(
		'label' => esc_html__( 'Wrapper Background', 'mulada' ),
		'section' => 'colors',
		'settings' => 'wrapper_background',
	) ) );
	
/*-- THEME COLOR ONE --*/	
	$wp_customize->add_setting( 'theme_color_one', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_color_one', array(
		'label' => esc_html__( 'Theme Color One', 'mulada' ),
		'section' => 'colors',
		'settings' => 'theme_color_one',
	) ) );
	
/*-- THEME COLOR TWO --*/	
	$wp_customize->add_setting( 'theme_color_two', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_color_two', array(
		'label' => esc_html__( 'Theme Color Two', 'mulada' ),
		'section' => 'colors',
		'settings' => 'theme_color_two',
	) ) );
	
/*-- BODY TEXT COLOR --*/	
	$wp_customize->add_setting( 'body_text_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_text_color', array(
		'label' => esc_html__( 'Body Text Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'body_text_color',
	) ) );
	
/*-- HEADER BACKGROUND --*/	
	$wp_customize->add_setting( 'header_background', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background', array(
		'label' => esc_html__( 'Header Background', 'mulada' ),
		'section' => 'colors',
		'settings' => 'header_background',
	) ) );
	
/*-- HEADER MENU LINK COLOR --*/	
	$wp_customize->add_setting( 'header_menu_link_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_menu_link_color', array(
		'label' => esc_html__( 'Header Menu Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'header_menu_link_color',
	) ) );
	
/*-- HEADER SUB MENU LINK COLOR --*/	
	$wp_customize->add_setting( 'header_sub_menu_link_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_sub_menu_link_color', array(
		'label' => esc_html__( 'Header Submenu Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'header_sub_menu_link_color',
	) ) );
	
/*-- HEADER SUB MENU BACKGROUND --*/	
	$wp_customize->add_setting( 'header_sub_menu_background', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_sub_menu_background', array(
		'label' => esc_html__( 'Header Submenu Background', 'mulada' ),
		'section' => 'colors',
		'settings' => 'header_sub_menu_background',
	) ) );
	
/*-- HEADER CATEGORY MENU BACKGROUND --*/	
	$wp_customize->add_setting( 'header_cat_menu_background', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_cat_menu_background', array(
		'label' => esc_html__( 'Header Category Menu Background', 'mulada' ),
		'section' => 'colors',
		'settings' => 'header_cat_menu_background',
	) ) );

/*-- FEATURED POSTS BORDER COLOR --*/	
	$wp_customize->add_setting( 'slider_border_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'slider_border_color', array(
		'label' => esc_html__( 'Featured Posts Border Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'slider_border_color',
	) ) );

/*-- SITE CONTENT BACKGROUND --*/	
	$wp_customize->add_setting( 'site_content_background', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_content_background', array(
		'label' => esc_html__( 'Site Content (Widget, Page & Post) Background', 'mulada' ),
		'section' => 'colors',
		'settings' => 'site_content_background',
	) ) );

/*-- BLOCKQUOTE COLOR --*/	
	$wp_customize->add_setting( 'blockquote_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blockquote_color', array(
		'label' => esc_html__( 'Blockquote Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'blockquote_color',
	) ) );

/*-- HEADING COLOR --*/	
	$wp_customize->add_setting( 'heading_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_color', array(
		'label' => esc_html__( 'Heading Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'heading_color',
	) ) );

/*-- LINK COLOR --*/	
	$wp_customize->add_setting( 'link_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label' => esc_html__( 'Link Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'link_color',
	) ) );

/*-- LINK HOVER COLOR --*/	
	$wp_customize->add_setting( 'link_hover_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
		'label' => esc_html__( 'Link Hover Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'link_hover_color',
	) ) );

/*-- FOOTER BACKGROUND --*/	
	$wp_customize->add_setting( 'footer_background', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background', array(
		'label' => esc_html__( 'Footer Background', 'mulada' ),
		'section' => 'colors',
		'settings' => 'footer_background',
	) ) );

/*-- FOOTER TEXT COLOR --*/	
	$wp_customize->add_setting( 'footer_text_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
		'label' => esc_html__( 'Footer Text Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'footer_text_color',
	) ) );

/*-- COPYRIGHT TEXT COLOR --*/	
	$wp_customize->add_setting( 'copyright_text_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_text_color', array(
		'label' => esc_html__( 'Footer Copyright Text Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'copyright_text_color',
	) ) );

/*-- INPUT BORDER COLOR --*/	
	$wp_customize->add_setting( 'input_border_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'input_border_color', array(
		'label' => esc_html__( 'Input Border Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'input_border_color',
	) ) );

/*-- INPUT TEXT COLOR --*/	
	$wp_customize->add_setting( 'input_text_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'input_text_color', array(
		'label' => esc_html__( 'Input Text Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'input_text_color',
	) ) );

/*-- INPUT BACKGROUND --*/	
	$wp_customize->add_setting( 'input_background', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'input_background', array(
		'label' => esc_html__( 'Input Background', 'mulada' ),
		'section' => 'colors',
		'settings' => 'input_background',
	) ) );

/*-- BUTTON BACKGROUND --*/	
	$wp_customize->add_setting( 'button_background', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_background', array(
		'label' => esc_html__( 'Button Background', 'mulada' ),
		'section' => 'colors',
		'settings' => 'button_background',
	) ) );

/*-- BUTTON BACKGROUND --*/	
	$wp_customize->add_setting( 'button_hover_background', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_hover_background', array(
		'label' => esc_html__( 'Button Hover Background', 'mulada' ),
		'section' => 'colors',
		'settings' => 'button_hover_background',
	) ) );

/*-- BUTTON COLOR --*/	
	$wp_customize->add_setting( 'button_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_color', array(
		'label' => esc_html__( 'Button Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'button_color',
	) ) );

/*-- TAGS WIDGET COLOR --*/	
	$wp_customize->add_setting( 'tags_widget_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tags_widget_color', array(
		'label' => esc_html__( 'Tags Widget Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'tags_widget_color',
	) ) );

/*-- TAGS WIDGET COLOR --*/	
	$wp_customize->add_setting( 'tags_widget_border_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tags_widget_border_color', array(
		'label' => esc_html__( 'Tags Widget Border Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'tags_widget_border_color',
	) ) );

/*-- HOME WIDGET TITLE COLOR --*/	
	$wp_customize->add_setting( 'home_widget_title_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'home_widget_title_color', array(
		'label' => esc_html__( 'Home Widget Title Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'home_widget_title_color',
	) ) );

/*-- HOME WIDGET BORDER COLOR --*/	
	$wp_customize->add_setting( 'home_widget_border_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'home_widget_border_color', array(
		'label' => esc_html__( 'Home Widget Border Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'home_widget_border_color',
	) ) );

/*-- FOOTER WIDGET TITLE COLOR --*/	
	$wp_customize->add_setting( 'footer_widget_title_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_widget_title_color', array(
		'label' => esc_html__( 'Footer Widget Title Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'footer_widget_title_color',
	) ) );

/*-- FOOTER WIDGET BORDER COLOR --*/	
	$wp_customize->add_setting( 'footer_widget_border_color', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_widget_border_color', array(
		'label' => esc_html__( 'Footer Border Color', 'mulada' ),
		'section' => 'colors',
		'settings' => 'footer_widget_border_color',
	) ) );
/*-- CUSTOM COLOR END --*/	

/*-- CUSTOM CODE START --*/	
	$wp_customize->add_section( 'customcode', array(
        'title' => esc_html__( 'Custom Codes', 'mulada' ),
        'description' => esc_html__( 'Your custom codes.', 'mulada' ),
    ) );
	
/*-- CUSTOM CSS  --*/
	$wp_customize->add_setting( 'custom_css', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'custom_css', array(
		'label' => esc_html__( 'Custom CSS Codes', 'mulada' ),
        'type'       => 'textarea',
		'section' => 'customcode',
	) );
	
/*-- CUSTOM JS  --*/
	$wp_customize->add_setting( 'custom_js', array(
		'default' => '',
		'sanitize_callback' => 'mulada_santanize'
	) );

	$wp_customize->add_control( 'custom_js', array(
		'label' => esc_html__( 'Custom JavaScript Codes', 'mulada' ),
        'type'       => 'textarea',
		'section' => 'customcode',
	) );
/*-- CUSTOM CODE END --*/

}
add_action( 'customize_register', 'mulada_customizer', 11 );

/*-- THEME CUSTOM STYLE FUNCTION START --*/
function mulada_custom_style() {
	?>
		<style type="text/css">
			<?php
			$heading_font = get_theme_mod( 'heading-font' );
			$text_font = get_theme_mod( 'text-font' );
			$menu_font = get_theme_mod( 'menu-font' );
			$theme_one_font = get_theme_mod( 'theme-one-font' );
			$theme_two_font = get_theme_mod( 'theme-two-font' );
			
			$font_family_style = get_theme_mod( 'font_family_style' );
			if( !$font_family_style == '' ):
				$font_family_style = get_theme_mod( 'font_family_style' );
			else:
				$font_family_style = '';
			endif;
			
			$font_cyrillic_ext = get_theme_mod( 'font_cyrillic_ext' );
			if( $font_cyrillic_ext == '1' ):
				$font_cyrillic_ext = ',cyrillic-ext';
			else:
				$font_cyrillic_ext = '';
			endif;
			
			$font_greek_ext = get_theme_mod( 'font_greek_ext' );
			if( $font_greek_ext == '1' ):
				$font_greek_ext = ',greek-ext';
			else:
				$font_greek_ext = '';
			endif;
			
			$font_greek = get_theme_mod( 'font_greek' );
			if( $font_greek == '1' ):
				$font_greek = ',greek';
			else:
				$font_greek = '';
			endif;
			
			$font_vietnamese = get_theme_mod( 'font_vietnamese' );
			if( $font_vietnamese == '1' ):
				$font_vietnamese = ',vietnamese';
			else:
				$font_vietnamese = '';
			endif;
			
			$font_cyrillic = get_theme_mod( 'font_cyrillic' );
			if( $font_cyrillic == '1' ):
				$font_cyrillic = ',cyrillic';
			else:
				$font_cyrillic = '';
			endif;
			
			$font_character_set_select = $font_cyrillic_ext . $font_greek_ext . $font_greek . $font_vietnamese . $font_cyrillic;
			
			if( !$heading_font == '' and $heading_font != 'Select' ):
				$google_heading_font = str_replace(' ', '+', $heading_font);
			?>
				@import url(https://fonts.googleapis.com/css?family=<?php echo esc_attr( $google_heading_font ); ?>:<?php echo esc_attr( $font_family_style ); ?>&subset=latin,latin-ext<?php echo esc_attr( $font_character_set_select ); ?>);
			<?php endif;
			if( !$text_font == '' and $text_font != 'Select' ):
				$google_text_font = str_replace(' ', '+', $text_font);
			?>
				@import url(https://fonts.googleapis.com/css?family=<?php echo esc_attr( $google_text_font ); ?>:<?php echo esc_attr( $font_family_style ); ?>&subset=latin,latin-ext<?php echo esc_attr( $font_character_set_select ); ?>);
			<?php endif;
			if( !$menu_font == '' and $menu_font != 'Select' ):
				$google_menu_font = str_replace(' ', '+', $menu_font);
			?>
				@import url(https://fonts.googleapis.com/css?family=<?php echo esc_attr( $google_menu_font ); ?>:<?php echo esc_attr( $font_family_style ); ?>&subset=latin,latin-ext<?php echo esc_attr( $font_character_set_select ); ?>);
			<?php endif;
			if( !$theme_one_font == '' and $theme_one_font != 'Select' ):
				$google_theme_one_font = str_replace(' ', '+', $theme_one_font);
			?>
				@import url(https://fonts.googleapis.com/css?family=<?php echo esc_attr( $google_theme_one_font ); ?>:<?php echo esc_attr( $font_family_style ); ?>&subset=latin,latin-ext<?php echo esc_attr( $font_character_set_select ); ?>);
			<?php else: ?>
				@import url(https://fonts.googleapis.com/css?family=Droid+Sans:400,700);
				@import url(https://fonts.googleapis.com/css?family=Droid+Serif:400,700);
			<?php endif;
			if( !$theme_two_font == '' and $theme_two_font != 'Select' ):
				$google_theme_two_font = str_replace(' ', '+', $theme_two_font);
			?>
				@import url(https://fonts.googleapis.com/css?family=<?php echo esc_attr( $google_theme_two_font ); ?>:<?php echo esc_attr( $font_family_style ); ?>&subset=latin,latin-ext<?php echo esc_attr( $font_character_set_select ); ?>);
			<?php endif;
			if( !$theme_one_font == '' and $theme_one_font != 'Select' ):
			?>
				.page404 .content404 .search-form-widget input, .calendar-archives .calendar-navigation .months span, .widget_categories ul li a, .widget_categories ul li a:visited {
					font-family: '<?php echo esc_attr( $theme_one_font ); ?>';
				}
			<?php endif;
			if( !$theme_two_font == '' and $theme_two_font != 'Select' ):
			?>
				.select2-drop, body, .woocommerce form .form-row.woocommerce-validated .select2-container .select2-choice, .woocommerce form .woocommerce-shipping-fields .select2-container .select2-choice, .woocommerce form .form-row .select2-container .select2-choice, h1, h2, h3, h4, h5, h6, input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select, .form-control, button, input[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .latest-events-widget ul li .date, .mulada-latest-posts-widget .desc time, .chosen-category-posts-widget .desc time, .widget_categories ul li, .calendar-archives .calendar-navigation .months, .calendar-archives .weekdays .day, .header .menu-area .navbar-nav li.mega-post-menu>ul .mega-post-categories-latest-posts .post-information, .header-slider-area .header-slider-slides-area .post-information, .wide-featured-posts-area .post-information, .mulada-popular-posts-widget > ul > li .post-information, .one-featured-post-area .wrapper  .post-information, .header-menu-button, .slider-area .home-slider .post-image .slider-content .post-information, .post-list article .post-wrapper .post-header .post-information, .chosen-post-widget article .post-wrapper .post-header .post-information, .onest-grid-posts-widget article .post-wrapper .post-header .post-information, .editors-pick-widget .post-image .post-information, .post-list article .post-wrapper .post-bottom .post-share .title, .chosen-post-widget article .post-wrapper .post-bottom .post-share .title, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-share .title, .post-list article .post-wrapper .page-links .page-links-title, .post-list article .post-wrapper .post-bottom .single-tag-list .single-tag-list-title, .chosen-post-widget article .post-wrapper .post-bottom .single-tag-list .single-tag-list-title, .onest-grid-posts-widget article .post-wrapper .post-bottom .single-tag-list .single-tag-list-title, .alternative-font, .post-pagination ul, .editors-pick-widget .post-image h2, .footer .copyright, .page404 .content404 p.text404 strong, .comment-list li .reply a, .comment-list li .reply a:visited, .comment-list li cite, .tribe-events-calendar thead th, #tribe-events-footer .tribe-events-sub-nav .tribe-events-nav-next, #tribe-events-header .tribe-events-sub-nav .tribe-events-nav-next, .tribe-events-button, #tribe-events .tribe-events-button, #tribe-events-footer .tribe-events-sub-nav .tribe-events-nav-previous, #tribe-events-header .tribe-events-sub-nav li {
					font-family: '<?php echo esc_attr( $theme_two_font ); ?>';
				}
				
				@media (min-width: 768px) {
					.header .menu-area .navbar {
						font-family: '<?php echo esc_attr( $theme_two_font ); ?>';
					}
				}
			<?php endif;
			if( !$heading_font == '' and $heading_font != 'Select' ):
			?>
				h1, h2, h3, h4, h5, h6 {
					font-family: '<?php echo esc_attr( $heading_font ); ?>';
				}
			<?php endif;
			if( !$text_font == '' and $text_font != 'Select' ):
			?>
				body {
					font-family: '<?php echo esc_attr( $text_font ); ?>';
				}
			<?php endif;
			if( !$menu_font == '' and $menu_font != 'Select' ):
			?>
				.header .menu-area .navbar {
					font-family: '<?php echo esc_attr( $menu_font ); ?>';
				}
			<?php endif;		
			$h1_font_size = get_theme_mod( 'h1_font_size' );
			if( !$h1_font_size == '' ):
			?>
				h1 {
					font-size: <?php echo esc_attr( $h1_font_size ); ?>px;
				}
			<?php endif;
			$h2_font_size = get_theme_mod( 'h2_font_size' );
			if( !$h2_font_size == '' ):
			?>
				h2 {
					font-size: <?php echo esc_attr( $h2_font_size ); ?>px;
				}
			<?php endif;
			$h3_font_size = get_theme_mod( 'h3_font_size' );
			if( !$h3_font_size == '' ):
			?>
				h3 {
					font-size: <?php echo esc_attr( $h3_font_size ); ?>px;
				}
			<?php endif;
			$h4_font_size = get_theme_mod( 'h4_font_size' );
			if( !$h4_font_size == '' ):
			?>
				h4 {
					font-size: <?php echo esc_attr( $h4_font_size ); ?>px;
				}
			<?php endif;
			$h5_font_size = get_theme_mod( 'h5_font_size' );
			if( !$h5_font_size == '' ):
			?>
				h5 {
					font-size: <?php echo esc_attr( $h5_font_size ); ?>px;
				}
			<?php endif;
			$h6_font_size = get_theme_mod( 'h6_font_size' );
			if( !$h6_font_size == '' ):
			?>
				h6 {
					font-size: <?php echo esc_attr( $h6_font_size ); ?>px;
				}
			<?php endif;
			$body_font_size = get_theme_mod( 'body_font_size' );
			if( !$body_font_size == '' ):
			?>
				.comment .comment-body p, body {
					font-size: <?php echo esc_attr( $body_font_size ); ?>px;
				}
			<?php endif;
			$body_line_height = get_theme_mod( 'body_line_height' );
			if( !$body_line_height == '' ):
			?>
				body {
					line-height: <?php echo esc_attr( $body_line_height ); ?>;
				}
			<?php endif;
			$menu_font_size = get_theme_mod( 'menu_font_size' );
			if( !$menu_font_size == '' ):
			?>
				@media (min-width: 768px) {
					.header .menu-area .navbar .navbar-nav>li>a, .header .menu-area .navbar .navbar-nav>li>a:visited {
						font-size: <?php echo esc_attr( $menu_font_size ); ?>px;
					}
				}
			<?php endif;
			$sub_menu_font_size = get_theme_mod( 'sub_menu_font_size' );
			if( !$sub_menu_font_size == '' ):
			?>
				@media (min-width: 768px) {
					.header .menu-area .navbar .navbar-nav li ul li a, .header .menu-area .navbar .navbar-nav li ul li a:visited {
						font-size: <?php echo esc_attr( $sub_menu_font_size ); ?>px;
					}
				}
			<?php endif;
			$post_content_font_size = get_theme_mod( 'post_content_font_size' );
			if( !$post_content_font_size == '' ):
			?>
				.single-list article .post-wrapper .post-content {
					font-size: <?php echo esc_attr( $post_content_font_size ); ?>px;
				}
			<?php endif;
			$post_tags_font_size = get_theme_mod( 'post_tags_font_size' );
			if( !$post_tags_font_size == '' ):
			?>
				.post-list article .post-wrapper .post-bottom .single-tag-list, .post-list article .post-wrapper .page-links span, .post-list article .post-wrapper .post-bottom .post-share, .chosen-post-widget article .post-wrapper .post-bottom .single-tag-list {
					font-size: <?php echo esc_attr( $post_tags_font_size ); ?>px;
				}
			<?php endif;
			$post_title_font_size = get_theme_mod( 'post_title_font_size' );
			if( !$post_title_font_size == '' ):
			?>
				.post-list article .post-wrapper .post-header h2 {
					font-size: <?php echo esc_attr( $post_title_font_size ); ?>px;
				}
			<?php endif;
			$page_content_font_size = get_theme_mod( 'page_content_font_size' );
			if( !$page_content_font_size == '' ):
			?>
				.site-sub-content .page-content .page-content-bottom {
					font-size: <?php echo esc_attr( $page_content_font_size ); ?>px;
				}
			<?php endif;
			$page_title_font_size = get_theme_mod( 'page_title_font_size' );
			if( !$page_title_font_size == '' ):
			?>
				.site-sub-content .page .page-title {
					font-size: <?php echo esc_attr( $page_title_font_size ); ?>px;
				}
			<?php endif;
			$home_widget_font_size = get_theme_mod( 'home_widget_font_size' );
			if( !$home_widget_font_size == '' ):
			?>
				.widget-title h4, .wpb_widgetised_column .wpb_heading {
					font-size: <?php echo esc_attr( $home_widget_font_size ); ?>px;
				}
			<?php endif;
			$footer_widget_font_size = get_theme_mod( 'footer_widget_font_size' );
			if( !$footer_widget_font_size == '' ):
			?>
				.sidebar-footer .widget-title h4 {
					font-size: <?php echo esc_attr( $footer_widget_font_size ); ?>px;
				}
			<?php endif;
			$footer_content_font_size = get_theme_mod( 'footer_content_font_size' );
			if( !$footer_content_font_size == '' ):
			?>
				.sidebar-footer {
					font-size: <?php echo esc_attr( $footer_content_font_size ); ?>px;
				}
			<?php endif;
			$copyright_font_size = get_theme_mod( 'copyright_font_size' );
			if( !$copyright_font_size == '' ):
			?>
				.footer .copyright {
					font-size: <?php echo esc_attr( $copyright_font_size ); ?>px;
				}
			<?php endif;
			$blockquote_font_size = get_theme_mod( 'blockquote_font_size' );
			if( !$blockquote_font_size == '' ):
			?>
				blockquote {
					font-size: <?php echo esc_attr( $blockquote_font_size ); ?>px;
				}
			<?php endif;
			$category_title_font_size = get_theme_mod( 'category_title_font_size' );
			if( !$category_title_font_size == '' ):
			?>
				.category-archive-title h1 {
					font-size: <?php echo esc_attr( $category_title_font_size ); ?>px;
				}
			<?php endif;
			$category_title_name_font_size = get_theme_mod( 'category_title_name_font_size' );
			if( !$category_title_name_font_size == '' ):
			?>
				.category-archive-title h1 span {
					font-size: <?php echo esc_attr( $category_title_name_font_size ); ?>px;
				}
			<?php endif;
			$error_text_one_font_size = get_theme_mod( 'error_text_one_font_size' );
			if( !$error_text_one_font_size == '' ):
			?>
				.page404 .content404 p.text404 {
					font-size: <?php echo esc_attr( $error_text_one_font_size ); ?>px;
				}
			<?php endif;
			$error_text_two_font_size = get_theme_mod( 'error_text_two_font_size' );
			if( !$error_text_two_font_size == '' ):
			?>
				.page404 .content404 p.subtext {
					font-size: <?php echo esc_attr( $error_text_two_font_size ); ?>px;
				}
			<?php endif;
			$input_font_size = get_theme_mod( 'input_font_size' );
			if( !$input_font_size == '' ):
			?>
				input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select {
					font-size: <?php echo esc_attr( $input_font_size ); ?>px;
				}
			<?php endif;
			$button_font_size = get_theme_mod( 'button_font_size' );
			if( !$button_font_size == '' ):
			?>
				button, input[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
					font-size: <?php echo esc_attr( $button_font_size ); ?>px;
				}
			<?php endif;
			
			$wrapper_background = get_theme_mod( 'wrapper_background' ); 
			if( !$wrapper_background == '' ) :
			?>
				.mulada-wrapper {
					background:<?php echo esc_attr( $wrapper_background ); ?>;
				}
			<?php endif;

			$theme_color_one = get_theme_mod( 'theme_color_one' ); 
			if( !$theme_color_one == '' ) :
			?>
				.header .menu-area .navbar .navbar-nav li .widget-area .mega-post-categories-list ul li a:focus:visited, .header .menu-area .navbar .navbar-nav li .widget-area .mega-post-categories-list ul li a:hover:visited, body .site-content-wrapper #tribe-events .tribe-events-button, body .site-content-wrapper .tribe-events-button, .post-related .category, .post-nav .pager li .category, .post-list article .post-wrapper .post-header .category, .chosen-post-widget article .post-wrapper .post-header .category, .onest-grid-posts-widget article .post-wrapper .post-header .category, .mulada-post-popular-posts-widget .desc .category, .editors-pick-widget .post-image .category, .slider-area .home-slider .post-image .slider-content .category, .header-slider-area .header-social-media ul li a:focus, .header-slider-area .header-social-media ul li a:hover, .header-slider-area .header-slider-slides-area .category, .wide-featured-posts-area .category, .mulada-popular-posts-widget > ul > li .category, .one-featured-post-area .wrapper .category, .header-slider-area .header-slider-slides-box:hover .color, .mulada-popular-posts-widget > ul > li:hover .color, .wide-featured-posts-area .wide-slider-slides-box:hover .color, .one-featured-post-area:hover .color, .edit-link a, .edit-link a:visited, .header .menu-area .navbar .navbar-nav li a:focus, .header .menu-area .navbar .navbar-nav li a:hover, .header .menu-area .navbar .navbar-nav li:hover>a, .header .menu-area .navbar .navbar-nav li:hover>a:visited, .header .menu-area .navbar .navbar-nav li .widget-area .mega-post-categories-list ul li a:hover, .header .menu-area .navbar .navbar-nav li ul li a:focus, .header .menu-area .navbar .navbar-nav li ul li a:focus:visited, .header .menu-area .navbar .navbar-nav li ul li a:hover, .header .menu-area .navbar .navbar-nav li ul li a:hover:visited {
					background:<?php echo esc_attr( $theme_color_one ); ?>;
				}
				
				.woocommerce ul.products li.product .price, #tribe-events-content .tribe-events-tooltip h4, #tribe_events_filters_wrapper .tribe_events_slider_val, .single-tribe_events a.tribe-events-gcal, .single-tribe_events a.tribe-events-ical, .prices, .woocommerce ul.cart_list li del, .woocommerce ul.cart_list li .amount, .woocommerce ul.cart_list li ins, .woocommerce ul.product_list_widget li del, .woocommerce ul.product_list_widget li ins, .woocommerce ul.product_list_widget li .amount, .woocommerce div.product p.price, .woocommerce div.product span.price, .header-slider-slides .header-slider-slides-box .post-read-more:hover span, .mulada-popular-posts-widget > ul > li .post-read-more:hover span, .editors-pick-widget .post-image .post-read-more:hover span, .header .menu-area .navbar-nav li.mega-post-menu>ul .mega-post-categories-latest-posts ul li a:focus, .header .menu-area .navbar-nav li.mega-post-menu>ul .mega-post-categories-latest-posts ul li a:hover {
					color:<?php echo esc_attr( $theme_color_one ); ?>;
				}
				
				.header .menu-area .navbar-nav li.mulada-mega-menu>ul .mega-post-categories-latest-posts ul li a:focus, .header .menu-area .navbar-nav li.mulada-mega-menu>ul .mega-post-categories-latest-posts ul li a:hover {
					color:<?php echo esc_attr( $theme_color_one ); ?> !important;
				}
				
				.site-content-wrapper .tribe-events-calendar thead th, .header-slider-area .header-social-media ul li a:focus, .header-slider-area .header-social-media ul li a:hover {
					border-color:<?php echo esc_attr( $theme_color_one ); ?>;
				}
				
				#tribe-events .tribe-events-button, #tribe-events .tribe-events-button:hover, #tribe_events_filters_wrapper input[type=submit], .tribe-events-button, .tribe-events-button.tribe-active:hover, .tribe-events-button.tribe-inactive, .tribe-events-button:hover, .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-], .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a, .site-content-wrapper .tribe-events-calendar thead th, .woocommerce span.onsale, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce div.product form.cart .button {
					background-color:<?php echo esc_attr( $theme_color_one ); ?>;
				}
			<?php endif;

			$theme_color_two = get_theme_mod( 'theme_color_two' ); 
			if( !$theme_color_two == '' ) :
			?>
				.latest-events-widget ul li .desc div.post-read-more a:hover, .latest-events-widget ul li .desc div.post-read-more:focus, .post-list article .post-wrapper .post-bottom .post-read-more a:focus, .post-list article .post-wrapper .post-bottom .post-read-more a:hover, .chosen-post-widget article .post-wrapper .post-bottom .post-read-more a:focus, .chosen-post-widget article .post-wrapper .post-bottom .post-read-more a:hover, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-read-more a:focus, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-read-more a:hover, .post-list article .post-wrapper .post-bottom .post-share ul li a:focus, .post-list article .post-wrapper .post-bottom .post-share ul li a:hover, .chosen-post-widget article .post-wrapper .post-bottom .post-share ul li a:focus, .chosen-post-widget article .post-wrapper .post-bottom .post-share ul li a:hover, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-share ul li a:focus, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-share ul li a:hover, .tribe-events-day .tribe-events-day-time-slot h5, .calendar-archives .post-read-more a:focus, .calendar-archives .post-read-more a:hover, .calendar-archives .promotion-link a, .calendar-archives .promotion-link a:visited, .calendar-archives .day.has-posts a, .calendar-archives .day.has-posts a:visited, .social-media-widget ul li a:focus, .social-media-widget ul li a:hover, .widget_categories ul li a:before, .widget-title h4:after, .wpb_widgetised_column .wpb_heading:after, .widget-title:before, .contact-social-media ul li a:focus, .contact-social-media ul li a:hover {
					background:<?php echo esc_attr( $theme_color_two ); ?>;
				}
				
				.post-list article .post-wrapper .post-bottom .post-share .title, .chosen-post-widget article .post-wrapper .post-bottom .post-share .title, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-share .title, .post-list article .post-wrapper .page-links, .post-list article .post-wrapper .page-links a, .post-list article .post-wrapper .page-links a:visited, .post-list article .post-wrapper .post-bottom .single-tag-list, .post-list article .post-wrapper .post-bottom .single-tag-list a, .post-list article .post-wrapper .post-bottom .single-tag-list a:visited, .chosen-post-widget article .post-wrapper .post-bottom .single-tag-list, .chosen-post-widget article .post-wrapper .post-bottom .single-tag-list a, .chosen-post-widget article .post-wrapper .post-bottom .single-tag-list a:visited, .onest-grid-posts-widget article .post-wrapper .post-bottom .single-tag-list, .onest-grid-posts-widget article .post-wrapper .post-bottom .single-tag-list a, .onest-grid-posts-widget article .post-wrapper .post-bottom .single-tag-list a:visited, .mulada-popular-posts-widget > ul > li .post-read-more span, .header-slider-slides .header-slider-slides-box .post-read-more span, .latest-events-widget ul li .desc .post-read-more a, .latest-events-widget ul li .desc .post-read-more a:visited, .editors-pick-widget .post-image .post-read-more span, .post-list article .post-wrapper .post-bottom .post-read-more a, .post-list article .post-wrapper .post-bottom .post-read-more a:visited, .chosen-post-widget article .post-wrapper .post-bottom .post-read-more a, .chosen-post-widget article .post-wrapper .post-bottom .post-read-more a:visited, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-read-more a, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-read-more a:visited, .post-author .about-author .about-content .author-social-link ul li a, .post-author .about-author .about-content .author-social-link ul li a, .post-list article .post-wrapper .post-bottom .post-share ul li a, .post-list article .post-wrapper .post-bottom .post-share ul li a:visited, .chosen-post-widget article .post-wrapper .post-bottom .post-share ul li a, .chosen-post-widget article .post-wrapper .post-bottom .post-share ul li a:visited, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-share ul li a, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-share ul li a:visited, .calendar-archives .post-read-more a, .calendar-archives .post-read-more a:visited, .calendar-archives .weekdays .day, .calendar-archives .calendar-navigation .months a, .calendar-archives .calendar-navigation .months a:visited {
					color:<?php echo esc_attr( $theme_color_two ); ?>;
				}
				
				.latest-events-widget ul li .desc div.post-read-more a:hover, .latest-events-widget ul li .desc div.post-read-more:focus, .post-list article .post-wrapper .post-bottom .post-read-more a:focus, .post-list article .post-wrapper .post-bottom .post-read-more a:hover, .chosen-post-widget article .post-wrapper .post-bottom .post-read-more a:focus, .chosen-post-widget article .post-wrapper .post-bottom .post-read-more a:hover, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-read-more a:focus, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-read-more a:hover, .mulada-popular-posts-widget > ul > li .post-read-more span, .header-slider-slides .header-slider-slides-box .post-read-more span, .latest-events-widget ul li .desc .post-read-more a, .latest-events-widget ul li .desc .post-read-more a:visited, .editors-pick-widget .post-image .post-read-more span, .post-list article .post-wrapper .post-bottom .post-read-more a, .post-list article .post-wrapper .post-bottom .post-read-more a:visited, .chosen-post-widget article .post-wrapper .post-bottom .post-read-more a, .chosen-post-widget article .post-wrapper .post-bottom .post-read-more a:visited, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-read-more a, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-read-more a:visited, .chosen-post-widget article .post-wrapper .post-bottom .post-share ul li a:hover, .nav-tabs>li>a:hover, .post-list article .post-wrapper .post-bottom .post-share ul li a, .post-list article .post-wrapper .post-bottom .post-share ul li a:visited, .chosen-post-widget article .post-wrapper .post-bottom .post-share ul li a, .chosen-post-widget article .post-wrapper .post-bottom .post-share ul li a:visited, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-share ul li a, .onest-grid-posts-widget article .post-wrapper .post-bottom .post-share ul li a:visited, .calendar-archives .post-read-more a:focus, .calendar-archives .post-read-more a:hover, .calendar-archives .post-read-more a, .calendar-archives .post-read-more a:visited, .social-media-widget ul li a:focus, .social-media-widget ul li a:hover, .contact-social-media ul li a:focus, .contact-social-media ul li a:hover {
					border-color:<?php echo esc_attr( $theme_color_two ); ?>;
				}
				
				#tabs.nav>li>a:focus, #tabs.nav>li>a:hover {
					background-color:<?php echo esc_attr( $theme_color_two ); ?>;
				}
			<?php endif;

			$body_text_color = get_theme_mod( 'body_text_color' ); 
			if( !$body_text_color == '' ) :
			?>
				body {
					color:<?php echo esc_attr( $body_text_color ); ?>;
				}
			<?php endif;

			$header_background = get_theme_mod( 'header_background' ); 
			if( !$header_background == '' ) :
			?>
				.header .menu-area {
					background:<?php echo esc_attr( $header_background ); ?>;
				}
			<?php endif;

			$header_menu_link_color = get_theme_mod( 'header_menu_link_color' ); 
			if( !$header_menu_link_color == '' ) :
			?>
				.header .menu-area .navbar .navbar-nav>li>a, .header .menu-area .navbar .navbar-nav>li>a:visited, .header .menu-area .navbar .navbar-nav li .widget-area a:hover, .header .menu-area .navbar .navbar-nav li .widget-area a:focus {
					color:<?php echo esc_attr( $header_menu_link_color ); ?>;
				}
			<?php endif;

			$header_sub_menu_link_color = get_theme_mod( 'header_sub_menu_link_color' ); 
			if( !$header_sub_menu_link_color == '' ) :
			?>
				.header .menu-area .navbar .navbar-nav li ul li a, .header .menu-area .navbar .navbar-nav li ul li a:visited {
					color:<?php echo esc_attr( $header_sub_menu_link_color ); ?>;
				}
			<?php endif;

			$header_sub_menu_background = get_theme_mod( 'header_sub_menu_background' ); 
			if( !$header_sub_menu_background == '' ) :
			?>
				.header .menu-area .navbar-nav li .dropdown-menu, .header .menu-area .navbar-nav li.mega-post-menu>ul .mega-post-categories-list {
					background:<?php echo esc_attr( $header_sub_menu_background ); ?>;
				}
			<?php endif;

			$header_cat_menu_background = get_theme_mod( 'header_cat_menu_background' ); 
			if( !$header_cat_menu_background == '' ) :
			?>
				.header .menu-area .navbar-nav li.mega-post-menu>ul {
					background:<?php echo esc_attr( $header_cat_menu_background ); ?>;
				}
			<?php endif;

			$slider_border_color = get_theme_mod( 'slider_border_color' ); 
			if( !$slider_border_color == '' ) :
			?>
				.header-slider-area, .wide-featured-posts-area {
					background:<?php echo esc_attr( $slider_border_color ); ?>;
				}
			<?php endif;

			$site_content_background = get_theme_mod( 'site_content_background' ); 
			if( !$site_content_background == '' ) :
			?>
				.post-list article, .wpb_widgetised_column .widget-box, .sidebar-general .widget-box, .post-bottom-element, .page-content, .sidebar-home-magazine .widget-box .widget-content, .sidebar-home-magazine-wrap.widget-box .widget-content, .chosen-category-posts-widget ul li {
					background:<?php echo esc_attr( $site_content_background ); ?>;
				}
			<?php endif;

			$blockquote_color = get_theme_mod( 'blockquote_color' ); 
			if( !$blockquote_color == '' ) :
			?>
				blockquote {
					color:<?php echo esc_attr( $blockquote_color ); ?>;
				}
			<?php endif;

			$heading_color = get_theme_mod( 'heading_color' ); 
			if( !$heading_color == '' ) :
			?>
				h1, h2, h3, h4, h5, h6 {
					color:<?php echo esc_attr( $heading_color ); ?>;
				}
			<?php endif;

			$link_color = get_theme_mod( 'link_color' ); 
			if( !$link_color == '' ) :
			?>
				a, a:visited {
					color:<?php echo esc_attr( $link_color ); ?>;
				}
			<?php endif;

			$link_hover_color = get_theme_mod( 'link_hover_color' ); 
			if( !$link_hover_color == '' ) :
			?>
				a:hover, a:focus {
					color:<?php echo esc_attr( $link_hover_color ); ?>;
				}
			<?php endif;

			$footer_background = get_theme_mod( 'footer_background' ); 
			if( !$footer_background == '' ) :
			?>
				.footer, .sidebar-footer .widget-title h4, .sidebar-footer .widget-title h4:after {
					background:<?php echo esc_attr( $footer_background ); ?>;
				}
			<?php endif;

			$footer_text_color = get_theme_mod( 'footer_text_color' ); 
			if( !$footer_text_color == '' ) :
			?>
				.footer {
					color:<?php echo esc_attr( $footer_text_color ); ?>;
				}
			<?php endif;

			$input_border_color = get_theme_mod( 'input_border_color' ); 
			if( !$input_border_color == '' ) :
			?>
				.select2-drop, .woocommerce form .form-row.woocommerce-validated .select2-container .select2-choice, .woocommerce form .woocommerce-shipping-fields .select2-container .select2-choice, .woocommerce form .form-row .select2-container .select2-choice, input[type="email"],input[type="number"],input[type="password"],input[type="tel"],input[type="url"],input[type="text"],input[type="time"],input[type="week"],input[type="search"],input[type="month"],input[type="datetime"],input[type="date"],textarea,textarea.form-control,select, .form-control {
					border-color:<?php echo esc_attr( $input_border_color ); ?>;
				}
			<?php endif;

			$input_text_color = get_theme_mod( 'input_text_color' ); 
			if( !$input_text_color == '' ) :
			?>
				.select2-drop, .woocommerce form .form-row.woocommerce-validated .select2-container .select2-choice, .woocommerce form .woocommerce-shipping-fields .select2-container .select2-choice, .woocommerce form .form-row .select2-container .select2-choice, input[type="email"],input[type="number"],input[type="password"],input[type="tel"],input[type="url"],input[type="text"],input[type="time"],input[type="week"],input[type="search"],input[type="month"],input[type="datetime"],input[type="date"],textarea,textarea.form-control,select, .form-control {
					color:<?php echo esc_attr( $input_text_color ); ?>;
				}
			<?php endif;

			$input_background = get_theme_mod( 'input_background' ); 
			if( !$input_background == '' ) :
			?>
				.select2-drop, .woocommerce form .form-row.woocommerce-validated .select2-container .select2-choice, .woocommerce form .woocommerce-shipping-fields .select2-container .select2-choice, .woocommerce form .form-row .select2-container .select2-choice, input[type="email"],input[type="number"],input[type="password"],input[type="tel"],input[type="url"],input[type="text"],input[type="time"],input[type="week"],input[type="search"],input[type="month"],input[type="datetime"],input[type="date"],textarea,textarea.form-control,select, .form-control {
					background:<?php echo esc_attr( $input_background ); ?>;
				}
			<?php endif;

			$button_background = get_theme_mod( 'button_background' ); 
			if( !$button_background == '' ) :
			?>
				.search-form-widget button, button, input[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
					background:<?php echo esc_attr( $button_background ); ?>;
				}
			<?php endif;

			$button_hover_background = get_theme_mod( 'button_hover_background' ); 
			if( !$button_hover_background == '' ) :
			?>
				.search-form-widget button:hover, button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
					background:<?php echo esc_attr( $button_hover_background ); ?>;
				}
			<?php endif;

			$button_color = get_theme_mod( 'button_color' ); 
			if( !$button_color == '' ) :
			?>
				button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, button, input[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
					color:<?php echo esc_attr( $button_color ); ?>;
				}
			<?php endif;

			$home_widget_title_color = get_theme_mod( 'home_widget_title_color' ); 
			if( !$home_widget_title_color == '' ) :
			?>
				.widget-title, .wpb_widgetised_column .wpb_heading {
					color:<?php echo esc_attr( $home_widget_title_color ); ?>;
				}
			<?php endif;

			$home_widget_border_color = get_theme_mod( 'home_widget_border_color' ); 
			if( !$home_widget_border_color == '' ) :
			?>
				.widget-title, .wpb_widgetised_column .wpb_heading {
					border-bottom-color:<?php echo esc_attr( $home_widget_border_color ); ?>;
				}
			<?php endif;

			$footer_widget_title_color = get_theme_mod( 'footer_widget_title_color' ); 
			if( !$footer_widget_title_color == '' ) :
			?>
				.sidebar-footer .widget-title h4 {
					color:<?php echo esc_attr( $footer_widget_title_color ); ?>;
				}
			<?php endif;

			$footer_widget_border_color = get_theme_mod( 'footer_widget_border_color' ); 
			if( !$footer_widget_border_color == '' ) :
			?>
				.sidebar-footer .widget-title, .footer-widget, .footer_social_media_area {
					border-bottom-color:<?php echo esc_attr( $footer_widget_border_color ); ?>;
				}
			<?php endif;

			$copyright_text_color = get_theme_mod( 'copyright_text_color' ); 
			if( !$copyright_text_color == '' ) :
			?>
				.footer .copyright {
					color:<?php echo esc_attr( $copyright_text_color ); ?>;
				}
			<?php endif;

			$tags_widget_color = get_theme_mod( 'tags_widget_color' ); 
			if( !$tags_widget_color == '' ) :
			?>
				.footer .tagcloud a, .footer .tagcloud a:visited, .tagcloud a, .tagcloud a:visited, .header .menu-area .navbar .navbar-nav li .widget-area .tagcloud a, .header .menu-area .navbar .navbar-nav li .widget-area .tagcloud a:visited {
					color:<?php echo esc_attr( $tags_widget_color ); ?>;
				}
			<?php endif;

			$tags_widget_border_color = get_theme_mod( 'tags_widget_border_color' ); 
			if( !$tags_widget_border_color == '' ) :
			?>
				.footer .tagcloud a, .footer .tagcloud a:visited, .tagcloud a, .tagcloud a:visited, .header .menu-area .navbar .navbar-nav li .widget-area .tagcloud a, .header .menu-area .navbar .navbar-nav li .widget-area .tagcloud a:visited {
					border-color:<?php echo esc_attr( $tags_widget_border_color ); ?>;
				}
				
				.tagcloud a:hover, .tagcloud a:focus, .header .menu-area .navbar .navbar-nav li .widget-area .tagcloud a:hover, .header .menu-area .navbar .navbar-nav li .widget-area .tagcloud a:focus {
					background:<?php echo esc_attr( $tags_widget_border_color ); ?>;
				}
			<?php endif;
			
			$header_fixed = get_theme_mod( 'header_fixed' );
			if( $header_fixed == '1' ) :
			?>
				.site-sub-content {
					padding-top: 106px;
				}
				
				.header {
					position:fixed;
				}
			<?php
			endif;
			
			$categories = get_categories(); 
			foreach ( $categories as $category ) {
				$cat_id = $category->term_id;
				$cat_data = get_option("category_$cat_id");
				if( !empty( $cat_data ) ) :
					$cat_color = $cat_data['catBG'];
				else:
					$cat_color = "";
				endif;
				echo '.cat-color-' . $category->term_id . '{ background-color:' . $cat_color . ' !important; } ';
			}

			$custom_css = get_theme_mod( 'custom_css' );
			if( !$custom_css == '' ):
				echo esc_attr( $custom_css );
			endif;
			?>aaaa
		</style>
		
		<?php
		$custom_js = get_theme_mod( 'custom_js' );
		if( !$custom_js == '' ):
		?>
			<script type="text/javascript">
				<?php echo esc_js( $custom_js ); ?>
			</script>
		<?php endif; ?>
<?php
}
add_action( 'wp_head', 'mulada_custom_style' );
/*-- THEME CUSTOM STYLE FUNCTION END --*/
/*------------- THEME OPTIONS END -------------*/