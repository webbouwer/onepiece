<?php /* POST META BOXES*/

/* POST CUSTOM LINK META FIELDS */
function add_custom_link_box()
{
    add_meta_box(
        "post-custom-link-box", 
        "Custom Link", 
        "post_meta_link_fields", 
        "post", 
        "side", 
        "high", 
        null);
}
add_action("add_meta_boxes", "add_custom_link_box");


function post_meta_link_fields($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

$useurl = get_post_meta($object->ID, "meta-box-custom-useurl", true);

?>

<p><label for="meta-box-custom-url"><?php echo __('Custom Link', 'onepiece'); ?></label>
    <input name="meta-box-custom-url" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-custom-url", true); ?>"></p>

<p><label for="meta-box-custom-urltext"><?php echo __('Link text', 'onepiece'); ?></label>
    <input name="meta-box-custom-urltext" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-custom-urltext", true); ?>"></p>

<p><label for="meta-box-custom-useurl"><?php echo __('Link function', 'onepiece'); ?></label>
<select name="meta-box-custom-useurl" id="meta-box-custom-useurl">
<option value="replaceself" <?php selected( $useurl, 'replaceself' ); ?>><?php echo __('Replace title link (current window)', 'onepiece'); ?></option>
<option value="replaceblank" <?php selected( $useurl, 'replaceblank' ); ?>><?php echo __('Replace title link (new window)', 'onepiece'); ?></option>
<option value="internal" <?php selected( $useurl, 'internal' ); ?>><?php echo __('Separate link/button (current window)', 'onepiece'); ?></option>
<option value="external" <?php selected( $useurl, 'external' ); ?>><?php echo __('Separate link/button (new window)', 'onepiece'); ?></option>
</select>
</p>
<?php
}





/* POST PRODUCTMAKER META FIELDS */
function add_productmaker_box()
{
    add_meta_box(
        "post-productmaker-box", 
        "Product properties", 
        "post_productmaker_fields", 
        "post", 
        "side", 
        "high", 
        null);
}
add_action("add_meta_boxes", "add_productmaker_box");

function post_productmaker_fields($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    $price = get_post_meta($object->ID, "meta-box-product-price", true);
    $discount = get_post_meta($object->ID, "meta-box-product-discount", true);
    $size = get_post_meta($object->ID, "meta-box-product-size", true);
    $dmx = get_post_meta($object->ID, "meta-box-product-dmx", true);
    $dmy = get_post_meta($object->ID, "meta-box-product-dmy", true);
    $dmz = get_post_meta($object->ID, "meta-box-product-dmz", true);
    $dms = get_post_meta($object->ID, "meta-box-product-dms", true);
    
    $labels = get_post_meta($object->ID, "meta-box-product-label", false);
    
    ?>
    <p><label for="meta-box-product-price"><?php echo __('Product Price', 'onepiece'); ?></label>
    <input name="meta-box-product-price" size="8" type="text" value="<?php echo $price; ?>"></p>
    <p><label for="meta-box-product-discount"><?php echo __('Price Discount(%)', 'onepiece'); ?></label>
    <input name="meta-box-product-discount" size="3" type="text" value="<?php echo $discount; ?>"></p>
    
    <p><label for="meta-box-product-size"><?php echo __('Product Size', 'onepiece'); ?></label>
    <select name="meta-box-product-size" id="meta-box-product-size">
        <option value="none" ><?php echo __('None', 'onepiece'); ?></option>
        <option value="xs" <?php selected( $size, 'xs' ); ?>><?php echo __('Extra Small', 'onepiece'); ?></option>
        <option value="s" <?php selected( $size, 's' ); ?>><?php echo __('Small', 'onepiece'); ?></option>
        <option value="m" <?php selected( $size, 'm' ); ?>><?php echo __('Medium', 'onepiece'); ?></option>
        <option value="l" <?php selected( $size, 'l' ); ?>><?php echo __('Large', 'onepiece'); ?></option>
        <option value="xl" <?php selected( $size, 'xl' ); ?>><?php echo __('Extra Large', 'onepiece'); ?></option>
    </select></p>
    
    <fieldset>
    <legend><?php echo __('Dimensions', 'onepiece'); ?></legend>
    <label for="meta-box-product-dmx"><?php echo __('x', 'onepiece'); ?></label>
    <input name="meta-box-product-dmx" size="5" type="text" value="<?php echo $dmx; ?>">
    <label for="meta-box-product-dmy"><?php echo __('y', 'onepiece'); ?></label>
    <input name="meta-box-product-dmy" size="5" type="text" value="<?php echo $dmy; ?>">
    <label for="meta-box-product-dmz"><?php echo __('z', 'onepiece'); ?></label>
    <input name="meta-box-product-dmz" size="5" type="text" value="<?php echo $dmz; ?>">
    <label for="meta-box-product-dms"><?php echo __('Measurement in', 'onepiece'); ?></label>
    <select name="meta-box-product-dms" id="meta-box-product-dms">
        <option value="mm" <?php selected( $dms, 'mm' ); ?>><?php echo __('mm', 'onepiece'); ?></option>
        <option value="cm" <?php selected( $dms, 'cm' ); ?>><?php echo __('cm', 'onepiece'); ?></option>
        <option value="me" <?php selected( $dms, 'me' ); ?>><?php echo __('meters', 'onepiece'); ?></option>
        <option value="km" <?php selected( $dms, 'km' ); ?>><?php echo __('km', 'onepiece'); ?></option>
        <option value="mi" <?php selected( $dms, 'mi' ); ?>><?php echo __('miles', 'onepiece'); ?></option>
    </select>
    </fieldset>
    
        
    <p><label for="meta-box-product-label"><?php echo __('Labeled as', 'onepiece'); ?></label>
    <select multiple="multiple" name="meta-box-product-label" id="meta-box-product-label" >
        <option value="none" <?php if(in_array( 'none', $labels)){ echo 'selected="selected"'; } ?>><?php echo __('No label', 'onepiece'); ?></option>
        <option value="new" <?php if(in_array( 'new', $labels)){ echo 'selected="selected"'; } ?>><?php echo __('New', 'onepiece'); ?></option>
        <option value="special" <?php if( in_array( 'special', $labels) ){ echo 'selected="selected"'; } ?>><?php echo __('Special', 'onepiece'); ?></option>
        <option value="featured" <?php if(in_array('featured', $labels)){ echo 'selected="selected"'; } ?>><?php echo __('Featured', 'onepiece'); ?></option>
        <option value="comingsoon" <?php if(in_array( 'comingsoon', $labels)){ echo 'selected="selected"'; } ?>><?php echo __('Coming soon', 'onepiece'); ?></option>
        <option value="alltimefavourite" <?php if(in_array( 'alltimefavourite', $labels)){ echo 'selected="selected"'; } ?>><?php echo __('All time favourite', 'onepiece'); ?></option>
    </select></p>
    <?php
}






