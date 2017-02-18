<?php 
/********** PAGE CUSTOM META FIELDS **********/
function add_page_meta_box()
{
    add_meta_box(
        "page-custom-meta-box", 
        "Page Elements", 
        "page_meta_custom_fields", 
        "page", 
        "side", 
        "high", 
        null);
}
add_action("add_meta_boxes", "add_page_meta_box");

function page_meta_custom_fields($object)
{
wp_nonce_field(basename(__FILE__), "meta-box-nonce");
$useheaderimage = get_post_meta($object->ID, "meta-page-headerimage", true);
$headerwidgetdisplay = get_post_meta($object->ID, "meta-page-headerwidgetdisplay", true);
$pagesidebardisplay = get_post_meta($object->ID, "meta-page-pagesidebardisplay", true);
$specialwidgetsdisplay = get_post_meta($object->ID, "meta-page-specialwidgetsdisplay", true);
$beforewidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-beforewidgetsdisplay", true);
$afterwidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-afterwidgetsdisplay", true);
$secondsidebardisplay = get_post_meta($object->ID, "meta-page-secondsidebardisplay", true);
?>
<p><label for="meta-page-headerimage"><?php echo __('Header/Featured image', 'onepiece'); ?></label>
<select name="meta-page-headerimage" id="meta-page-headerimage">
<option value="default" <?php selected( $useheaderimage, 'default' ); ?>><?php echo __('Top content (default)', 'onepiece'); ?></option>
<option value="replace" <?php selected( $useheaderimage, 'replace' ); ?>><?php echo __('Replace header', 'onepiece'); ?></option>
<option value="hide" <?php selected( $useheaderimage, 'hide' ); ?>><?php echo __('top content, hide header', 'onepiece'); ?></option>
</select>
</p>


<p><label for="meta-page-headerwidgetdisplay"><?php echo __('Header widget display', 'onepiece'); ?></label>
<select name="meta-page-headerwidgetdisplay" id="meta-page-headerwidgetdisplay">
<option value="show" <?php selected( $headerwidgetdisplay, 'show' ); ?>><?php echo __('Show', 'onepiece'); ?></option>
<option value="hide" <?php selected( $headerwidgetdisplay, 'hide' ); ?>><?php echo __('Hide', 'onepiece'); ?></option></select>
</p>

<p><label for="meta-page-pagesidebardisplay"><?php echo __('Sidebar display', 'onepiece'); ?></label>
<select name="meta-page-pagesidebardisplay" id="meta-page-pagesidebardisplay">
<option value="none" <?php selected( $pagesidebardisplay, 'none' ); ?>><?php echo __('No main or page sidebar', 'onepiece'); ?></option>
<option value="hide" <?php selected( $pagesidebardisplay, 'hide' ); ?>><?php echo __('No pagesidebar', 'onepiece'); ?></option>
<option value="replace" <?php selected( $pagesidebardisplay, 'replace' ); ?>><?php echo __('Replace sidebar with pagesidebar', 'onepiece'); ?></option>
<option value="top" <?php selected( $pagesidebardisplay, 'top' ); ?>><?php echo __('Pagesidebar on top of main sidebar', 'onepiece'); ?></option>
<option value="below" <?php selected( $pagesidebardisplay, 'below' ); ?>><?php echo __('Pagesidebar below main sidebar', 'onepiece'); ?></option>
</select>
</p>
<p><label for="meta-page-secondsidebardisplay"><?php echo __('Second Sidebar', 'onepiece'); ?></label>
<select name="meta-page-secondsidebardisplay" id="meta-page-secondsidebardisplay">
<option value="show" <?php selected( $secondsidebardisplay, 'show' ); ?>><?php echo __('Show', 'onepiece'); ?></option>
<option value="hide" <?php selected( $secondsidebardisplay, 'hide' ); ?>><?php echo __('Hide', 'onepiece'); ?></option></select>
</p>
<p><label for="meta-page-specialwidgetsdisplay"><?php echo __('Special Page Widgets', 'onepiece'); ?></label>
<select name="meta-page-specialwidgetsdisplay" id="meta-page-specialwidgetsdisplay">
<option value="hide" <?php selected( $specialwidgetsdisplay, 'hide' ); ?>><?php echo __('Do not display', 'onepiece'); ?></option>
<option value="top" <?php selected( $specialwidgetsdisplay, 'top' ); ?>><?php echo __('On top of beforecontent area', 'onepiece'); ?></option>
<option value="replace" <?php selected( $specialwidgetsdisplay, 'replace' ); ?>><?php echo __('Replacing the beforecontent area', 'onepiece'); ?></option>
<option value="below" <?php selected( $specialwidgetsdisplay, 'below' ); ?>><?php echo __('Below the beforecontent area', 'onepiece'); ?></option>
</select>
</p>
<p><label for="meta-page-beforewidgetsdisplay"><?php echo __('Before-content Widgets', 'onepiece'); ?></label>
<select name="meta-page-beforewidgetsdisplay" id="meta-page-beforewidgetsdisplay">
<option value="hide" <?php selected( $beforewidgetsdisplay, 'hide' ); ?>><?php echo __('Do not display', 'onepiece'); ?></option>
<option value="show" <?php selected( $beforewidgetsdisplay, 'show' ); ?>><?php echo __('Display before content', 'onepiece'); ?></option>
</select>
</p>
<p><label for="meta-page-afterwidgetsdisplay"><?php echo __('After-content Widgets', 'onepiece'); ?></label>
<select name="meta-page-afterwidgetsdisplay" id="meta-page-afterwidgetsdisplay">
<option value="hide" <?php selected( $afterwidgetsdisplay, 'hide' ); ?>><?php echo __('Do not display', 'onepiece'); ?></option>
<option value="show" <?php selected( $afterwidgetsdisplay, 'show' ); ?>><?php echo __('Display after content', 'onepiece'); ?></option>
</select>
</p>
<?php
}


