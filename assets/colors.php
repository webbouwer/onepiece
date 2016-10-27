<?php
/**
 * Customizer colors
 */
function onepiece_customize_colors() {

?>
<style type='text/css'>

/* body */
body {
background-color:<?php echo get_theme_mod('onepiece_identity_colors_bodybg' , '#ffffff') ?> ;
color:<?php echo get_theme_mod('onepiece_identity_colors_bodytext' , '#232323' ) ?> ;
}
a {
color:<?php echo get_theme_mod('onepiece_identity_colors_bodylink' , '#000000' ) ?> ;
}
a:hover {
color:<?php echo get_theme_mod('onepiece_identity_colors_bodylinkhover' , '#232323'); ?> ;
}


/* topbar */
#topbar div.minifiedtopbarbg {
background-color:<?php echo get_theme_mod('onepiece_identity_colors_topbarbg' , '#ffffff'); ?> ;
}
#topbar {
color:<?php echo get_theme_mod('onepiece_identity_colors_topbartext' , '#232323'); ?> ;
}
#topbar a {
color:<?php echo get_theme_mod('onepiece_identity_colors_topbartextlink' , '#000000'); ?> ;
}
#topbar a:hover {
color:<?php echo get_theme_mod('onepiece_identity_colors_topbartextlinkhover' , '#232323'); ?> ;
}


</style>
<?php

}
add_action( 'wp_head' , 'onepiece_customize_colors' );

/*
// mainmenu bg .. onepiece_identity_colors_mainmenubg

// mainmenu button bg .. onepiece_identity_colors_mainmenubutbg
		
// mainmenu button link color .. onepiece_identity_colors_mainmenubutlink
		
// mainmenu button hover bg color .. onepiece_identity_colors_mainmenubutbghover
		
// mainmenu button hover link color.. onepiece_identity_colors_mainmenubutlinkhover
		
// mainmenu button active bg color.. onepiece_identity_colors_mainmenubutbgactive
		
// mainmenu button active link color .. onepiece_identity_colors_mainmenubutlinkactive
*/

	/* More colors	
		
		// mainmenu bg
		$wp_customize->add_setting( 'onepiece_identity_colors_mainmenubg' , array(
		'default' => '#cccccc', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_mainmenubg', array(
		'label' => __( 'Mainmenu background color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_mainmenubg',
    	) ) ); 
		// mainmenu button bg
		$wp_customize->add_setting( 'onepiece_identity_colors_mainmenubutbg' , array(
		'default' => '#cecece', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_mainmenubutbg', array(
		'label' => __( 'Mainmenu button bg color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_mainmenubutbg',
    	) ) ); 
		
		// mainmenu button link color
		$wp_customize->add_setting( 'onepiece_identity_colors_mainmenubutlink' , array(
		'default' => '#454545', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_mainmenubutlink', array(
		'label' => __( 'Mainmenu button text color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_mainmenubutlink',
    	) ) ); 
		
		// mainmenu button hover bg color
		$wp_customize->add_setting( 'onepiece_identity_colors_mainmenubutbghover' , array(
		'default' => '#000000', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_mainmenubutbghover', array(
		'label' => __( 'Mainmenu hover button bg color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_mainmenubutbghover',
    	) ) ); 
		
		// mainmenu button hover link color
		$wp_customize->add_setting( 'onepiece_identity_colors_mainmenubutlinkhover' , array(
		'default' => '#cecece', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_mainmenubutlinkhover', array(
		'label' => __( 'Mainmenu hover button text color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_mainmenubutlinkhover',
    	) ) ); 
		
		// mainmenu button active bg color
		$wp_customize->add_setting( 'onepiece_identity_colors_mainmenubutbgactive' , array(
		'default' => '#ffffff', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_mainmenubutbgactive', array(
		'label' => __( 'Mainmenu active button bg color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_mainmenubutbgactive',
    	) ) );
		// mainmenu button active link color
		$wp_customize->add_setting( 'onepiece_identity_colors_mainmenubutlinkactive' , array(
		'default' => '#232323', 
		'sanitize_callback' => 'onepiece_sanitize_default',
    	)); 
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepiece_identity_colors_mainmenubutlinkactive', array(
		'label' => __( 'Mainmenu active button text color', 'onepiece' ),
		'section' => 'colors',
		'settings' => 'onepiece_identity_colors_mainmenubutlinkactive',
    	) ) ); 
		
	*/	


?>
