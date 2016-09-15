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

/*
// mainmenu bg .. onepiece_identity_colors_mainmenubg

// mainmenu button bg .. onepiece_identity_colors_mainmenubutbg
		
// mainmenu button link color .. onepiece_identity_colors_mainmenubutlink
		
// mainmenu button hover bg color .. onepiece_identity_colors_mainmenubutbghover
		
// mainmenu button hover link color.. onepiece_identity_colors_mainmenubutlinkhover
		
// mainmenu button active bg color.. onepiece_identity_colors_mainmenubutbgactive
		
// mainmenu button active link color .. onepiece_identity_colors_mainmenubutlinkactive
*/

</style>
<?

}
add_action( 'wp_head' , 'onepiece_customize_colors' );
?>
