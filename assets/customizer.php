<?php
/**
 * Theme Customizer 
 */

/* 

// Sources used 
// https://www.smashingmagazine.com/2013/03/the-wordpress-theme-customizer-a-developers-guide/
// http://buildwpyourself.com/building-theme-color-options-customizer/
// https://codex.wordpress.org/Class_Reference/WP_Customize_Control
// http://wptheming.com/2014/09/customizer-panels-field-types/
// http://www.divjot.co/smart-controls-wordpress-customizer/
// >> http://code.tutsplus.com/tutorials/a-guide-to-the-wordpress-theme-customizer-adding-a-new-setting--wp-33180
// http://www.wpbeginner.com/wp-tutorials/how-to-create-a-custom-wordpress-widget/
// http://josephfitzsimmons.com/adding-a-select-box-with-categories-into-wordpress-theme-customizer/
// (and many other scriptlet outputs)


OVERVIEW 
This theme is still a development theme, meaning WP Builders can quickly set up content and page structures but need to add there own styling through a .css file.

The theme has 2 customizable sidebars, a Content/Image (Anything) Slider, a customizable header image and an Isotope Packary Filterable Grid display! 
Set default content settings in the customizer, overwrite those with page specific (metabox) settings.
Control Post author/time/tags/category/next-prevlinks display and set Single Post Featured Images to be displayed in the header area as default (like every post has it's own page)
The content for the Slider (AnythingSlider) and Grid(Isotope Packary) derive from posts in a designated category.

Many options are still in development. 
The Slider works great but AnythingSlider can do much, much more. 
Theme Gallery Grid is part of the Gallery Page template, Sub categories and Post tags Define a Category/Tag Filter Menu.
The Isotope Grid can do much, much, much more too.
Product properties can be assigned to Posts, together with a Shop Page Template and Custom Post Type for products this brings endless options (not started on yet).

A Onepiece widget for multiple functions is in development the most important functions works great already: login and register in tab display. 
Later on a few stylesheet will be added to set the example for styling options.



Customizer Sections and Options list:
( .. = in not ready )

Identity:
    	Logo image 
        image medium
    	max-width
        image small
    	small max-width
    
    Title, Tagline & Icon image
        Site Title
        Site Description/Tagline
        Site Icon image
    
    Featured site-image
        image
	    width (replace/replacemargin)

	
Style & Layout: 

	Style
		select style (css file)
		fontsize 1-10
		spacing 1-10
		speed 1-10
	
	Colors
		body bg
		body text
		body textlink
		body textlink hover
		

..Media Accounts
	.. Facebook
	.. Twitter
	.. Google+
	.. Thumblr
	.. Linkedin
	.. Github	
	...

	   
Content:
    Static front page (default)
	
	Slider
		display ( replace header/below header / footer top)
		category 
		height (percentage)
		width type (full/margin)
		
	Popup
		display ( wide, medium, small )  
		color bg overlay
		transparency bg overlay (0-1)
		.. display close button
		
    Pages
        date/author display

    Posts
        Exclude categories
        Use highlight first posts
		Excerpt length (amount of words)
		
		Tags display
		Categories Display
		Next / Previous links

        Display date/author
        Featured image header
        
    Category
        Display category list Title & Description 

	Gallery
		Default category
   
Elements:


    Background image    


    Top menu bar
        Display none/position
        Behavior relative, absolute, fixed, minified
		bg color 
		text color
		link color
		link hover color
		transparency bg (0-1)
   
      
    Header image
		Image
		Headerimage width (content/full)
		
	Login tabbar    
        Default display none/position
		
    Main menu bar
        Display hide/position horizontal
		Positioning vertical/placement
		Behavior
		
    Main Sidebar
        Display hide/alignment
        Placement top/bottom/topcontent
            
    Second Sidebar
        Display none/position
        Position inside/outside
        Width

    Footerbar
        Bottom menu display none/position

Menu's:
	Mini
    Top
    Main
	User
    Side
    Bottom
    
Widgets: (sidebars positions)

	Top - widgets on top of everything (ie. for banners or hidden menu's etc.)
    Onepiece Header - widgets below the header image or slider (ie. for a row of buttons, banners or icons or to use as an overlay header area )
    Sidebar - widgets 'main siderbar' (combined with sidebarmenu and pagemenu) on right- or left- side of main content
    Sidebar2 - widgets 'second sidebar' on right- or left- side of the main content, outer or inner side of main content if main sidebar available
	Page sidebar - widgets only displayed on pages (ie. nice for specific menu's or content related with a childpage group)
    Special Widgets - widgets special is actually just an extra widget area on top of the main content area besides the sidebar(s) (ie. for special offers)
    Before (content) - widgets just before the main content, after the special widgets (ie. for page related info and banners)
    After (content) - widgets right the main content, sticking to the main content bottom (ie. for page related info and banners)
    Subcontent - widgets below the main content and siderbar area, before the header (ie. for a complete info section with site wide value)
    Bottom - widgets below/besides the bottom menu and logo, before the copyright textbox (ie. for short contact info and sitemap)
	
	!Widgets Header - WP default widgets setup is available for admin but not used in the theme view (almost blank start screen) 
    


Responsive
	Small
		screen max width (switch to medium) in px
		outermargin default width (%)
		content max width in px
	Medium
		screen max width (switch to large) in px
		outermargin default width (%)
		content max width in px
	Large
		content max width in px
	
*/