/* not on theme pages */
//global $post;
//if(!empty($post)){
//$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
//if( $pageTemplate != 'gallery.php'){
add_action("add_meta_boxes", "add_childpage_section_box");
//}
//}

function add_childpage_section_box()
{
    add_meta_box(
        "childpage-section-box", 
        "Childpage settings", 
        "childpage_section_fields", 
        "page", 
        "normal", 
        "high", 
        null);
}

function childpage_section_fields($object)
{
wp_nonce_field(basename(__FILE__), "meta-box-nonce");
$dsp = get_post_meta($object->ID, "meta-box-display-childpages", true);
$parent = get_post_meta($object->ID, "meta-box-display-parentcontent", true);
$childalign = get_post_meta($object->ID, "meta-box-display-alignment", true);
$coverimage = get_post_meta($object->ID, "meta-box-display-coverimage", true);
?>
<p><label for="meta-box-display-childpages"><?php echo __('Display Childpages', 'onepiece'); ?></label>
<select name="meta-box-display-childpages" id="meta-box-display-childpages">
<option value="none" <?php selected( $dsp, 'basic' ); ?>><?php echo __('Do not display', 'onepiece'); ?></option>
<option value="bloc" <?php selected( $dsp, 'bloc' ); ?>><?php echo __('Intro text  pagelink', 'onepiece'); ?></option>
<option value="pop" <?php selected( $dsp, 'pop' ); ?>><?php echo __('Intro text popuplink content', 'onepiece'); ?></option>
<option value="menu" <?php selected( $dsp, 'menu' ); ?>><?php echo __('Subpage menu', 'onepiece'); ?></option>
<option value="fade" <?php selected( $dsp, 'fade' ); ?>><?php echo __('Header, Tabs & text', 'onepiece'); ?></option>
<option value="slddwn" <?php selected( $dsp, 'slddwn' ); ?>><?php echo __('Vertical slide blocks', 'onepiece'); ?></option>
</select>
</p>

<p><label for="meta-box-display-parentcontent"><?php echo __('Parent content display', 'onepiece'); ?></label>
<select name="meta-box-display-parentcontent" id="meta-box-display-parentcontent">
<option value="none" <?php selected( $parent, 'none' ); ?>><?php echo __('Do not display', 'onepiece'); ?></option>
<option value="intr" <?php selected( $parent, 'intr' ); ?>><?php echo __('Display on top of childpages', 'onepiece'); ?></option> 
</select>
</p>


<p><label for="meta-box-display-alignment"><?php echo __('Alignment', 'onepiece'); ?></label>
<select name="meta-box-display-alignment" id="meta-box-display-alignment">
<option value="left" <?php selected( $childalign, 'left' ); ?>><?php echo __('Left', 'onepiece'); ?></option>
<option value="center" <?php selected( $childalign, 'center' ); ?>><?php echo __('Center', 'onepiece'); ?></option>
<option value="right" <?php selected( $childalign, 'right' ); ?>><?php echo __('Right', 'onepiece'); ?></option>
</select>
</p>
<p><label for="meta-box-display-coverimage"><?php echo __('Image display', 'onepiece'); ?></label>
<select name="meta-box-display-coverimage" id="meta-box-display-coverimage">
<option value="none" <?php selected( $coverimage, 'none' ); ?>><?php echo __('None', 'onepiece'); ?></option>
<option value="above" <?php selected( $coverimage, 'above' ); ?>><?php echo __('Above title', 'onepiece'); ?></option>
<option value="below" <?php selected( $coverimage, 'below' ); ?>><?php echo __('Below title', 'onepiece'); ?></option>
<option value="thumb" <?php selected( $coverimage, 'thumb' ); ?>><?php echo __('Thumb/icon above title ', 'onepiece'); ?></option>
<option value="inlineL" <?php selected( $coverimage, 'inlineL' ); ?>><?php echo __('Inline left (text aligned)', 'onepiece'); ?></option>
<option value="inlineR" <?php selected( $coverimage, 'inlineR' ); ?>><?php echo __('Inline right (text aligned)', 'onepiece'); ?></option>
</select>
</p>

<?php
}


