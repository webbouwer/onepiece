<?php
/* ...  https://www.smashingmagazine.com/2013/03/the-wordpress-theme-customizer-a-developers-guide/

// Sources used
// http://buildwpyourself.com/building-theme-color-options-customizer/
// https://codex.wordpress.org/Class_Reference/WP_Customize_Control
// http://wptheming.com/2014/09/customizer-panels-field-types/
// http://www.divjot.co/smart-controls-wordpress-customizer/
// >> http://code.tutsplus.com/tutorials/a-guide-to-the-wordpress-theme-customizer-adding-a-new-setting--wp-33180
// http://www.wpbeginner.com/wp-tutorials/how-to-create-a-custom-wordpress-widget/
// http://josephfitzsimmons.com/adding-a-select-box-with-categories-into-wordpress-theme-customizer/

OVERVIEW (.. = todo )


Identity:
    Logo image 
        image medium
    	max-width
        image small
    
    Title, Tagline & Icon image
        Site Title
        Site Description/Tagline
        Site Icon image
    
    Featured site-image
        image
	..content max width
		
    Style & Layout
	select style (css file)
	.. bold / minified
	
	.. Users
	   
Content:
    Static front page (default)
	
    Pages
        date/author display

    Posts
        ..Exclude categories
        Use highlight first posts
        Display date/author
        Featured image header
        
    Category
        Display category list Title & Description 
        ..Exclude categories

   
Elements:


    Background image    


    Top menu bar
        Display none/position
        .. above / fixed overlay / absolute overlay
    
    .. Login tabbar    
        .. Display none/position
      
    Header image
		Image
		Headerimage width (content/full)
	
    ..Slider
		display
		category 
		height
		width type
		
    Main menu bar
        Display hide/position horizontal
		Positioning vertical/placement
		
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
    Top
    Main
    Side
    Bottom
    
Widgets:
    Top
    Header
    Sidebar
    Sidebar2
    Special Widgets
    Before (content)
    After (content)
    Subcontent
    Bottom

Responsive
	Small
		screen max width (switch to medium)
		outermargin default width (%)
		content max width
	Medium
		screen max width (switch to large)
		outermargin default width (%)
		content max width
	Large
	
*/
function onepiece_register_theme_customizer( $wp_customize ) {
    
    
	$wp_customize->remove_control('display_header_text');
	// remove default title / site-identity
	//$wp_customize->remove_section('title_tagline');
	// remove default colors
	$wp_customize->remove_control('header_textcolor'); 
	$wp_customize->remove_control('background_color');
	$wp_customize->remove_panel('colors');
	
	
        // add panels
    	$wp_customize->add_panel('onepiece_elements_identity', array( 
        	'title'    => __('Identity', 'onepiece'),
        	'priority' => 10,
    	));
	    $wp_customize->add_panel('onepiece_content_panel', array( 
        	'title'    => __('Content', 'onepiece'),
        	'priority' => 20,
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
        	'title'    => __('Featured image', 'onepiece'),
        	'panel'  => 'onepiece_elements_identity',
		'priority' => 30,
    	));

        $wp_customize->add_section('onepiece_identity_stylelayout', array( 
        	'title'    => __('Style & Layout', 'onepiece'),
        	'panel'  => 'onepiece_elements_identity',
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
    	$wp_customize->add_section('onepiece_content_panel_page', array( 
        	'title'    => __('Pages', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	$wp_customize->add_section('onepiece_content_panel_posts', array( 
        	'title'    => __('Posts', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	$wp_customize->add_section('onepiece_content_panel_category', array( 
        	'title'    => __('Categories', 'onepiece'),
        	'panel'  => 'onepiece_content_panel',
    	));
    	
		$wp_customize->add_section('onepiece_elements_topmenubar', array( 
        	'title'    => __('Topbar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
		'priority' => 20,
    	));
		
    	$wp_customize->add_section('onepiece_elements_mainmenubar', array( 
        	'title'    => __('Main menubar', 'onepiece'),
        	'panel'  => 'onepiece_elements_panel',
		'priority' => 40,
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
		'description' => __( 'Upload or select a featured site-image, this will be used when no source related image is available.', 'onepiece' ),
        	'priority' => 10,
    	) ) );
    	

		// STYLE & LAYOUT
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
            	'label'          => __( 'Slider category', 'fndtn' ),
            	'section'        => 'onepiece_content_sliderbar',
            	'settings'       => 'onepiece_content_sliderbar_category', 
 	    	'description'    => __( 'Select the post category for the slider. !This function is in development', 'fndtn' ),
            	'type'    => 'select',
    		'choices' => get_categories_select()
    	)));
		
		$wp_customize->add_setting( 'onepiece_content_sliderbar_height' , array(
		'default' => '33', 
    	//'capability' => 'edit_theme_options',
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_sliderbar_height', array(
            	'label'          => __( 'Slider height', 'fndtn' ),
            	'section'        => 'onepiece_content_sliderbar',
            	'settings'       => 'onepiece_content_sliderbar_height', 
 	    	'description'    => __( 'Height (%)', 'fndtn' ),
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
            	'label'          => __( 'Slider width', 'fndtn' ),
            	'section'        => 'onepiece_content_sliderbar',
            	'settings'       => 'onepiece_content_sliderbar_width', 
 	    	'description'    => __( 'Width (relative to)', 'fndtn' ),
            	'type'    => 'select',
    		'choices' => array(
                	'margin'   => __( 'content outer margin', 'onepiece' ),
                	'full'   => __( 'window', 'onepiece' ),
                	
            	)
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
 


    	// CONTENT - POSTS 
    	$wp_customize->add_setting( 'onepiece_content_panel_postlist_firstcount' , array(
		'default' => '3', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_content_panel_postlist_firstcount', array(
            	'label'          => __( 'Highlite first posts', 'onepiece' ),
            	'section'        => 'onepiece_content_panel_posts',
            	'settings'       => 'onepiece_content_panel_postlist_firstcount',
            	'type'           => 'text',
 	    	'description'    => __( 'Amount of first posts to highlite in a (basic)list.', 'onepiece' ),
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
    	
		
		

		
		// ELEMENTS - HEADER IMAGE
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
		
		
		// ELEMENTS - TOP MENU BAR
		//above / fixed overlay / absolute overlay
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
		
    	
    	
		
    	
    	// MAIN MENU BAR
		$wp_customize->add_setting( 'onepiece_elements_mainmenubar_position' , array(
		'default' => 'right', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
    	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'onepiece_elements_mainmenubar_position', array(
            	'label'          => __( 'Main Menu Position', 'onepiece' ),
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
            	'label'          => __( 'Main Menu Position', 'onepiece' ),
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
    	
		
		// MAIN SIDEBAR
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
?>