function onepiece_register_theme_customizer( $wp_customize ) {
    
    
	$wp_customize->remove_control('display_header_text');
	// remove default title / site-identity
	//$wp_customize->remove_section('title_tagline');
	// remove default colors
	$wp_customize->remove_control('header_textcolor'); 
	$wp_customize->remove_control('background_color');
	//$wp_customize->remove_panel('colors');
	
	
        // add panels
    	$wp_customize->add_panel('onepiece_elements_identity', array( 
        	'title'    => __('Identity', 'onepiece'),
        	'priority' => 10,
    	));
	    $wp_customize->add_panel('onepiece_content_style', array( 
        	'title'    => __('Style', 'onepiece'),
        	'priority' => 20,
    	));
	    $wp_customize->add_panel('onepiece_content_panel', array( 
        	'title'    => __('Content', 'onepiece'),
        	'priority' => 30,
    	));
	    $wp_customize->add_panel('onepiece_elements_panel', array( 
        	'title'    => __('Elements', 'onepiece'),
        	'priority' => 40,
    	));

	    $wp_customize->add_panel('onepiece_elements_responsive', array( 
        	'title'    => __('Responsive', 'onepiece'),
        	'priority' => 120,
    	)); 
		
    	// add / move sections
    	$wp_customize->add_section('onepiece_identity_panel_logo', array( 
        	'title'    => __('Logo image', 'onepiece'),
        	'panel'  => 'onepiece_elements_identity',
		'priority' => 10,
    	)); 
    	$wp_customize->add_section('onepiece_identity_panel_featured_image', array( 
        	'title'    => __('Sharing', 'onepiece'),
        	'panel'  => 'onepiece_elements_identity',
		'priority' => 30,
    	));

        $wp_customize->add_section('onepiece_identity_stylelayout', array( 
        	'title'    => __('Style & Layout', 'onepiece'),
        	'panel'  => 'onepiece_content_style',
		'priority' => 50,
    	)); 

        $wp_customize->add_section('colors', array( 
        	'title'    => __('Colors', 'onepiece'),
        	'panel'  => 'onepiece_content_style',
		'priority' => 50,
    	));

    	$wp_customize->add_section('onepiece_responsive_small', array( 
        	'title'    => __('Small', 'onepiece'),
        	'panel'  => 'onepiece_elements_responsive',
		'priority' => 10,
    	));

    	$wp_customize->add_section('onepiece_responsive_medium', array( 
        	'title'    => __('Medium', 'onepiece'),
        	'panel'  => 'onepiece_elements_responsive',
		'priority' => 20,
    	));
    	$wp_customize->add_section('onepiece_responsive_large', array( 
        	'title'    => __('Large', 'onepiece'),
        	'panel'  => 'onepiece_elements_responsive',
		'priority' => 30,
    	));

    	$wp_customize->add_section('onepiece_content_panel_frontpage', array( 
        	'title'    => __('Frontpage', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
		
    	$wp_customize->add_section('onepiece_content_sliderbar', array( 
        	'title'    => __('Slider', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
			'priority' => 50,
    	));
		
    	$wp_customize->add_section('onepiece_content_mainpopup', array( 
        	'title'    => __('Popup', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
			'priority' => 60,
    	));
    	$wp_customize->add_section('onepiece_content_panel_page', array( 
        	'title'    => __('Page', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	$wp_customize->add_section('onepiece_content_panel_posts', array( 
        	'title'    => __('Post', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	$wp_customize->add_section('onepiece_content_panel_category', array( 
        	'title'    => __('Category', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	$wp_customize->add_section('onepiece_content_panel_gallery', array( 
        	'title'    => __('Gallery', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	
		$wp_customize->add_section('onepiece_elements_topmenubar', array( 
        	'title'    => __('Topbar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
		'priority' => 20,
    	));
		
		
    	$wp_customize->add_section('onepiece_content_sliderbar', array( 
        	'title'    => __('Slider', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
			'priority' => 30,
    	));
		
    	$wp_customize->add_section('onepiece_elements_loginbar', array( 
        	'title'    => __('Loginbar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
			'priority' => 40,
    	));
    	$wp_customize->add_section('onepiece_elements_mainmenubar', array( 
        	'title'    => __('Main menubar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
    	));
		
    	$wp_customize->add_section('onepiece_elements_sidebar', array( 
        	'title'    => __('Main Sidebar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
    	));
    	$wp_customize->add_section('onepiece_elements_sidebar2', array( 
        	'title'    => __('Second Sidebar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
    	));
    	$wp_customize->add_section('onepiece_elements_bottommenubar', array( 
        	'title'    => __('Footerbar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
    	));
	
	    // move sections
	    $wp_customize->add_section('title_tagline', array( 
        	'title'    => __('Title, Tagline & Icon image', 'onepiece'),
        	'panel'  => 'onepiece_elements_identity',
		'priority' => 20,
    	));
    	$wp_customize->add_section('background_image', array( 
        	'title'    => __('Background Image', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
		'priority' => 10,
    	)); 
	    $wp_customize->add_section('header_image', array( 
        	'title'    => __('Header Image', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
		'priority' => 30,
    	));
		
		$wp_customize->add_section('static_front_page', array( 
        	'title'    => __('Frontpage', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
		'priority' => 10,
    	));
		
		
		
		// IDENTITY
		$wp_customize->add_setting( 'onepiece_identity_logo_m', array( 
		'sanitize_callback' => 'onepiece_sanitize_default', 
	    )); 
	    $wp_customize->add_setting( 'onepiece_identity_logo_s', array( 
		'sanitize_callback' => 'onepiece_sanitize_default', 
	    )); 
	
	    $wp_customize->add_setting( 'onepiece_identity_featured_image', array( 
		'sanitize_callback' => 'onepiece_sanitize_default', 
	    )); 
	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'onepiece_identity_logo_m', array(
        	'label'    => __( 'Site Logo Image Medium', 'onepiece' ),
        	'section'  => 'onepiece_identity_panel_logo',
        	'settings' => 'onepiece_identity_logo_m',
		'description' => __( 'Upload or select a medium sized image to use as site logo (replacing the site-title text on top).', 'onepiece' ),
        	'priority' => 10,
    	) ) );

        $wp_customize->add_setting( 'onepiece_identity_panel_logo_maxwidth' , array(
		'default' => '320', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_sidebar_width', array(
            	'label'          => __( 'Logo max width (px)', 'onepiece' ),
            	'section'        => 'onepiece_identity_panel_logo',
            	'settings'       => 'onepiece_identity_panel_logo_maxwidth',
            	'type'           => 'text',
 	    	'description'    => __( 'Max width (for best quality).', 'onepiece' ),
    	)));
	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'onepiece_identity_logo_s', array(
        	'label'    => __( 'Site Logo Image Small', 'onepiece' ),
        	'section'  => 'onepiece_identity_panel_logo',
        	'settings' => 'onepiece_identity_logo_s',
		'description' => __( 'Upload or select a small sized image for alternative site logo (replacing the site-title text at the bottom).', 'onepiece' ),
        	'priority' => 10,
    	) ) );	
    	$wp_customize->add_setting( 'onepiece_identity_panel_logosmall_maxwidth' , array(
		'default' => '320', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_panel_logosmall_maxwidth', array(
            	'label'          => __( 'Small Logo max width (px)', 'onepiece' ),
            	'section'        => 'onepiece_identity_panel_logo',
            	'settings'       => 'onepiece_identity_panel_logosmall_maxwidth',
            	'type'           => 'text',
 	    	'description'    => __( 'Max width (for best quality small logo).', 'onepiece' ),
    	)));
	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'onepiece_identity_featured_image', array(
        	'label'    => __( 'Site featured image', 'onepiece' ),
        	'section'  => 'onepiece_identity_panel_featured_image',
        	'settings' => 'onepiece_identity_featured_image',
		'description' => __( 'Upload or select a featured site-image, for website sharing in social media.(ie. Facebook 1200 x 630 - 1.91:1)', 'onepiece' ),
        	'priority' => 10,
    	) ) );
		
		$wp_customize->add_setting( 'onepiece_identity_panel_sharing_description' , array(
		'default' => 'Check out this cool website!', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_panel_sharing_description', array(
            	'label'          => __( 'Site featured(intro) text', 'onepiece' ),
            	'section'        => 'onepiece_identity_panel_featured_image',
            	'settings'       => 'onepiece_identity_panel_sharing_description',
            	'type'           => 'textarea',
 	    	'description'    => __( 'A short introduction text to share.', 'onepiece' ),
    	)));
    	

		// STYLE & LAYOUT
		
		// STYLESHEET
		$wp_customize->add_setting( 'onepiece_identity_stylelayout_stylesheet' , array(
				'default' => 'default.css', 
				'sanitize_callback' => 'onepiece_sanitize_default',
				)); 
		$list = get_theme_cssfilelist();
		$files = [];
		foreach($list as $file){
		$files[$file] = $file;
		}

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_stylelayout_stylesheet', array(
            	'label'          => __( 'Layout stylesheet', 'onepiece' ),
            	'section'        => 'onepiece_identity_stylelayout',
            	'settings'       => 'onepiece_identity_stylelayout_stylesheet',
            	'type'           => 'select',
 	    	'description'    => __( 'Select the main style', 'onepiece' ),
            	'choices'        => $files,
            	
    	)));
		
		// FONTSIZE AVERAGE
		$wp_customize->add_setting( 'onepiece_identity_stylelayout_fontsize' , array(
		'default' => '5', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_stylelayout_fontsize', array(
            	'label'          => __( 'Fontsize', 'onepiece' ),
            	'section'        => 'onepiece_identity_stylelayout',
            	'settings'       => 'onepiece_identity_stylelayout_fontsize',
            	'type'           => 'number',
 	    	'description'    => __( 'Average fontsize (1-10).', 'onepiece' ),
    	)));
		// SPACING AVERAGE
		$wp_customize->add_setting( 'onepiece_identity_stylelayout_spacing' , array(
		'default' => '5', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_stylelayout_spacing', array(
            	'label'          => __( 'Spacing', 'onepiece' ),
            	'section'        => 'onepiece_identity_stylelayout',
            	'settings'       => 'onepiece_identity_stylelayout_spacing',
            	'type'           => 'number',
 	    	'description'    => __( 'Average margins and paddings (1-10).', 'onepiece' ),
    	)));
		// SPEED AVERAGE
		$wp_customize->add_setting( 'onepiece_identity_stylelayout_speed' , array(
		'default' => '5', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_stylelayout_speed', array(
            	'label'          => __( 'Speed', 'onepiece' ),
            	'section'        => 'onepiece_identity_stylelayout',
            	'settings'       => 'onepiece_identity_stylelayout_speed',
            	'type'           => 'number',
 	    	'description'    => __( 'Average speed (1-10).', 'onepiece' ),
    	)));



		// COLORS
		// body bg 
		$wp_customize->add_setting( 'onepiece_identity_colors_bodybg' , array(
		'default' => '#ffffff', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_bodybg', array(
		'label' => __( 'Body background Color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_bodybg',
    	) ) ); 
		
		// body text 
		$wp_customize->add_setting( 'onepiece_identity_colors_bodytext' , array(
		'default' => '#232323', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_bodytext', array(
		'label' => __( 'Body text Color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_bodytext',
    	) ) ); 
		// body link 
		$wp_customize->add_setting( 'onepiece_identity_colors_bodylink' , array(
		'default' => '#000000', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_bodylink', array(
		'label' => __( 'Body textlink Color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_bodylink',
    	) ) ); 
		// body link hover 
		$wp_customize->add_setting( 'onepiece_identity_colors_bodylinkhover' , array(
		'default' => '#232323', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_bodylinkhover', array(
		'label' => __( 'Body textlink hover Color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_bodylinkhover',
    	) ) ); 
		
		
	
		
		
		

		
		

		// CONTENT - SLIDER 
		$wp_customize->add_setting( 'onepiece_content_sliderbar_display' , array(
		'default' => 'none', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_sliderbar_display', array(
            	'label'          => __( 'Slider default display', 'onepiece' ),
            	'section'        => 'onepiece_content_sliderbar',
            	'settings'       => 'onepiece_content_sliderbar_display',
            	'type'           => 'select',
 	    	'description'    => __( 'Select slider default display for categories and posts. Overwrite these defaults in the page slider settings.', 'onepiece'),
            	'choices'        => array(
                	'none'   => __( 'Do not display by default', 'onepiece' ),
                	'replaceheader'   => __( 'Replace header', 'onepiece' ),
            		'belowheader'   => __( 'Below header', 'onepiece' ),
            		//'topcontent'   => __( 'On top of the content', 'onepiece' ),
            		//'bottomcontent'   => __( 'At the bottom of the content', 'onepiece' ),
            		'topfooter'   => __( 'On top of the footer', 'onepiece' ),
            	)
    	)));
		$wp_customize->add_setting( 'onepiece_content_sliderbar_category' , array(
		'default' => 'uncategorized', 
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_sliderbar_category', array(
            	'label'          => __( 'Slider category', 'onepiece' ),
            	'section'        => 'onepiece_content_sliderbar',
            	'settings'       => 'onepiece_content_sliderbar_category', 
 	    	'description'    => __( 'Select the post category for the slider.', 'onepiece' ),
            	'type'    => 'select',
    		'choices' => get_categories_select()
    	)));
		
		$wp_customize->add_setting( 'onepiece_content_sliderbar_height' , array(
		'default' => '33', 
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_sliderbar_height', array(
            	'label'          => __( 'Slider height', 'onepiece' ),
            	'section'        => 'onepiece_content_sliderbar',
            	'settings'       => 'onepiece_content_sliderbar_height', 
 	    	'description'    => __( 'Height (%)', 'onepiece' ),
            	'type'    => 'select',
    		'choices' => array(
                	'20'   => __( '20', 'onepiece' ),
                	'25'   => __( '25', 'onepiece' ),
                	'33'   => __( '33', 'onepiece' ),
            		'50'   => __( '50', 'onepiece' ),
            		'66'   => __( '66', 'onepiece' ),
            		'75'   => __( '75', 'onepiece' ),
                	'80'   => __( '80', 'onepiece' ),
            		'100'   => __( '100', 'onepiece' ),
            	)
    	)));
		
		$wp_customize->add_setting( 'onepiece_content_sliderbar_width' , array(
		'default' => 'margin', 
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_sliderbar_width', array(
            	'label'          => __( 'Slider width', 'onepiece' ),
            	'section'        => 'onepiece_content_sliderbar',
            	'settings'       => 'onepiece_content_sliderbar_width', 
 	    	'description'    => __( 'Width (relative to)', 'onepiece' ),
            	'type'    => 'select',
    		'choices' => array(
                	'margin'   => __( 'content outer margin', 'onepiece' ),
                	'full'   => __( 'window', 'onepiece' ),
                	
            	)
    	)));
		
		
		
		// CONTENT - POPUP 
		$wp_customize->add_setting( 'onepiece_content_mainpopup_display' , array(
		'default' => 'medium', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_mainpopup_display', array(
            	'label'          => __( 'Popup display size', 'onepiece' ),
            	'section'        => 'onepiece_content_mainpopup',
            	'settings'       => 'onepiece_content_mainpopup_display',
            	'type'           => 'select',
 	    		'description'    => __( 'Select popup default display size.', 'onepiece'),
            	'choices'        => array(
                	'large'   => __( 'Wide screen', 'onepiece' ),
                	'medium'   => __( 'Medium box', 'onepiece' ),
            		'small'   => __( 'Small box', 'onepiece' ),
            	)
    	)));
		
		
		// Popup overlay color bg
		$wp_customize->add_setting( 'onepiece_content_mainpopup_overlaycolor' , array(
		'default' => '#ffffff', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_content_mainpopup_overlaycolor', array(
		'label' => __( 'Background overlay color', 'onepiece' ),
		'section' => 'onepiece_content_mainpopup',
		'settings' => 'onepiece_content_mainpopup_overlaycolor',
    	) ) ); 
		
		$wp_customize->add_setting( 'onepiece_content_mainpopup_overlayopacity' , array(
		'default' => '80', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_mainpopup_overlayopacity', array(
            	'label'          => __( 'Background overlay transparency', 'onepiece' ),
            	'section'        => 'onepiece_content_mainpopup',
            	'settings'       => 'onepiece_content_mainpopup_overlayopacity',
            	'type'           => 'text',
 	    	'description'    => __( 'Overlay transparency (percentage).', 'onepiece' ),
    	)));





    
    	// CONTENT - PAGES 
		$wp_customize->add_setting( 'onepiece_content_panel_page_authortime' , array(
		'default' => 'none', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_page_authortime', array(
            	'label'          => __( 'Date/time & Author', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_page',
            	'settings'       => 'onepiece_content_panel_page_authortime',
            	'type'           => 'select',
 	    	'description'    => __( 'Page date/time & author name display', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'No display', 'onepiece' ),
                	'both'   => __( 'Display both', 'onepiece' ),
                	'date'   => __( 'Display date only', 'onepiece' ),
                	'author'   => __( 'Display author name only', 'onepiece' ),
            	)
    	)));
 
 
 
 
 
 
 
 
 
 
 
 		
    	// CONTENT - POSTS - EXCLUDE CATEGORIES  Add multi select 
		// source used: http://themefoundation.com/customizer-multiple-category-control/
		// .. http://jayj.dk/multiple-select-lists-theme-customizer/
		 $wp_customize->add_setting( 'onepiece_content_exclude_categories' );
		 
		$wp_customize->add_control(
			new onepiece_multiselect_exclude_categories(
				$wp_customize,
				'onepiece_content_exclude_categories',
				array(
					'label' => __( 'Exclude Categories', 'onepiece' ),
 	    			'description'    => __( 'Select post categories to be excluded from the main loop (post overview)', 'onepiece' ),
					'section' => 'onepiece_content_panel_posts',
					'settings' => 'onepiece_content_exclude_categories'
				)
			)
		);
		 

    	// CONTENT - POSTS - HIGHLIGHT
    	$wp_customize->add_setting( 'onepiece_content_panel_postlist_firstcount' , array(
		'default' => '3', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_postlist_firstcount', array(
            	'label'          => __( 'Highlight first posts', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_postlist_firstcount',
            	'type'           => 'text',
 	    	'description'    => __( 'Amount of first posts to highlight in a (basic)list.', 'onepiece' ),
    	)));
		
		// CONTENT - POSTS - EXCERPT LENGTH
    	$wp_customize->add_setting( 'onepiece_content_panel_postlist_excerptlength' , array(
		'default' => '25', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_postlist_excerptlength', array(
            	'label'          => __( 'Excerpt Length', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_postlist_excerptlength',
            	'type'           => 'text',
 	    	'description'    => __( 'Amount of words for intro texts in a (basic) list.', 'onepiece' ),
    	)));
		

		// CONTENT - POSTS - TIME & AUTHOR
		$wp_customize->add_setting( 'onepiece_content_panel_postlist_authortime' , array(
		'default' => 'none', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_postlist_authortime', array(
            	'label'          => __( 'Date/time & Author', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_postlist_authortime',
            	'type'           => 'select',
 	    	'description'    => __( 'Post date/time & author name display', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'No display', 'onepiece' ),
                	'both'   => __( 'Display both', 'onepiece' ),
                	'date'   => __( 'Display date only', 'onepiece' ),
                	'datesingle'   => __( 'Date in single post view only', 'onepiece' ),
                	'single'   => __( 'Both in single post view only', 'onepiece' ),
            	)
    	)));

    	// CONTENT - POSTS - FEATURED IMAGE DISPLAY
		$wp_customize->add_setting( 'onepiece_content_panel_posts_featuredimage' , array(
		'default' => 'default', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_featuredimage', array(
            	'label'          => __( 'Featured image display', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_featuredimage',
            	'type'           => 'select',
 	    	    'description'    => __( 'Featured image display in single post view', 'onepiece' ),
            	'choices'        => array(
                	'default'   => __( 'On top of the content', 'onepiece' ),
                	'replace'   => __( 'Replace Header Window width', 'onepiece' ),
                        'replacemargin'   => __( 'Replace Header Content width', 'onepiece' ),
            	)
    	)));
		
		
		// CONTENT - POSTS - READMORE
		$wp_customize->add_setting( 'onepiece_content_panel_posts_readmore' , array(
		'default' => 'none', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_readmore', array(
            	'label'          => __( 'Post Read more', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_readmore',
            	'type'           => 'select',
 	    	'description'    => __( 'Select display type', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'No readmore button', 'onepiece' ),
                	'inline'   => __( 'Inline after the intro text', 'onepiece' ),
            		'right'   => __( 'Right side below intro tekst', 'onepiece' ),
            		'left'   => __( 'Left side below intro tekst', 'onepiece' ),
            	)
    	)));
		 
		

		
		// CONTENT - POSTS - Tags display not / belowtitle / belowcontent
		$wp_customize->add_setting( 'onepiece_content_panel_posts_tagdisplay' , array(
		'default' => 'belowcontent', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_tagdisplay', array(
            	'label'          => __( 'Tag display', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_tagdisplay',
            	'type'           => 'select',
 	    	    'description'    => __( 'Tag display in single post view', 'onepiece' ),
            	'choices'        => array(
                	'not'   => __( 'No display', 'onepiece' ),
                	'belowtitle'   => __( 'Below title', 'onepiece' ),
                    'belowcontent'   => __( 'Below content', 'onepiece' ),
            	)
    	)));
		
		
		// CONTENT - POSTS -  Post related Categories display not / belowheader / belowcontent
		$wp_customize->add_setting( 'onepiece_content_panel_posts_catdisplay' , array(
		'default' => 'belowcontent', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_catdisplay', array(
            	'label'          => __( 'Category display', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_catdisplay',
            	'type'           => 'select',
 	    	    'description'    => __( 'Related Categories display in single post view', 'onepiece' ),
            	'choices'        => array(
                	'not'   => __( 'No display', 'onepiece' ),
                	'belowtitle'   => __( 'Below title', 'onepiece' ),
                    'belowcontent'   => __( 'Below content', 'onepiece' ),
            	)
    	)));
		
		// CONTENT - POSTS - Next / Previous links not / belowheader / belowcontent / contentside
		$wp_customize->add_setting( 'onepiece_content_panel_posts_nextprevdisplay' , array(
		'default' => 'belowcontent', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_nextprevdisplay', array(
            	'label'          => __( 'Next / Previous link display', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_nextprevdisplay',
            	'type'           => 'select',
 	    	    'description'    => __( 'Next and Prev link display in single post view', 'onepiece' ),
            	'choices'        => array(
                	'not'   => __( 'No display', 'onepiece' ),
                    'belowcontent'   => __( 'Below content', 'onepiece' ),
                    'abovefooter'   => __( 'Above footer (end content)', 'onepiece' ),
                    'contentside'   => __( 'On content sides', 'onepiece' ),
            	)
    	)));
		
		
		
		
		
		 
    	
    	// CONTENT - CATEGORIES
    	$wp_customize->add_setting( 'onepiece_content_panel_category_titledisplay' , array(
		'default' => 'title', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_category_titledisplay', array(
            	'label'          => __( 'Title & description', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_category',
            	'settings'       => 'onepiece_content_panel_category_titledisplay',
            	'type'           => 'radio',
 	    	'description'    => __( 'Select display type', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'No title', 'onepiece' ),
                	'title'   => __( 'Title', 'onepiece' ),
            		'text'   => __( 'Title and description', 'onepiece' ),
            	)
    	)));
		
		
	
    	
    	
    	
    	// GALLERY 
    	$wp_customize->add_setting( 'onepiece_content_gallery_category' , array(
		'default' => 'uncategorized', 
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_gallery_category', array(
            	'label'          => __( 'Default category', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_gallery',
            	'settings'       => 'onepiece_content_gallery_category', 
 	    	'description'    => __( 'Select the default category for the gallery.', 'onepiece' ),
            	'type'    => 'select',
    		'choices' => get_categories_select()
    	)));
		
		



		
		// ELEMENTS - HEADER IMAGE - WIDTH
		$wp_customize->add_setting( 'onepiece_elements_headerimage_width' , array(
		'default' => 'outer', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_headerimage_width', array(
            	'label'          => __( 'Header image width', 'onepiece' ),
            	'section'        => 'header_image',
            	'settings'       => 'onepiece_elements_headerimage_width',
            	'type'           => 'radio',
 	    	'description'    => __( 'Select header image width', 'onepiece' ),
            	'choices'        => array(
                	'outer'   => __( 'Content (outermargin)', 'onepiece' ),
                	'full'   => __( 'Full (window)', 'onepiece' ),
            	)
    	)));
		// ELEMENTS - HEADER IMAGE (min) HEIGHT
    	$wp_customize->add_setting( 'onepiece_elements_headerimage_height' , array(
		'default' => '560', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_headerimage_height', array(
            	'label'          => __( 'Header Min-height', 'onepiece' ),
            	'section'        => 'header_image',
            	'settings'       => 'onepiece_elements_headerimage_height',
            	'type'           => 'number',
 	    	'description'    => __( 'Height (min-height) in px', 'onepiece' ),
    	)));
		
		
		// ELEMENTS - TOP MENU BAR
		// above / fixed overlay / absolute overlay
    	$wp_customize->add_setting( 'onepiece_elements_topmenubar_behavior' , array(
		'default' => 'rela', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_topmenubar_behavior', array(
            	'label'          => __( 'Topbar behavior', 'onepiece' ),
            	'section'        => 'onepiece_elements_topmenubar',
            	'settings'       => 'onepiece_elements_topmenubar_behavior',
            	'type'           => 'select',
 	    	'description'    => __( 'Select topbar vertical behavior.', 'onepiece' ),
            	'choices'        => array(
                	'rela'   => __( 'Header top, scroll along', 'onepiece' ),
            		'abso'   => __( 'Overlay header, scroll along', 'onepiece' ),
                	'fixe'   => __( 'Overlay header, scroll fixed', 'onepiece' ),
            		'mini'   => __( 'Overlay header, scroll fixed minified', 'onepiece' ),
            	)
    	)));
		// topbar menu position
		$wp_customize->add_setting( 'onepiece_elements_topmenubar_position' , array(
		'default' => 'right', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_topmenubar_position', array(
            	'label'          => __( 'Top Menu Position', 'onepiece' ),
            	'section'        => 'onepiece_elements_topmenubar',
            	'settings'       => 'onepiece_elements_topmenubar_position',
            	'type'           => 'select',
 	    	'description'    => __( 'Select topmenubar horizontal display/position.', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'center logo, hide menu', 'onepiece' ),
                	'left'   => __( 'left', 'onepiece' ),
            		'center'   => __( 'center', 'onepiece' ),
            		'right'   => __( 'right', 'onepiece' ),
            	)
    	)));
			
		
		
		// topbar menu position
		$wp_customize->add_setting( 'onepiece_elements_topmenubar_bgfixed' , array(
		'default' => 'keep', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_topmenubar_bgfixed', array(
            	'label'          => __( 'Topbar bg color display', 'onepiece' ),
            	'section'        => 'onepiece_elements_topmenubar',
            	'settings'       => 'onepiece_elements_topmenubar_bgfixed',
            	'type'           => 'select',
 	    	'description'    => __( 'Topbar background color.', 'onepiece' ),
            	'choices'        => array(
                	'keep'   => __( 'Always use the bg color', 'onepiece' ),
                	'mini'   => __( 'Only when minified', 'onepiece' ),
            	)
    	)));
		
		// topbar bg color
		$wp_customize->add_setting( 'onepiece_identity_colors_topbarbg' , array(
		'default' => '#ffffff', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_topbarbg', array(
		'label' => __( 'Topbar background color', 'onepiece' ),
		'section' => 'onepiece_elements_topmenubar',
		'settings' => 'onepiece_identity_colors_topbarbg',
    	) ) ); 
		// topbar text color
		$wp_customize->add_setting( 'onepiece_identity_colors_topbartext' , array(
		'default' => '#232323', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_topbartext', array(
		'label' => __( 'Topbar text color', 'onepiece' ),
		'section' => 'onepiece_elements_topmenubar',
		'settings' => 'onepiece_identity_colors_topbartext',
    	) ) ); 
		
		// topbar textlink color
		$wp_customize->add_setting( 'onepiece_identity_colors_topbartextlink' , array(
		'default' => '#000000', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_topbartextlink', array(
		'label' => __( 'Topbar textlink color', 'onepiece' ),
		'section' => 'onepiece_elements_topmenubar',
		'settings' => 'onepiece_identity_colors_topbartextlink',
    	) ) ); 
		
		
		// topbar textlink hover color
		$wp_customize->add_setting( 'onepiece_identity_colors_topbartextlinkhover' , array(
		'default' => '#232323', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_topbartextlinkhover', array(
		'label' => __( 'Topbar link hover color', 'onepiece' ),
		'section' => 'onepiece_elements_topmenubar',
		'settings' => 'onepiece_identity_colors_topbartextlinkhover',
    	) ) ); 
		// topbar bg transparency
		$wp_customize->add_setting( 'onepiece_elements_topmenubar_opacity' , array(
		'default' => '15', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_topmenubar_opacity', array(
            	'label'          => __( 'Topbar background transparency', 'onepiece' ),
            	'section'        => 'onepiece_elements_topmenubar',
            	'settings'       => 'onepiece_elements_topmenubar_opacity',
            	'type'           => 'text',
 	    	'description'    => __( 'Bg color transparency (percentage).', 'onepiece' ),
    	)));
		
    	
    	
		
    	
    	// MAIN MENU BAR
		$wp_customize->add_setting( 'onepiece_elements_mainmenubar_position' , array(
		'default' => 'right', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_mainmenubar_position', array(
            	'label'          => __( 'Mainmenu Display', 'onepiece' ),
            	'section'        => 'onepiece_elements_mainmenubar',
            	'settings'       => 'onepiece_elements_mainmenubar_position',
            	'type'           => 'select',
 	    	'description'    => __( 'Select mainmenubar display horizontal (default pages menu).', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'hide', 'onepiece' ),
                	'left'   => __( 'left', 'onepiece' ),
            		'center'   => __( 'center', 'onepiece' ),
            		'right'   => __( 'right', 'onepiece' ),
            	)
    	)));
		$wp_customize->add_setting( 'onepiece_elements_mainmenubar_placement' , array(
		'default' => 'below', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_mainmenubar_placement', array(
            	'label'          => __( 'Mainmenu Vertical Position', 'onepiece' ),
            	'section'        => 'onepiece_elements_mainmenubar',
            	'settings'       => 'onepiece_elements_mainmenubar_placement',
            	'type'           => 'select',
 	    	'description'    => __( 'Select mainmenubar vertical placement with header.', 'onepiece' ),
            	'choices'        => array(
                	'topbar'   => __( 'Topbar', 'onepiece' ),
                	'above'   => __( 'Above Header', 'onepiece' ),
                	'below'   => __( 'Below Header', 'onepiece' ),
                	'content'   => __( 'Top Main Content', 'onepiece' ),
            	)
    	)));
		$wp_customize->add_setting( 'onepiece_elements_mainmenubar_behavior' , array(
		'default' => 'stat', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_mainmenubar_behavior', array(
            	'label'          => __( 'Mainmenubar behavior', 'onepiece' ),
            	'section'        => 'onepiece_elements_mainmenubar',
            	'settings'       => 'onepiece_elements_mainmenubar_behavior',
            	'type'           => 'select',
 	    		'description'    => __( 'Select mainmenubar behavior.', 'onepiece' ),
            	'choices'        => array(
                	'stat'   => __( 'Static scroll', 'onepiece' ),
                	'stic'   => __( 'Stick to top', 'onepiece' ),
            	)
    	)));
		$wp_customize->add_setting( 'onepiece_elements_mainmenubar_minisize' , array(
		'default' => 'none', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_mainmenubar_minisize', array(
            	'label'          => __( 'Mainmenubar mini-sized', 'onepiece' ),
            	'section'        => 'onepiece_elements_mainmenubar',
            	'settings'       => 'onepiece_elements_mainmenubar_minisize',
            	'type'           => 'select',
 	    		'description'    => __( 'Select to minisize the menubar on small screens.', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'No minisize', 'onepiece' ),
                	'slidedown'   => __( 'Slide-down menu (always)', 'onepiece' ),
                	'topbar'   => __( 'Slide-down menu (topbar only)', 'onepiece' ),
            	)
    	)));
		
		
		// ELEMENTS - LOGINBAR
    	$wp_customize->add_setting( 'onepiece_elements_loginbar_option' , array(
		'default' => 'none', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_loginbar_option', array(
            	'label'          => __( 'Display default loginbar', 'onepiece' ),
            	'section'        => 'onepiece_elements_loginbar',
            	'settings'       => 'onepiece_elements_loginbar_option',
            	'type'           => 'select',
 	    		'description'    => __( 'Select loginbar display.', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'No Display (or use widget)', 'onepiece' ),
            		'sbtop'   => __( 'Top main sidebar', 'onepiece' ),
            		'sbbottom'   => __( 'Bottom main sidebar', 'onepiece' ),
            		'sb2top'   => __( 'Top sidebar 2', 'onepiece' ),
            		'sb2bottom'   => __( 'Bottom sidebar 2', 'onepiece' ),
            	)
    	)));
		
		
    	
		
		// ELEMENTS - MAIN SIDEBAR
		$wp_customize->add_setting( 'onepiece_elements_sidebar_position' , array(
		'default' => 'right', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_settings_sidebar_position', array(
            	'label'          => __( 'Sidebar Position', 'onepiece' ),
            	'section'        => 'onepiece_elements_sidebar',
            	'settings'       => 'onepiece_elements_sidebar_position',
            	'type'           => 'select',
 	    	'description'    => __( 'Select the default sidebar position (includes sidemenu if used).', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'hide', 'onepiece' ),
                	'left'   => __( 'left', 'onepiece' ),
            		'right'   => __( 'right', 'onepiece' ),
            	)
    	)));
		
		$wp_customize->add_setting( 'onepiece_elements_mainsidebar_width' , array(
		'default' => '30', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_mainsidebar_width', array(
            	'label'          => __( 'Sidebar width', 'onepiece' ),
            	'section'        => 'onepiece_elements_sidebar',
            	'settings'       => 'onepiece_elements_mainsidebar_width',
            	'type'           => 'text',
 	    	'description'    => __( 'Select sidebar width (percentage).', 'onepiece' ),
    	)));
		
		// SECOND SIDEBAR
		$wp_customize->add_setting( 'onepiece_elements_sidebar2_position' , array(
		'default' => 'none', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_sidebar2_position', array(
            	'label'          => __( 'Second Sidebar Position', 'onepiece' ),
            	'section'        => 'onepiece_elements_sidebar2',
            	'settings'       => 'onepiece_elements_sidebar2_position',
            	'type'           => 'select',
 	    	'description'    => __( 'Select sidebar position.', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'hide', 'onepiece' ),
                	'left'   => __( 'left', 'onepiece' ),
            		'right'   => __( 'right', 'onepiece' ),
            	)
    	)));
    	
    	$wp_customize->add_setting( 'onepiece_elements_sidebar2_position2' , array(
		'default' => 'out', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_sidebar2_position2', array(
            	'label'          => __( 'Second Sidebar Position', 'onepiece' ),
            	'section'        => 'onepiece_elements_sidebar2',
            	'settings'       => 'onepiece_elements_sidebar2_position2',
            	'type'           => 'select',
 	    	'description'    => __( 'Position besides the main sidebar.', 'onepiece' ),
            	'choices'        => array(
                	'ins'   => __( 'on the inside', 'onepiece' ),
                	'out'   => __( 'on the outside', 'onepiece' ),
            	)
    	)));
		
		$wp_customize->add_setting( 'onepiece_elements_sidebar2_width' , array(
		'default' => '30', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_sidebar2_width', array(
            	'label'          => __( 'Sidebar width', 'onepiece' ),
            	'section'        => 'onepiece_elements_sidebar2',
            	'settings'       => 'onepiece_elements_sidebar2_width',
            	'type'           => 'text',
 	    	'description'    => __( 'Select sidebar width (percentage).', 'onepiece' ),
    	)));
		
		// BOTTOM MENU BAR
		$wp_customize->add_setting( 'onepiece_elements_bottommenubar_position' , array(
		'default' => 'right', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_bottommenubar_position', array(
            	'label'          => __( 'Bottom Menu position', 'onepiece' ),
            	'section'        => 'onepiece_elements_bottommenubar',
            	'settings'       => 'onepiece_elements_bottommenubar_position',
            	'type'           => 'select',
 	    	'description'    => __( 'Select bottom menubar display/position.', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'hide', 'onepiece' ),
                	'left'   => __( 'left', 'onepiece' ),
            		'center'   => __( 'center', 'onepiece' ),
            		'right'   => __( 'right', 'onepiece' ),
            	)
    	)));
		
		// BOTTOM MENU BAR - copyright
		$wp_customize->add_setting( 'onepiece_elements_bottom_copyrightposition' , array(
		'default' => 'center', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_bottom_copyrightposition', array(
            	'label'          => __( 'Copyright display', 'onepiece' ),
            	'section'        => 'onepiece_elements_bottommenubar',
            	'settings'       => 'onepiece_elements_bottom_copyrightposition',
            	'type'           => 'select',
 	    	'description'    => __( 'Select copyright text display/position.', 'onepiece' ),
            	'choices'        => array(
                	'hide'   => __( 'hide', 'onepiece' ),
                	'left'   => __( 'left', 'onepiece' ),
            		'center'   => __( 'center', 'onepiece' ),
            		'right'   => __( 'right', 'onepiece' ),
            	)
    	)));
		
		$wp_customize->add_setting( 'onepiece_elements_bottom_copyrighttext' , array(
		'default' => 'Copyright 2016', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_bottom_copyrighttext', array(
            	'label'          => __( 'Copyright text', 'onepiece' ),
            	'section'        => 'onepiece_elements_bottommenubar',
            	'settings'       => 'onepiece_elements_bottom_copyrighttext',
            	'type'           => 'textarea',
 	    	'description'    => __( 'Copyright information text.', 'onepiece' ),
    	)));
		
		
		
	

	
    	
    	

    	// RESPONSIVE	
		$wp_customize->add_setting( 'onepiece_responsive_small_max' , array(
		'default' => '512', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_responsive_small_max', array(
            	'label'          => __( 'Define max width', 'onepiece' ),
            	'section'        => 'onepiece_responsive_small',
            	'settings'       => 'onepiece_responsive_small_max',
            	'type'           => 'text',
 	    	'description'    => __( 'Define max. width befor switch to medium (px).', 'onepiece' ),
    	)));
		
		$wp_customize->add_setting( 'onepiece_responsive_small_width' , array(
		'default' => '100', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_responsive_small_width', array(
            	'label'          => __( 'Default width', 'onepiece' ),
            	'section'        => 'onepiece_responsive_small',
            	'settings'       => 'onepiece_responsive_small_width',
            	'type'           => 'text',
 	    	'description'    => __( 'Normal width (%)', 'onepiece' ),
    	)));
		
		$wp_customize->add_setting( 'onepiece_responsive_small_outermargin' , array(
		'default' => '342', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_responsive_small_outermargin', array(
            	'label'          => __( 'Outermargin', 'onepiece' ),
            	'section'        => 'onepiece_responsive_small',
            	'settings'       => 'onepiece_responsive_small_outermargin',
            	'type'           => 'text',
 	    	'description'    => __( 'Outermargin for small screens (px).', 'onepiece' ),
    	)));
		
		$wp_customize->add_setting( 'onepiece_responsive_medium_max' , array(
		'default' => '1280', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_responsive_medium_max', array(
            	'label'          => __( 'Define max width', 'onepiece' ),
            	'section'        => 'onepiece_responsive_medium',
            	'settings'       => 'onepiece_responsive_medium_max',
            	'type'           => 'text',
 	    	'description'    => __( 'Define max. width befor switch to large (px).', 'onepiece' ),
    	)));
		
		$wp_customize->add_setting( 'onepiece_responsive_medium_width' , array(
		'default' => '95', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_responsive_medium_width', array(
            	'label'          => __( 'Default width', 'onepiece' ),
            	'section'        => 'onepiece_responsive_medium',
            	'settings'       => 'onepiece_responsive_medium_width',
            	'type'           => 'text',
 	    	'description'    => __( 'Normal width (%)', 'onepiece' ),
    	)));
		
		$wp_customize->add_setting( 'onepiece_responsive_medium_outermargin' , array(
		'default' => '960', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_responsive_medium_outermargin', array(
            	'label'          => __( 'Outermargin', 'onepiece' ),
            	'section'        => 'onepiece_responsive_medium',
            	'settings'       => 'onepiece_responsive_medium_outermargin',
            	'type'           => 'text',
 	    	'description'    => __( 'Outermargin for medium screens (px).', 'onepiece' ),
    	)));
    	
		$wp_customize->add_setting( 'onepiece_responsive_large_outermargin' , array(
		'default' => '1200', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_responsive_large_outermargin', array(
            	'label'          => __( 'Outermargin', 'onepiece' ),
            	'section'        => 'onepiece_responsive_large',
            	'settings'       => 'onepiece_responsive_large_outermargin',
            	'type'           => 'text',
 	    	'description'    => __( 'Outermargin for large screens (px).', 'onepiece' ),
    	)));
		
		
		
    	
		
}
add_action( 'customize_register', 'onepiece_register_theme_customizer' );
 

// default sanitize function
function onepiece_sanitize_default($obj){
    	//.. global sanitizer
    	return $obj;
}
function onepiece_sanitize_array( $values ) {
    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;
    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}


/** Extensions for customizer options 
 * - multiselect categories
 */

add_action( 'customize_register', 'onepiece_load_customize_controls', 0 );

function onepiece_load_customize_controls() {

    require_once( trailingslashit( get_template_directory() ) . '/assets/customizer_extend.php' );
}



?>