/* SLIDER template category selection */
add_action('add_meta_boxes', 'add_slider_meta');
function add_slider_meta()
{
    global $post;
    if(!empty($post))
    {
        //$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
        //if($pageTemplate == 'slider.php')
	//if( is_page() ){
           add_meta_box(
                 'pagetheme_meta', // $id
                 'Slider settings', // $title
                 'display_slider_optionbox', // $callback
                 'page', // $page
                 'side', // $context
                 'high'); // $priority
        //}
    }
}

function display_slider_optionbox( $post )
{
$values = get_post_custom( $post->ID );
$selected = isset( $values['pagetheme_slide_selectbox'] ) ? esc_attr( $values['pagetheme_slide_selectbox'][0] ) : '';
$catarr = get_categories_select(); // customizer function
?>

<p>
<?php
$pagesliderdisplay = isset( $values['pagetheme_slide_displaytype'] ) ? esc_attr( $values['pagetheme_slide_displaytype'][0] ) : 'none';
?>
<label for="pagetheme_slide_displaytype">Slider display</label>
<select name="pagetheme_slide_displaytype" id="pagetheme_slide_displaytype">
<option value="replaceheader" <?php selected( $pagesliderdisplay, 'replaceheader' ); ?>>Replace header</option>
<option value="belowheader" <?php selected( $pagesliderdisplay, 'belowheader' ); ?>>Below header</option>
<?php /*
<option value="topcontent" <?php selected( $pagesliderdisplay, 'topcontent' ); ?>>Top content</option>
<option value="bottomcontent" <?php selected( $pagesliderdisplay, 'bottomcontent' ); ?>>Bottom content</option>
*/ ?>
<option value="topfooter" <?php selected( $pagesliderdisplay, 'topfooter' ); ?>>Top footer</option>
<option value="default" <?php selected( $pagesliderdisplay, 'default' ); ?>>Default slider only</option>
<option value="none" <?php selected( $pagesliderdisplay, 'none' ); ?>>Hide sliders</option>
</select>
</p>

<p>
<label for="pagetheme_slide_selectbox">Category</label>
<select name="pagetheme_slide_selectbox" id="pagetheme_slide_selectbox">
<?php foreach($catarr as $slg => $nm){ 
echo '<option value="'.$slg.'" '.selected( $selected, $slg ).'>'.$nm.'</option>';
} ?>
<option value="uncategorized" <?php selected( $selected, 'uncategorized' ); ?>>Uncategorized</option>
</select>
</p>
<p>
<?php
$slidedisplayheight = isset( $values['pagetheme_slide_displayheight'] ) ? esc_attr( $values['pagetheme_slide_displayheight'][0] ) : '';
?>
<label for="pagetheme_slide_displayheight">Height</label>
<select name="pagetheme_slide_displayheight" id="pagetheme_slide_displayheight">
<option value="variable" <?php selected( $slidedisplayheight, 'variable' ); ?>>Variable (image) height</option>
<option value="25" <?php selected( $slidedisplayheight, '25' ); ?>>25% (window) height</option>
<option value="33" <?php selected( $slidedisplayheight, '33' ); ?>>33% (window) height</option>
<option value="40" <?php selected( $slidedisplayheight, '40' ); ?>>40% (window) height</option>
<option value="45" <?php selected( $slidedisplayheight, '45' ); ?>>45% (window) height</option>
<option value="50" <?php selected( $slidedisplayheight, '50' ); ?>>50% (window) height</option>
<option value="66" <?php selected( $slidedisplayheight, '66' ); ?>>66% (window) height</option>
<option value="75" <?php selected( $slidedisplayheight, '75' ); ?>>75% (window) height</option>
<option value="80" <?php selected( $slidedisplayheight, '80' ); ?>>80% (window) height</option>
<option value="85" <?php selected( $slidedisplayheight, '85' ); ?>>85% (window) height</option>
<option value="100" <?php selected( $slidedisplayheight, '100' ); ?>>Full (window) height</option>
</select>
</p>
<p>
<?php
$slidedisplaywidth = isset( $values['pagetheme_slide_displaywidth'] ) ? esc_attr( $values['pagetheme_slide_displaywidth'][0] ) : '';
?>
<label for="pagetheme_slide_displaywidth">Width</label>
<select name="pagetheme_slide_displaywidth" id="pagetheme_slide_displaywidth">
<option value="margin" <?php selected( $slidedisplaywidth, 'margin' ); ?>>Max (content) width</option>
<option value="full" <?php selected( $slidedisplaywidth, 'full' ); ?>>Full (window) width</option>
</select>
</p>
<?php } 

