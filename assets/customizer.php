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
// http://themefoundation.com/customizer-multiple-category-control/ - http://jayj.dk/multiple-select-lists-theme-customizer/
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
    	Site logo Image Medium
    	max-width
        min(isize) width
        Site logo Image Small
    	small max-width
    
    Title, Tagline & Icon image
        Site Title
        Site Description/Tagline
        Site Icon image
    
    Sharing

        Site featured image
	    Site featured description
		
	SEO
		site (meta) keywords
		site (meta) description
		analytics code


	Api
		.. Linkedin
		.. Twitter
		.. Facebook
		.. Github
		.. Google+
		.. Pinterest
		.. Instagram
		.. Thumblr
		..


Content:

    Static front page (default)

    Page
        date/author display

    Post
        Featured image display replace header/inline left/right/ content
		.>.inline image width
		.. gallery dynamic_Featured_Image
		text alignment 
        Display date/author
		..Date format (date/ago/date&time)
        Display tag none/below title/below content
        Display category none/below title/below content
        Display next/prev none/ below content / above footer / content sides
	
	
	Product

		product order email address
		.>. turn off product options

		.. product labels
		new
		featured
		special
		coming soon
		alltimefavourite
        
    List (replacing category section)
        Use highlight first posts
		Excerpt length (amount of words)
		inline image alignment
		.>.inline image width
		excerpt text alignment 
		..Date format (date/ago/date&time)
		display post read more link inline/left/right
		Exclude categories
        Display category list Title & Description 

	Gallery
		Default category
		Link Post list Widget
		.. default gallery filters
		.. default max items in row
		.. default item minimal height
		.. default item clickaction
		.. default itemview


   
Elements:

    Background image (wp core)    

	Slider
		display ( replace header/below header / footer top)
		category
		height (percentage)
		width type (full/margin)


    Header image
		Image select
		Image width (content/full)
		Headerimage min-height px


	Popup
		display ( wide, medium, small )
		color bg overlay
		transparency bg overlay (0-1)
		.. display close button


    Topbar
        Behavior relative, absolute, fixed, minified
        Display none/position
		bg display
		bg color
		text color
		link color
		link hover color
		transparency bg (0-100)

        Top Sidebar Display hide/position
        Width
		Responsive Positioning

	Login tabbar    
        Default display none/positions 
		Box icon html
		
    Main menu bar
        Display hide/position horizontal
		Positioning vertical/placement
		Behavior sticky/static
		Minisize always/smallscreen/never

    Breadcrumbs bar
        Display none / top main content / before content
		
    Main Sidebar
        Display hide/alignment
        Width (%)
            
    Second Sidebar
        Display none/position
        Position inside/outside
        Width (%)

    Footerbar
        Bottom menu display none/position (opposed to logo position)
		Footer Sidebar position
		Footer sidebar width (%)
		Copyright display
		Copyright text

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
    Bottom - widgets below/besides the bottom menu and logo, before the copyright textbox, beside sidebar (ie. for short contact info and sitemap)
	Bottom-sidebar - widgets besides the bottom menu/widgets and logo, before the copyright textbox (ie. for short contact info and sitemap)
	
	!Widgets Header - WP default widgets setup is available for admin but not used in the theme view (almost blank start screen) 
    


Responsive
	Small screen
		screen max width (switch to medium) in px
		outermargin default width (%)
		content max width in px
	Medium screen
		screen max width (switch to large) in px
		outermargin default width (%)
		content max width in px
	Large screen
		content max width in px