/* SAVE POST METADATA */
function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "post";
    if($slug != $post->post_type)
        return $post_id;

    /* LINK META */
    $url = esc_url_raw( $_POST["meta-box-custom-url"] );
    $urltext = $_POST["meta-box-custom-urltext"];
    if ( empty( $urltext ) ) {
       delete_post_meta( $post_id, 'meta-box-custom-urltext' );
    } else {
      update_post_meta( $post_id, 'meta-box-custom-urltext', $urltext );
    }
    if ( empty( $url ) ) {
       delete_post_meta( $post_id, 'meta-box-custom-url' );
    } else {
      update_post_meta( $post_id, 'meta-box-custom-url', $url );
    }
    if( isset( $_POST['meta-box-custom-useurl'] ) )
        update_post_meta( $post_id, 'meta-box-custom-useurl', esc_attr( $_POST['meta-box-custom-useurl'] ) );

    /* PRODUCT MAKER */
    $price = $_POST["meta-box-product-price"];
    $discount = $_POST["meta-box-product-discount"];
    update_post_meta( $post_id, 'meta-box-product-price', $price );
    update_post_meta( $post_id, 'meta-box-product-discount', $discount );
    if( isset( $_POST['meta-box-product-size'] ) )
    update_post_meta( $post_id, 'meta-box-product-size', $_POST['meta-box-product-size'] );
    if( isset( $_POST['meta-box-product-dmx'] ) )
    update_post_meta( $post_id, 'meta-box-product-dmx', $_POST['meta-box-product-dmx'] );
    if( isset( $_POST['meta-box-product-dmy'] ) )
    update_post_meta( $post_id, 'meta-box-product-dmy', $_POST['meta-box-product-dmy'] );
    if( isset( $_POST['meta-box-product-dmz'] ) )
    update_post_meta( $post_id, 'meta-box-product-dmz', $_POST['meta-box-product-dmz'] );
    if( isset( $_POST['meta-box-product-dms'] ) )
    update_post_meta( $post_id, 'meta-box-product-dms', $_POST['meta-box-product-dms'] );
    
    if( isset( $_POST['meta-box-product-label'] ) )
    update_post_meta( $post_id, 'meta-box-product-label', $_POST['meta-box-product-label'] );



}
add_action("save_post", "save_custom_meta_box", 10, 3);

?>