function save_page_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if( isset( $_POST['meta-page-headerimage'] ) )
        update_post_meta( $post_id, 'meta-page-headerimage', esc_attr(     $_POST['meta-page-headerimage'] ) );

    if( isset( $_POST['meta-page-headerwidgetdisplay'] ) )
        update_post_meta( $post_id, 'meta-page-headerwidgetdisplay', esc_attr( $_POST['meta-page-headerwidgetdisplay'] ) );


    if( isset( $_POST['meta-page-specialwidgetsdisplay'] ) )
        update_post_meta( $post_id, 'meta-page-specialwidgetsdisplay', esc_attr(     $_POST['meta-page-specialwidgetsdisplay'] ) );
    if( isset( $_POST['meta-page-beforewidgetsdisplay'] ) )
        update_post_meta( $post_id, 'meta-page-beforewidgetsdisplay', esc_attr(     $_POST['meta-page-beforewidgetsdisplay'] ) );
    if( isset( $_POST['meta-page-afterwidgetsdisplay'] ) )
        update_post_meta( $post_id, 'meta-page-afterwidgetsdisplay', esc_attr(     $_POST['meta-page-afterwidgetsdisplay'] ) );
    if( isset( $_POST['meta-page-pagesidebardisplay'] ) )
        update_post_meta( $post_id, 'meta-page-pagesidebardisplay', esc_attr(     $_POST['meta-page-pagesidebardisplay'] ) );
    if( isset( $_POST['meta-page-secondsidebardisplay'] ) )
        update_post_meta( $post_id, 'meta-page-secondsidebardisplay', esc_attr(     $_POST['meta-page-secondsidebardisplay'] ) );

    // page slider options
    if( isset( $_POST['pagetheme_slide_displaytype'] ) )
        update_post_meta( $post_id, 'pagetheme_slide_displaytype', $_POST['pagetheme_slide_displaytype'] );
    if( isset( $_POST['pagetheme_slide_selectbox'] ) )
        update_post_meta( $post_id, 'pagetheme_slide_selectbox', $_POST['pagetheme_slide_selectbox'] );
    if( isset( $_POST['pagetheme_slide_displayheight'] ) )
        update_post_meta( $post_id, 'pagetheme_slide_displayheight', $_POST['pagetheme_slide_displayheight'] );
    if( isset( $_POST['pagetheme_slide_displaywidth'] ) )
        update_post_meta( $post_id, 'pagetheme_slide_displaywidth', $_POST['pagetheme_slide_displaywidth'] );

    // childpage sections
    if( isset( $_POST['meta-box-display-childpages'] ) )
        update_post_meta( $post_id, 'meta-box-display-childpages', $_POST['meta-box-display-childpages'] );
    if( isset( $_POST['meta-box-display-parentcontent'] ) )
        update_post_meta( $post_id, 'meta-box-display-parentcontent', $_POST['meta-box-display-parentcontent'] );
    if( isset( $_POST['meta-box-display-alignment'] ) )
        update_post_meta( $post_id, 'meta-box-display-alignment', $_POST['meta-box-display-alignment'] );
    if( isset( $_POST['meta-box-display-coverimage'] ) )
        update_post_meta( $post_id, 'meta-box-display-coverimage', $_POST['meta-box-display-coverimage'] );
}
add_action("save_post", "save_page_meta_box", 10, 3);
?>