Style:

	Style & Layout
		select style (custom css file)
		fontsize 1-10
		spacing 1-10
		speed 1-10
	
	Colors
		body bg
		body text
		body textlink
		body textlink hover


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
	    $wp_customize->add_panel('onepiece_media_panel', array(
        	'title'    => __('Api (in development)', 'onepiece'),
			'text' => __('in development', 'onepiece'),
        	'priority' => 40,
    	));
	    $wp_customize->add_panel('onepiece_content_panel', array( 
        	'title'    => __('Content', 'onepiece'),
        	'priority' => 50,
    	));
	    $wp_customize->add_panel('onepiece_elements_panel', array( 
        	'title'    => __('Elements', 'onepiece'),
        	'priority' => 60,
    	));

	    $wp_customize->add_panel('onepiece_elements_responsive', array( 
        	'title'    => __('Responsive', 'onepiece'),
        	'priority' => 120,
    	)); 
	    $wp_customize->add_panel('onepiece_content_style', array(
        	'title'    => __('Style', 'onepiece'),
        	'priority' => 130,
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
    	$wp_customize->add_section('onepiece_identity_panel_seo', array( 
        	'title'    => __('SEO', 'onepiece'),
        	'panel'  => 'onepiece_elements_identity',
			'priority' => 40,
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

        $wp_customize->add_section('fonts', array(
        	'title'    => __('Fonts', 'onepiece'),
        	'panel'  => 'onepiece_content_style',
		'priority' => 60,
    	));

		$wp_customize->add_section('icons', array(
        	'title'    => __('Icons & buttons', 'onepiece'),
        	'panel'  => 'onepiece_content_style',
		'priority' => 70,
    	));


		$wp_customize->add_section('custom_css', array(
        	'title'    => __('Custom CSS', 'onepiece'),
        	'panel'  => 'onepiece_content_style',
		'priority' => 80,
    	));




	/* Api & Media
    	$wp_customize->add_section('onepiece_media_panel_wordpress', array(
        	'title'    => __('Wordpress', 'onepiece'),
        	'panel'  => 'onepiece_media_panel',
			'priority' => 30,
    	));

    	$wp_customize->add_section('onepiece_media_panel_linkedin', array(
        	'title'    => __('Linkedin', 'onepiece'),
        	'panel'  => 'onepiece_media_panel',
			'priority' => 30,
    	));
    	$wp_customize->add_section('onepiece_media_panel_facebook', array(
        	'title'    => __('Facebook', 'onepiece'),
        	'panel'  => 'onepiece_media_panel',
			'priority' => 30,
    	));
    	$wp_customize->add_section('onepiece_media_panel_twitter', array(
        	'title'    => __('Twitter', 'onepiece'),
        	'panel'  => 'onepiece_media_panel',
			'priority' => 30,
    	));
    	$wp_customize->add_section('onepiece_media_panel_github', array(
        	'title'    => __('Github', 'onepiece'),
        	'panel'  => 'onepiece_media_panel',
			'priority' => 30,
    	));
    	$wp_customize->add_section('onepiece_media_panel_google', array(
        	'title'    => __('Google', 'onepiece'),
        	'panel'  => 'onepiece_media_panel',
			'priority' => 30,
    	));
	*/



	// Responsive panels
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

	// Content panels
    	$wp_customize->add_section('onepiece_content_panel_frontpage', array( 
        	'title'    => __('Frontpage', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
		
    	$wp_customize->add_section('onepiece_content_sliderbar', array( 
        	'title'    => __('Slider', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
			'priority' => 50,
    	));

    	$wp_customize->add_section('onepiece_content_panel_page', array( 
        	'title'    => __('Page', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	$wp_customize->add_section('onepiece_content_panel_posts', array( 
        	'title'    => __('Post', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	$wp_customize->add_section('onepiece_content_panel_product', array( 
        	'title'    => __('Product', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	$wp_customize->add_section('onepiece_content_panel_list', array( 
        	'title'    => __('List', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	$wp_customize->add_section('onepiece_content_panel_gallery', array( 
        	'title'    => __('Gallery', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	
	// Elements panels

    	$wp_customize->add_section('background_image', array(
        	'title'    => __('Background Image', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
			'priority' => 10,
    	));
    	$wp_customize->add_section('onepiece_content_sliderbar', array( 
        	'title'    => __('Slider', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
			'priority' => 30,
    	));
		
    	$wp_customize->add_section('onepiece_content_mainpopup', array(
        	'title'    => __('Popup', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
			'priority' => 50,
    	));
		$wp_customize->add_section('onepiece_elements_topmenubar', array(
        	'title'    => __('Topbar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
			'priority' => 70,
    	));
    	$wp_customize->add_section('onepiece_elements_loginbar', array( 
        	'title'    => __('Loginbar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
			'priority' => 90,
    	));
    	$wp_customize->add_section('onepiece_elements_mainmenubar', array( 
        	'title'    => __('Main menubar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
    	));
		
    	$wp_customize->add_section('onepiece_elements_breadcrumbs', array(
        	'title'    => __('Breadcrumbs bar', 'onepiece'),
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
    	$wp_customize->add_section('onepiece_elements_subcontent', array(
        	'title'    => __('Subcontentbar', 'onepiece'),
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
	    $wp_customize->add_section('header_image', array( 
        	'title'    => __('Header Image', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
		'priority' => 30,
    	));
		
	// Frontpage (default)
		$wp_customize->add_section('static_front_page', array( 
        	'title'    => __('Frontpage', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
		'priority' => 10,
    	));
		
		
		



	/*
	 *
	 * IDENTITY
	 *
	 */


		$wp_customize->add_setting( 'onepiece_identity_logo_m', array( 
		'sanitize_callback' => 'onepiece_sanitize_default', 
	    )); 
	    $wp_customize->add_setting( 'onepiece_identity_logo_s', array( 
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
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_panel_logo_maxwidth', array(
            	'label'          => __( 'Logo max width (px)', 'onepiece' ),
            	'section'        => 'onepiece_identity_panel_logo',
            	'settings'       => 'onepiece_identity_panel_logo_maxwidth',
            	'type'           => 'text',
 	    	'description'    => __( 'Max width (for best quality).', 'onepiece' ),
    	)));
		
        $wp_customize->add_setting( 'onepiece_identity_panel_logo_minwidth' , array(
		'default' => '80', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_panel_logo_minwidth', array(
            	'label'          => __( 'Logo min. width (px)', 'onepiece' ),
            	'section'        => 'onepiece_identity_panel_logo',
            	'settings'       => 'onepiece_identity_panel_logo_minwidth',
            	'type'           => 'text',
 	    	'description'    => __( 'Minimal width (mini size logo).', 'onepiece' ),
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
		
		
		// IDENTITY - SHARING
		
	    $wp_customize->add_setting( 'onepiece_identity_featured_image', array( 
		'sanitize_callback' => 'onepiece_sanitize_default', 
	    )); 
	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'onepiece_identity_featured_image', array(
        	'label'    => __( 'Site featured image', 'onepiece' ),
        	'section'  => 'onepiece_identity_panel_featured_image',
        	'settings' => 'onepiece_identity_featured_image',
		'description' => __( 'Upload or select a featured site-image for default sharing (social media, searchbots, trackers etc.)', 'onepiece' ),
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
		
		// IDENTITY - SEO 
		
		$wp_customize->add_setting( 'onepiece_identity_panel_seo_keywords' , array(
		'default' => 'cool, website, amazing, webdesign', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_panel_seo_keywords', array(
            	'label'          => __( 'Site keywords (meta)', 'onepiece' ),
            	'section'        => 'onepiece_identity_panel_seo',
            	'settings'       => 'onepiece_identity_panel_seo_keywords',
            	'type'           => 'textarea',
 	    		'description'    => __( 'Default keywords csv text, Tune them to your frontpage content and returning text parts', 'onepiece' ),
    	)));
		
		$wp_customize->add_setting( 'onepiece_identity_panel_seo_description' , array(
		'default' => 'Check out this cool website!', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_panel_seo_description', array(
            	'label'          => __( 'Site description (meta)', 'onepiece' ),
            	'section'        => 'onepiece_identity_panel_seo',
            	'settings'       => 'onepiece_identity_panel_seo_description',
            	'type'           => 'textarea',
 	    		'description'    => __( 'Description text for SEO. Tune it to your keywords.', 'onepiece' ),
    	)));


		$wp_customize->add_setting( 'onepiece_identity_panel_seo_trackcode' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_panel_seo_trackcode', array(
            	'label'          => __( 'Analytics Code', 'onepiece' ),
            	'section'        => 'onepiece_identity_panel_seo',
            	'settings'       => 'onepiece_identity_panel_seo_trackcode',
            	'type'           => 'textarea',
 	    		'description'    => __( 'Analytics Javascript Codes (ie. google js tracking). The code is place right after the body open tag.', 'onepiece' ),
    	)));


		
		/**
	 	* Api & Media
	 	* Todo: Hookup to WSL (or other oauth plugin)
	 	*/
		
		// API & MEDIA

		// Linkedin
		$wp_customize->add_setting( 'onepiece_media_panel_linkedin_id' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_linkedin_id', array(
            	'label'          => __( 'Account ID', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_linkedin',
            	'settings'       => 'onepiece_media_panel_linkedin_id',
            	'type'           => 'text',
 	    	'description'    => __( 'Account ID', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_media_panel_linkedin_api_id' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_linkedin_api_id', array(
            	'label'          => __( 'Api ID', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_linkedin',
            	'settings'       => 'onepiece_media_panel_linkedin_api_id',
            	'type'           => 'text',
 	    	'description'    => __( 'Api ID (see https://auth0.com/docs/connections/social/linkedin)', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_media_panel_linkedin_api_secret' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_linkedin_api_secret', array(
            	'label'          => __( 'Api secret', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_linkedin',
            	'settings'       => 'onepiece_media_panel_linkedin_api_secret',
            	'type'           => 'text',
 	    	'description'    => __( 'Api secret key (see https://auth0.com/docs/connections/social/linkedin)', 'onepiece' ),
    	)));

		// Twitter
		$wp_customize->add_setting( 'onepiece_media_panel_twitter_id' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_twitter_id', array(
            	'label'          => __( 'Account ID', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_twitter',
            	'settings'       => 'onepiece_media_panel_twitter_id',
            	'type'           => 'text',
 	    	'description'    => __( 'Account ID', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_media_panel_twitter_api_id' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_twitter_api_id', array(
            	'label'          => __( 'Api ID', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_twitter',
            	'settings'       => 'onepiece_media_panel_twitter_api_id',
            	'type'           => 'text',
 	    	'description'    => __( 'Api ID (see hhttps://dev.twitter.com/oauth/overview/introduction)', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_media_panel_twitter_api_secret' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_twitter_api_secret', array(
            	'label'          => __( 'Api secret', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_twitter',
            	'settings'       => 'onepiece_media_panel_twitter_api_secret',
            	'type'           => 'text',
 	    	'description'    => __( 'Api secret key (see https://dev.twitter.com/oauth/overview/introduction)', 'onepiece' ),
    	)));


		// Facebook
		$wp_customize->add_setting( 'onepiece_media_panel_facebook_id' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_facebook_id', array(
            	'label'          => __( 'Account ID', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_facebook',
            	'settings'       => 'onepiece_media_panel_facebook_id',
            	'type'           => 'text',
 	    	'description'    => __( 'Account ID', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_media_panel_facebook_api_id' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_facebook_api_id', array(
            	'label'          => __( 'Api ID', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_facebook',
            	'settings'       => 'onepiece_media_panel_facebook_api_id',
            	'type'           => 'text',
 	    	'description'    => __( 'Api ID (see https://developers.facebook.com/docs/apps/register)', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_media_panel_facebook_api_secret' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_facebook_api_secret', array(
            	'label'          => __( 'Api secret', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_facebook',
            	'settings'       => 'onepiece_media_panel_facebook_api_secret',
            	'type'           => 'text',
 	    	'description'    => __( 'Api secret key (see https://developers.facebook.com/docs/apps/register)', 'onepiece' ),
    	)));

		//  Github
		$wp_customize->add_setting( 'onepiece_media_panel_github_id' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_github_id', array(
            	'label'          => __( 'Account ID', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_github',
            	'settings'       => 'onepiece_media_panel_github_id',
            	'type'           => 'text',
 	    	'description'    => __( 'Account ID', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_media_panel_github_api_id' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_github_api_id', array(
            	'label'          => __( 'Api ID', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_github',
            	'settings'       => 'onepiece_media_panel_github_api_id',
            	'type'           => 'text',
 	    	'description'    => __( 'Api ID (see https://developer.github.com/guides/basics-of-authentication/)', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_media_panel_github_api_secret' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_github_api_secret', array(
            	'label'          => __( 'Api secret', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_github',
            	'settings'       => 'onepiece_media_panel_github_api_secret',
            	'type'           => 'text',
 	    	'description'    => __( 'Api secret key (see https://developer.github.com/guides/basics-of-authentication/)', 'onepiece' ),
    	)));



		// Google
		//https://developers.google.com/identity/protocols/OAuth2
		$wp_customize->add_setting( 'onepiece_media_panel_google_id' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_google_id', array(
            	'label'          => __( 'Account ID', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_google',
            	'settings'       => 'onepiece_media_panel_google_id',
            	'type'           => 'text',
 	    	'description'    => __( 'Account ID', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_media_panel_google_api_id' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_google_api_id', array(
            	'label'          => __( 'Api ID', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_google',
            	'settings'       => 'onepiece_media_panel_google_api_id',
            	'type'           => 'text',
 	    	'description'    => __( 'Api ID (see https://developers.google.com/identity/sign-in/web/devconsole-project)', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_media_panel_google_api_secret' , array(
		'default' => '',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_media_panel_google_api_secret', array(
            	'label'          => __( 'Api secret', 'onepiece' ),
            	'section'        => 'onepiece_media_panel_google',
            	'settings'       => 'onepiece_media_panel_google_api_secret',
            	'type'           => 'text',
 	    	'description'    => __( 'Api secret key (see https://developers.google.com/identity/sign-in/web/devconsole-project)', 'onepiece' ),
    	)));
	// Pinterest
	// Instagram
	// Thumblr
	// ..

		

	/*
	 *
	 * CONTENT
	 *
	 */

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
                	'40'   => __( '40', 'onepiece' ),
                	'45'   => __( '45', 'onepiece' ),
            		'50'   => __( '50', 'onepiece' ),
            		'60'   => __( '60', 'onepiece' ),
            		'66'   => __( '66', 'onepiece' ),
            		'75'   => __( '75', 'onepiece' ),
            		'80'   => __( '80', 'onepiece' ),
                	'85'   => __( '85', 'onepiece' ),
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


    	// CONTENT - POSTS - FEATURED IMAGE DISPLAY

	// Prepare plugin options:
	$featured_images_options = array(
                	'default'   => __( 'On top of the content', 'onepiece' ),
                	'left'   => __( 'Inline left with content (medium sized)', 'onepiece' ),
                	'right'   => __( 'Inline right with content (medium sized)', 'onepiece' ),
                	'replace'   => __( 'Replace Header Window width', 'onepiece' ),
                    	'replacemargin'   => __( 'Replace Header Content width', 'onepiece' ),
        	);

	// check for multiple featured images and extend/adjust options
	if( class_exists('Dynamic_Featured_Image') ) {
		$featured_images_options = array(
                	'default'   => __( 'On top of the content with thumbnav', 'onepiece' ),
                	'left'   => __( 'Inline left with thumbnav (medium sized)', 'onepiece' ),
                	'right'   => __( 'Inline right with thumbnav (medium sized)', 'onepiece' ),
                	'replace'   => __( 'Replace Header with thumbnav (Window width)', 'onepiece' ),
                    	'replacemargin'   => __( 'Replace Header with thumbnav (Content width)', 'onepiece' ),
        	);
	}
	
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
            	'choices'        => $featured_images_options
    	)));


		//CONTENT - POSTS - IMAGE WIDTH
		$wp_customize->add_setting( 'onepiece_content_panel_posts_imgwidth' , array(
		'default' => '37',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_imgwidth', array(
            	'label'          => __( 'Image width', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_imgwidth',
            	'type'           => 'text',
 	    		'description'    => __( 'Single Post Image width (only left/right in %)', 'onepiece' ),
    	)));
		
		// CONTENT - POSTS - SINGLE POST ALIGNMENT
		$wp_customize->add_setting( 'onepiece_content_panel_posts_textalign' , array(
		'default' => 'left', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_textalign', array(
            	'label'          => __( 'Text alignment', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_textalign',
            	'type'           => 'select',
 	    	    'description'    => __( 'Text alignment in single post view', 'onepiece' ),
            	'choices'        => array(
                	'left'   => __( 'Left', 'onepiece' ),
                	'right'   => __( 'Right', 'onepiece' ),
                	'center'   => __( 'Center', 'onepiece' ),
            	)
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
	
		// CONTENT - POSTS - DATE FORMAT
		$wp_customize->add_setting( 'onepiece_content_panel_posts_dateformat' , array(
		'default' => '1', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_dateformat', array(
            	'label'          => __( 'Post Date Format', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_dateformat',
            	'type'           => 'select',
 	    	    'description'    => __( 'Date display format', 'onepiece' ),
            	'choices'        => array(
                	'1'   => __( 'Time Ago', 'onepiece' ),
                	'2'   => __( 'Date', 'onepiece' ),
                	'3'   => __( 'Date and Time', 'onepiece' ),
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
		
		
		$wp_customize->add_setting( 'onepiece_content_panel_posts_previcon' , array(
		'default' => '<webicon icon="fa:chevron-left"/>',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_previcon', array(
            	'label'          => __( 'Prev post button', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_previcon',
            	'type'           => 'text',
 	    	'description'    => __( 'Prev post button text and/or icon html', 'onepiece' ),
    	)));

		$wp_customize->add_setting( 'onepiece_content_panel_posts_nexticon' , array(
		'default' => '<webicon icon="fa:chevron-right"/>',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_nexticon', array(
            	'label'          => __( 'Next post button', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_nexticon',
            	'type'           => 'text',
 	    	'description'    => __( 'Next post button text and/or icon html', 'onepiece' ),
    	)));

		$wp_customize->add_setting( 'onepiece_content_panel_posts_nextprevtitle' , array(
		'default' => 'none',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_nextprevtitle', array(
            	'label'          => __( 'Next / Previous post title', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_posts_nextprevtitle',
            	'type'           => 'select',
 	    	    'description'    => __( 'Next and Prev title link display in buttons', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'No display', 'onepiece' ),
                    'beside'   => __( 'Show title besides custom icon/text', 'onepiece' ),
                    'above'   => __( 'Show title above custom icon/text', 'onepiece' ),
                    'below'   => __( 'Show title below custom icon/text', 'onepiece' ),
            	)
    	)));











		/*
		Product
		.. turn off product options
		product order email address
		*/



		// CONTENT - PRODUCT - orderby
    	$wp_customize->add_setting( 'onepiece_content_panel_product_orderby_display' , array(
		'default' => 'none',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_product_orderby_display', array(
            	'label'          => __( 'Product order options', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_product',
            	'settings'       => 'onepiece_content_panel_product_orderby_display',
            	'type'           => 'select',
 	    	'description'    => __( 'Select order option', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'Do not use', 'onepiece' ),
                	'email'   => __( 'Order by Email', 'onepiece' ),
            	)
    	)));

		// CONTENT - PRODUCT - ORDER BY EMAIL
    	$wp_customize->add_setting( 'onepiece_content_panel_product_orderemailaddress' , array(
		'default' => get_option('admin_email'), 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_product_orderemailaddress', array(
            	'label'          => __( 'Order-by-Email address', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_product',
            	'settings'       => 'onepiece_content_panel_product_orderemailaddress',
            	'type'           => 'email',
 	    	'description'    => __( 'Email address for sales (order by mail)', 'onepiece' ),
    	)));
		
		// http://wordpress.stackexchange.com/questions/27856/is-there-a-way-to-send-html-formatted-emails-with-wordpress-wp-mail-function
		// onepiece_content_panel_product




		//Product LABELS
		$wp_customize->add_setting( 'onepiece_content_panel_product_label_new' , array(
		'default' => 'New',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_product_label_new', array(
            	'label'          => __( 'Label New', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_product',
            	'settings'       => 'onepiece_content_panel_product_label_new',
            	'type'           => 'text',
 	    	'description'    => __( 'Label text and/or icon html', 'onepiece' ),
    	)));

		$wp_customize->add_setting( 'onepiece_content_panel_product_label_special' , array(
		'default' => 'Special',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_product_label_special', array(
            	'label'          => __( 'Label Special', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_product',
            	'settings'       => 'onepiece_content_panel_product_label_special',
            	'type'           => 'text',
 	    	'description'    => __( 'Label text and/or icon html', 'onepiece' ),
    	)));

		$wp_customize->add_setting( 'onepiece_content_panel_product_label_featured' , array(
		'default' => 'Featured',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_product_label_featured', array(
            	'label'          => __( 'Label Featured', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_product',
            	'settings'       => 'onepiece_content_panel_product_label_featured',
            	'type'           => 'text',
 	    	'description'    => __( 'Label text and/or icon html', 'onepiece' ),
    	)));

		$wp_customize->add_setting( 'onepiece_content_panel_product_label_comingsoon' , array(
		'default' => 'Coming soon',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_product_label_comingsoon', array(
            	'label'          => __( 'Label Coming Soon', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_product',
            	'settings'       => 'onepiece_content_panel_product_label_comingsoon',
            	'type'           => 'text',
 	    	'description'    => __( 'Label text and/or icon html', 'onepiece' ),
    	)));

		$wp_customize->add_setting( 'onepiece_content_panel_product_label_alltimefavourite' , array(
		'default' => 'All time favourite',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_product_label_alltimefavourite', array(
            	'label'          => __( 'Label All Time Favourite', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_product',
            	'settings'       => 'onepiece_content_panel_product_label_alltimefavourite',
            	'type'           => 'text',
 	    	'description'    => __( 'Label text and/or icon html', 'onepiece' ),
    	)));
		
	
	

    	// CONTENT - LIST - HIGHLIGHT
    	$wp_customize->add_setting( 'onepiece_content_panel_postlist_firstcount' , array(
		'default' => '3', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_postlist_firstcount', array(
            	'label'          => __( 'Highlight first posts', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_list',
            	'settings'       => 'onepiece_content_panel_postlist_firstcount',
            	'type'           => 'text',
 	    		'description'    => __( 'Amount of first posts to highlight in a (basic)list.', 'onepiece' ),
    	)));
	
	
		// CONTENT - LIST - DATE FORMAT 
		$wp_customize->add_setting( 'onepiece_content_panel_postlist_dateformat' , array(
		'default' => '1', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_postlist_dateformat', array(
            	'label'          => __( 'Post listed date Format', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_list',
            	'settings'       => 'onepiece_content_panel_postlist_dateformat',
            	'type'           => 'select',
 	    	    'description'    => __( 'Date display format', 'onepiece' ),
            	'choices'        => array(
                	'1'   => __( 'Time Ago', 'onepiece' ),
                	'2'   => __( 'Date', 'onepiece' ),
                	'3'   => __( 'Date and Time', 'onepiece' ),
            	)
    	)));
	
		
		// CONTENT - LIST - EXCERPT LENGTH
    	$wp_customize->add_setting( 'onepiece_content_panel_postlist_excerptlength' , array(
		'default' => '25', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_postlist_excerptlength', array(
            	'label'          => __( 'Excerpt Length', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_list',
            	'settings'       => 'onepiece_content_panel_postlist_excerptlength',
            	'type'           => 'text',
 	    	'description'    => __( 'Amount of words for intro texts in a (basic) list.', 'onepiece' ),
    	)));

		// CONTENT - LIST - IMAGE ALIGNMENT
		$wp_customize->add_setting( 'onepiece_content_panel_postlist_inlineimage' , array(
		'default' => 'left', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		/* check for multiple featured images and extend/adjust options
		if( class_exists('Dynamic_Featured_Image') ) {
			$featured_images_options = array(
						'default'   => __( 'On top of the content with thumbnav', 'onepiece' ),
						'left'   => __( 'Inline left with thumbnav (medium sized)', 'onepiece' ),
						'right'   => __( 'Inline right with thumbnav (medium sized)', 'onepiece' ),
						'replace'   => __( 'Replace Header with thumbnav (Window width)', 'onepiece' ),
							'replacemargin'   => __( 'Replace Header with thumbnav (Content width)', 'onepiece' ),
				);
		}*/
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_postlist_inlineimage', array(
            	'label'          => __( 'Inline image alignment', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_list',
            	'settings'       => 'onepiece_content_panel_postlist_inlineimage',
            	'type'           => 'select',
 	    	    'description'    => __( 'Image default alignment in post excerpts', 'onepiece' ),
            	'choices'        => array(
                	'left'   => __( 'Left', 'onepiece' ),
                	'right'   => __( 'Right', 'onepiece' ),
                	'zigzag'   => __( 'Inline odd left and even right', 'onepiece' ),
                	'center'   => __( 'Center', 'onepiece' ),
            	)
    	)));



		//CONTENT - LIST - IMAGE WIDTH
		$wp_customize->add_setting( 'onepiece_content_panel_list_imgwidth' , array(
		'default' => '37',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_product_label_new', array(
            	'label'          => __( 'Image width', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_list',
            	'settings'       => 'onepiece_content_panel_list_imgwidth',
            	'type'           => 'text',
 	    		'description'    => __( 'Listed Post Image width (left/right in %)', 'onepiece' ),
    	)));
		
		
		// CONTENT - LIST - EXCERPT ALIGNMENT
		$wp_customize->add_setting( 'onepiece_content_panel_postlist_textalign' , array(
		'default' => 'left', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_postlist_textalign', array(
            	'label'          => __( 'Excerpt Text alignment', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_list',
            	'settings'       => 'onepiece_content_panel_postlist_textalign',
            	'type'           => 'select',
 	    	    'description'    => __( 'Text alignment in post content in list view', 'onepiece' ),
            	'choices'        => array(
                	'left'   => __( 'Left', 'onepiece' ),
                	'right'   => __( 'Right', 'onepiece' ),
                	'center'   => __( 'Center', 'onepiece' ),
            	)
    	)));
		
		
		// CONTENT - LIST - READMORE
		$wp_customize->add_setting( 'onepiece_content_panel_posts_readmore' , array(
		'default' => 'none', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_posts_readmore', array(
            	'label'          => __( 'Post Read more', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_list',
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

		
    	// CONTENT - LIST - EXCLUDE CATEGORIES  Add multi select 
		// source used: http://themefoundation.com/customizer-multiple-category-control/
		// .. http://jayj.dk/multiple-select-lists-theme-customizer/
		$wp_customize->add_setting( 'onepiece_content_exclude_categories'  , array( 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		 
		$wp_customize->add_control(
			new onepiece_multiselect_exclude_categories(
				$wp_customize,
				'onepiece_content_exclude_categories',
				array(
					'label' => __( 'Exclude Categories', 'onepiece' ),
 	    			'description'    => __( 'Select post categories to be excluded from the main loop (post overview)', 'onepiece' ),
					'section' => 'onepiece_content_panel_list',
					'settings' => 'onepiece_content_exclude_categories'
				)
			)
		);
	
    	// CONTENT - LIST - category title / text
    	$wp_customize->add_setting( 'onepiece_content_panel_list_titledisplay' , array(
		'default' => 'title', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_list_titledisplay', array(
            	'label'          => __( 'Category Title & Description', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_list',
            	'settings'       => 'onepiece_content_panel_list_titledisplay',
            	'type'           => 'select',
 	    	'description'    => __( 'Select display type', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'No title', 'onepiece' ),
                	'title'   => __( 'Title', 'onepiece' ),
            		'text'   => __( 'Title and description', 'onepiece' ),
            	)
    	)));

    	// CONTENT - GALLERY 
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
		
	    // CONTENT - GALELRY - Link Post list Widget
		$wp_customize->add_setting( 'onepiece_content_gallery_linkpostlistwidget' , array(
		'default' => 'yes',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_gallery_linkpostlistwidget', array(
            	'label'          => __( 'Link widget click', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_gallery',
            	'settings'       => 'onepiece_content_gallery_linkpostlistwidget',
            	'type'           => 'select',
 	    	'description'    => __( 'Link post-list-widget items to gallery click action', 'onepiece' ),
            	'choices'        => array(
                	'no'   => __( 'No', 'onepiece' ),
                	'yes'   => __( 'Yes', 'onepiece' ),
            	)
    	)));






	/*
	 *
	 * ELEMENTS
	 *
	 */


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
		

		// ELEMENTS - HEADER IMAGE - OVERLAY
		$wp_customize->add_setting( 'onepiece_elements_headerimage_overlay' , array(
		'default' => 'none',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_headerimage_overlay', array(
            	'label'          => __( 'Header overlay', 'onepiece' ),
            	'section'        => 'header_image',
            	'settings'       => 'onepiece_elements_headerimage_overlay',
            	'type'           => 'select',
 	    		'description'    => __( 'Select header overlay', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'No overlay', 'onepiece' ),
                	'blank'   => __( 'Blank (add custom css on .header-overlay)', 'onepiece' ),
            	)
    	)));
	    /*
			opacity:0.4;
			background-color:black;
		*/
		
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
                	'relf'   => __( 'Header top, scroll fixed minified', 'onepiece' ),
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
		
    	
		
		// TOP SIDEBAR
		$wp_customize->add_setting( 'onepiece_elements_topsidebar_position' , array(
		'default' => 'none', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_topsidebar_position', array(
            	'label'          => __( 'Top sidebar position', 'onepiece' ),
            	'section'        => 'onepiece_elements_topmenubar',
            	'settings'       => 'onepiece_elements_topsidebar_position',
            	'type'           => 'select',
 	    		'description'    => __( 'Select the default top sidebar position.', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'none', 'onepiece' ),
                	'left'   => __( 'left', 'onepiece' ),
            		'right'   => __( 'right', 'onepiece' ),
            	)
    	)));
		
		$wp_customize->add_setting( 'onepiece_elements_topsidebar_width' , array(
		'default' => '30', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_topsidebar_width', array(
            	'label'          => __( 'Sidebar width', 'onepiece' ),
            	'section'        => 'onepiece_elements_topmenubar',
            	'settings'       => 'onepiece_elements_topsidebar_width',
            	'type'           => 'text',
 	    	'description'    => __( 'Select sidebar width (percentage).', 'onepiece' ),
    	)));

		$wp_customize->add_setting( 'onepiece_elements_topsidebar_responsive' , array(
		'default' => 'none',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_topsidebar_responsive', array(
            	'label'          => __( 'Top sidebar responsive position', 'onepiece' ),
            	'section'        => 'onepiece_elements_topmenubar',
            	'settings'       => 'onepiece_elements_topsidebar_responsive',
            	'type'           => 'select',
 	    	'description'    => __( 'Where to position this sidebar on small screens:', 'onepiece' ),
            	'choices'        => array(
                	'hide'   => __( 'hide', 'onepiece' ),
                	'top'   => __( 'on page top', 'onepiece' ),
            		'before'   => __( 'before main content', 'onepiece' ),
            		'after'   => __( 'after main content', 'onepiece' ),
            		'bottom'   => __( 'bottom content above footer', 'onepiece' ),
            	)
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
 	    		'description'    => __( 'Select when to minisize (collapse) the menubar.', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'Never minisize', 'onepiece' ),
                	'always'   => __( 'Minisize menu (always)', 'onepiece' ),
                	'sticky'   => __( 'Minisize sticky menu (when sticky only)', 'onepiece' ),
                	'respon'   => __( 'Minisize in small screens (responsive)', 'onepiece' ),
					'respon2'   => __( 'Minisize in small and medium screens (responsive)', 'onepiece' ),
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
            		'pgtop'   => __( 'Topbar widget top area', 'onepiece' ),
            		'tbtop'   => __( 'Topbar (after minimenu)', 'onepiece' ),
            		'tstop'   => __( 'Topbar sidebar top', 'onepiece' ),
            		'tsbot'   => __( 'Topbar sidebar bottom', 'onepiece' ),
            		'cbtop'   => __( 'Before main content', 'onepiece' ),
            		'cbbot'   => __( 'After main content', 'onepiece' ),
            		'sbtop'   => __( 'Main sidebar top', 'onepiece' ),
            		'sbbottom'   => __( 'Main sidebar bottom', 'onepiece' ),
            		'sb2top'   => __( 'Sidebar 2 Top', 'onepiece' ),
            		'sb2bottom'   => __( 'Sidebar 2 bottom', 'onepiece' ),
            		'sbctop'   => __( 'Subcontent sidebar top', 'onepiece' ),
            		'sbcbot'   => __( 'Subcontent sidebar bottom', 'onepiece' ),
            		'bsbtop'   => __( 'Bottom sidebar top', 'onepiece' ),
            		'bsbbot'   => __( 'Bottom sidebar bottom', 'onepiece' ),
            	)
    	)));
		$wp_customize->add_setting( 'onepiece_elements_loginbar_iconhtml' , array(
		'default' => '<webicon icon="wpf:user-shield"/>',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_loginbar_iconhtml', array(
            	'label'          => __( 'Loginbar webicon/img html', 'onepiece' ),
            	'section'        => 'onepiece_elements_loginbar',
            	'settings'       => 'onepiece_elements_loginbar_iconhtml',
            	'type'           => 'text',
 	    	'description'    => __( 'Html for login box img/webicon', 'onepiece' ),
    	)));
		$wp_customize->add_setting( 'onepiece_elements_loginbar_usericonhtml' , array(
		'default' => '<webicon icon="wpf:collaborator"/>',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_loginbar_usericonhtml', array(
            	'label'          => __( 'Userbox webicon/img html', 'onepiece' ),
            	'section'        => 'onepiece_elements_loginbar',
            	'settings'       => 'onepiece_elements_loginbar_usericonhtml',
            	'type'           => 'text',
 	    	'description'    => __( 'Html for (loggedin) userbox img/webicon', 'onepiece' ),
    	)));
		
    	
		// ELEMENTS - BREADCRUMBS

		$wp_customize->add_setting( 'onepiece_elements_breadcrumbs_display' , array(
		'default' => 'top',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_breadcrumbs_display', array(
            	'label'          => __( 'Breadcrumbsbar Position', 'onepiece' ),
            	'section'        => 'onepiece_elements_breadcrumbs',
            	'settings'       => 'onepiece_elements_breadcrumbs_display',
            	'type'           => 'select',
 	    	'description'    => __( 'Select how to display the breadcrumbs bar (link-path).', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'hide', 'onepiece' ),
                	'top'   => __( 'On top of all main content', 'onepiece' ),
            		'befor'   => __( 'Before the page main content (after before widgets)', 'onepiece' ),
            	)
    	)));


		$wp_customize->add_setting( 'onepiece_elements_breadcrumbs_onpages' , array(
		'default' => 'all',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_breadcrumbs_onpages', array(
            	'label'          => __( 'Where to display', 'onepiece' ),
            	'section'        => 'onepiece_elements_breadcrumbs',
            	'settings'       => 'onepiece_elements_breadcrumbs_onpages',
            	'type'           => 'select',
 	    	'description'    => __( 'Select when to show breadcrumbs bar.', 'onepiece' ),
            	'choices'        => array(
                	'all'   => __( 'Always', 'onepiece' ),
                	'post'   => __( 'Only category/post views', 'onepiece' ),
            	)
    	)));

		$wp_customize->add_setting( 'onepiece_elements_breadcrumbs_homelink' , array(
		'default' => 'no',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_breadcrumbs_homelink', array(
            	'label'          => __( 'Show Home link', 'onepiece' ),
            	'section'        => 'onepiece_elements_breadcrumbs',
            	'settings'       => 'onepiece_elements_breadcrumbs_homelink',
            	'type'           => 'select',
 	    	'description'    => __( 'Select to display the breadcrumbs home link.', 'onepiece' ),
            	'choices'        => array(
                	'no'   => __( 'No', 'onepiece' ),
                	'yes'   => __( 'Yes', 'onepiece' ),
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


		$wp_customize->add_setting( 'onepiece_elements_mainsidebar_responsive' , array(
		'default' => 'none',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_mainsidebar_responsive', array(
            	'label'          => __( 'Main sidebar responsive position', 'onepiece' ),
            	'section'        => 'onepiece_elements_sidebar',
            	'settings'       => 'onepiece_elements_mainsidebar_responsive',
            	'type'           => 'select',
 	    	'description'    => __( 'Where to position this sidebar on small screens:', 'onepiece' ),
            	'choices'        => array(
                	'hide'   => __( 'hide', 'onepiece' ),
            		'before'   => __( 'before main content', 'onepiece' ),
            		'after'   => __( 'after main content', 'onepiece' ),
            	)
    	)));
	
	
		
		$wp_customize->add_setting( 'onepiece_elements_mainsidebar_sticky' , array(
		'default' => '0', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_mainsidebar_sticky', array(
            	'label'          => __( 'Sticky behavior', 'onepiece' ),
            	'section'        => 'onepiece_elements_sidebar',
            	'settings'       => 'onepiece_elements_mainsidebar_sticky',
            	'type'           => 'select',
 	    	'description'    => __( 'Make sidebar sticky (medium and large screens)', 'onepiece' ),
            	'choices'        => array(
                	'0'   => __( 'Not sticky, scroll with content', 'onepiece' ),
            		'1'   => __( 'Stick to page top/topbar on scroll', 'onepiece' ),
            	)
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
		
		$wp_customize->add_setting( 'onepiece_elements_sidebar2_responsive' , array(
		'default' => 'none',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_sidebar2_responsive', array(
            	'label'          => __( 'Second sidebar responsive position', 'onepiece' ),
            	'section'        => 'onepiece_elements_sidebar2',
            	'settings'       => 'onepiece_elements_sidebar2_responsive',
            	'type'           => 'select',
 	    	'description'    => __( 'Where to position this sidebar on small screens:', 'onepiece' ),
            	'choices'        => array(
                	'hide'   => __( 'hide', 'onepiece' ),
            		'before'   => __( 'before main content', 'onepiece' ),
            		'after'   => __( 'after main content', 'onepiece' ),
            	)
    	)));
	
		
		
		$wp_customize->add_setting( 'onepiece_elements_sidebar2_sticky' , array(
		'default' => '0', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_sidebar2_sticky', array(
            	'label'          => __( 'Sticky behavior', 'onepiece' ),
            	'section'        => 'onepiece_elements_sidebar2',
            	'settings'       => 'onepiece_elements_sidebar2_sticky',
            	'type'           => 'select',
 	    	'description'    => __( 'Make second sidebar sticky (medium and large screens)', 'onepiece' ),
            	'choices'        => array(
                	'0'   => __( 'Not sticky, scroll with content', 'onepiece' ),
            		'1'   => __( 'Stick to page top/topbar on scroll', 'onepiece' ),
            	)
    	)));





	// SUBCONTENT SIDEBAR
		$wp_customize->add_setting( 'onepiece_elements_subcontent_sidebar_position' , array(
		'default' => 'none',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_subcontent_sidebar_position', array(
            	'label'          => __( 'Subcontent sidebar position', 'onepiece' ),
            	'section'        => 'onepiece_elements_subcontent',
            	'settings'       => 'onepiece_elements_subcontent_sidebar_position',
            	'type'           => 'select',
 	    	'description'    => __( 'Select the default subcontent sidebar position.', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'none', 'onepiece' ),
                	'left'   => __( 'left', 'onepiece' ),
            		'right'   => __( 'right', 'onepiece' ),
            	)
    	)));

		$wp_customize->add_setting( 'onepiece_elements_subcontent_sidebar_width' , array(
		'default' => '30',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_subcontent_sidebar_width', array(
            	'label'          => __( 'Sidebar width', 'onepiece' ),
            	'section'        => 'onepiece_elements_subcontent',
            	'settings'       => 'onepiece_elements_subcontent_sidebar_width',
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
		
		
		// BOTTOM SIDEBAR
		$wp_customize->add_setting( 'onepiece_elements_bottom_sidebar_position' , array(
		'default' => 'none', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_bottom_sidebar_position', array(
            	'label'          => __( 'Footer sidebar position', 'onepiece' ),
            	'section'        => 'onepiece_elements_bottommenubar',
            	'settings'       => 'onepiece_elements_bottom_sidebar_position',
            	'type'           => 'select',
 	    	'description'    => __( 'Select the default bottom sidebar position.', 'onepiece' ),
            	'choices'        => array(
                	'none'   => __( 'none', 'onepiece' ),
                	'left'   => __( 'left', 'onepiece' ),
            		'right'   => __( 'right', 'onepiece' ),
            	)
    	)));
		
		$wp_customize->add_setting( 'onepiece_elements_bottom_sidebar_width' , array(
		'default' => '30', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_bottom_sidebar_width', array(
            	'label'          => __( 'Sidebar width', 'onepiece' ),
            	'section'        => 'onepiece_elements_bottommenubar',
            	'settings'       => 'onepiece_elements_bottom_sidebar_width',
            	'type'           => 'text',
 	    	'description'    => __( 'Select sidebar width (percentage).', 'onepiece' ),
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
		

	


	/*
	 *
	 * RESPONSIVE
	 *
	 */

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
		
		



	/*
	 *
	 * STYLE & LAYOUT
	 *
	 */

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


		/*
		 * FONTS
		 */


		// FONTS - MAIN
    	$wp_customize->add_setting( 'onepiece_style_fonts_maintype' , array(
		'default' => 'arial',
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_style_fonts_maintype', array(
            	'label'          => __( 'Default', 'onepiece' ),
            	'section'        => 'fonts',
            	'settings'       => 'onepiece_style_fonts_maintype',
 	    	'description'    => __( 'Select the default font type.', 'onepiece' ),
            	'type'    => 'select',
    		'choices' => get_fonts_select()
    	)));


		// FONTS - Page / default h1 title (type/size)
		$wp_customize->add_setting( 'onepiece_style_fonts_pagetitle' , array(
		'default' => 'default',
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_style_fonts_pagetitle', array(
            	'label'          => __( 'Page / Default titles', 'onepiece' ),
            	'section'        => 'fonts',
            	'settings'       => 'onepiece_style_fonts_pagetitle',
 	    	'description'    => __( 'Select the page/default title font type.', 'onepiece' ),
            	'type'    => 'select',
    		'choices' => get_fonts_select()
    	)));

		// FONTS - List/Category post title h2 (type/size)
		$wp_customize->add_setting( 'onepiece_style_fonts_postlisttitle' , array(
		'default' => 'default',
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_style_fonts_postlisttitle', array(
            	'label'          => __( 'Listed post titles', 'onepiece' ),
            	'section'        => 'fonts',
            	'settings'       => 'onepiece_style_fonts_postlisttitle',
 	    	'description'    => __( 'Select the listed Post title font type.', 'onepiece' ),
            	'type'    => 'select',
    		'choices' => get_fonts_select()
    	)));

		// FONTS - Post title h1 (type/size)
		$wp_customize->add_setting( 'onepiece_style_fonts_posttitle' , array(
		'default' => 'default',
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_style_fonts_posttitle', array(
            	'label'          => __( 'Post single title', 'onepiece' ),
            	'section'        => 'fonts',
            	'settings'       => 'onepiece_style_fonts_posttitle',
 	    	'description'    => __( 'Select the single Post title font type.', 'onepiece' ),
            	'type'    => 'select',
    		'choices' => get_fonts_select()
    	)));

		// FONTS -Widget title h3 (type/size)
		$wp_customize->add_setting( 'onepiece_style_fonts_widgettitle' , array(
		'default' => 'default',
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_style_fonts_widgettitle', array(
            	'label'          => __( 'Widget titles', 'onepiece' ),
            	'section'        => 'fonts',
            	'settings'       => 'onepiece_style_fonts_widgettitle',
 	    	'description'    => __( 'Select the Widget title font type.', 'onepiece' ),
            	'type'    => 'select',
    		'choices' => get_fonts_select()
    	)));

		// FONTS -Widget list item title h4 (type/size)
		$wp_customize->add_setting( 'onepiece_style_fonts_widgetitemtitle' , array(
		'default' => 'default',
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_style_fonts_widgetitemtitle', array(
            	'label'          => __( 'Widget listed item titles', 'onepiece' ),
            	'section'        => 'fonts',
            	'settings'       => 'onepiece_style_fonts_widgetitemtitle',
 	    	'description'    => __( 'Select the Widget listed item title font type.', 'onepiece' ),
            	'type'    => 'select',
    		'choices' => get_fonts_select()
    	)));



		/*
		 *
		 * COLORS
		 *
		 */



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



		// topbar bg color
		$wp_customize->add_setting( 'onepiece_identity_colors_topbarbg' , array(
		'default' => '#ffffff',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_topbarbg', array(
		'label' => __( 'Topbar background color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_topbarbg',
    	) ) );

		// topbar text color
		$wp_customize->add_setting( 'onepiece_identity_colors_topbartext' , array(
		'default' => '#232323',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_topbartext', array(
		'label' => __( 'Topbar text color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_topbartext',
    	) ) );

		// topbar textlink color
		$wp_customize->add_setting( 'onepiece_identity_colors_topbartextlink' , array(
		'default' => '#000000',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_topbartextlink', array(
		'label' => __( 'Topbar textlink color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_topbartextlink',
    	) ) );

		// topbar textlink hover color
		$wp_customize->add_setting( 'onepiece_identity_colors_topbartextlinkhover' , array(
		'default' => '#232323',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_topbartextlinkhover', array(
		'label' => __( 'Topbar link hover color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_topbartextlinkhover',
    	) ) );


	// Icons
		$wp_customize->add_setting( 'onepiece_identity_icons_loader', array(
		'sanitize_callback' => 'onepiece_sanitize_default',
		'default' => esc_url( get_template_directory_uri() ).'/icons/loader_icon_circle_default.gif',
	    ));

	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'onepiece_identity_icons_loader', array(
        	'label'    => __( 'Loader image', 'onepiece' ),
        	'section'  => 'icons',
        	'settings' => 'onepiece_identity_icons_loader',
		'description' => __( 'Upload or select a loader icon (replacing the default loader).', 'onepiece' ),
        	'priority' => 10,
    	) ) );



	// Scroll to top button

		$wp_customize->add_setting( 'onepiece_identity_scrolltotop_display' , array(
		'default' => 'br',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_scrolltotop_display', array(
            	'label'          => __( 'ScrolltoTop Button display', 'onepiece' ),
            	'section'        => 'icons',
            	'settings'       => 'onepiece_identity_scrolltotop_display',
            	'type'           => 'select',
 	    	'description'    => __( 'Display/position scroll-to-top button.', 'onepiece' ),
            	'choices'        => array(
                	'hi'   => __( 'hide', 'onepiece' ),
                	'br'   => __( 'bottom right', 'onepiece' ),
            		'bl'   => __( 'bottom left', 'onepiece' ),
            		'tr'   => __( 'top right', 'onepiece' ),
            		'tl'   => __( 'top left', 'onepiece' ),
            	)
    	)));

		$wp_customize->add_setting( 'onepiece_identity_scrolltotop_html' , array(
		'default' => '<webicon icon="fa:chevron-up"/>',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_scrolltotop_html', array(
            	'label'          => __( 'Button text or html', 'onepiece' ),
            	'section'        => 'icons',
            	'settings'       => 'onepiece_identity_scrolltotop_html',
            	'type'           => 'text',
 	    		'description'    => __( 'Scroll-to-top button text or html(icon) content.', 'onepiece' ),
    	)));


		$wp_customize->add_setting( 'onepiece_identity_scrolltotop_margin' , array(
		'default' => '15px 15px',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_scrolltotop_margin', array(
            	'label'          => __( 'ScrolltoTop button Margin', 'onepiece' ),
            	'section'        => 'icons',
            	'settings'       => 'onepiece_identity_scrolltotop_margin',
            	'type'           => 'text',
 	    		'description'    => __( 'Distance from window borders ( [top/bottom]px [left/right]px )', 'onepiece' ),
    	)));

		$wp_customize->add_setting( 'onepiece_identity_scrolltotop_padding' , array(
		'default' => '5px 9px',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	));
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_identity_scrolltotop_padding', array(
            	'label'          => __( 'ScrolltoTop button padding', 'onepiece' ),
            	'section'        => 'icons',
            	'settings'       => 'onepiece_identity_scrolltotop_padding',
            	'type'           => 'text',
 	    		'description'    => __( 'Button inside padding ( [top/bottom]px [left/right]px )', 'onepiece' ),
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