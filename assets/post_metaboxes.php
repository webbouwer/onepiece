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
        "normal", 
        "high",  
        null);
}
add_action("add_meta_boxes", "add_productmaker_box");

function post_productmaker_fields($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    $labels = get_post_meta($object->ID, "meta-box-product-label", false);
	
    $price = get_post_meta($object->ID, "meta-box-product-price", true);
	
    $currency = get_post_meta($object->ID, "meta-box-product-currency", true);
	
    $discount = get_post_meta($object->ID, "meta-box-product-discount", true);
    $size = get_post_meta($object->ID, "meta-box-product-size", true);
    $dmx = get_post_meta($object->ID, "meta-box-product-dmx", true);
    $dmy = get_post_meta($object->ID, "meta-box-product-dmy", true);
    $dmz = get_post_meta($object->ID, "meta-box-product-dmz", true);
    $dms = get_post_meta($object->ID, "meta-box-product-dms", true);
    
    $wms = get_post_meta($object->ID, "meta-box-product-wms", true);
    $wmn = get_post_meta($object->ID, "meta-box-product-wmn", true);
	
	$orderbymail = 'post'; // default custom
    if( !empty( get_post_meta($object->ID, "meta-box-product-orderbymail", true) ) && get_post_meta($object->ID, "meta-box-product-orderbymail", true) != 'null'){
		$orderbymail = get_post_meta($object->ID, "meta-box-product-orderbymail", true);
    }
	?>
        
    <label for="meta-box-product-label"><b><?php echo __('Labeled as', 'onepiece'); ?></b></label>
    <p><select multiple="multiple" name="meta-box-product-label" id="meta-box-product-label" >
        <option value="none" <?php if(in_array( 'none', $labels)){ echo 'selected="selected"'; } ?>><?php echo __('No label', 'onepiece'); ?></option>
        <option value="new" <?php if(in_array( 'new', $labels)){ echo 'selected="selected"'; } ?>><?php echo __('New', 'onepiece'); ?></option>
        <option value="special" <?php if( in_array( 'special', $labels) ){ echo 'selected="selected"'; } ?>><?php echo __('Special', 'onepiece'); ?></option>
        <option value="featured" <?php if(in_array('featured', $labels)){ echo 'selected="selected"'; } ?>><?php echo __('Featured', 'onepiece'); ?></option>
        <option value="comingsoon" <?php if(in_array( 'comingsoon', $labels)){ echo 'selected="selected"'; } ?>><?php echo __('Coming soon', 'onepiece'); ?></option>
        <option value="alltimefavourite" <?php if(in_array( 'alltimefavourite', $labels)){ echo 'selected="selected"'; } ?>><?php echo __('All time favourite', 'onepiece'); ?></option>
    </select></p>
    
    
    
    <p><label for="meta-box-product-price"><b><?php echo __('Price: ', 'onepiece'); ?></b></label>
    <input name="meta-box-product-price" size="8" type="text" value="<?php echo $price; ?>"></p>
    <p>
     <!-- <label for="meta-box-product-dms"><?php echo __('Currency', 'onepiece'); ?></label> 
     see https://gist.github.com/Gibbs/3920259
     -->
    <select name="meta-box-product-currency" id="meta-box-product-currency">
        <option value="EUR" <?php selected( $currency, 'EUR' ); ?>><?php echo __('EUR &#8364;', 'onepiece'); ?></option>
        <option value="CNY" <?php selected( $currency, 'CNY' ); ?>><?php echo __('CNY &#165;', 'onepiece'); ?></option>
        <option value="USD" <?php selected( $currency, 'USD' ); ?>><?php echo __('USD &#36;', 'onepiece'); ?></option>
        <option value="GBP" <?php selected( $currency, 'GBP' ); ?>><?php echo __('GBP &#163;', 'onepiece'); ?></option>
        <option value="JPY" <?php selected( $currency, 'JPY' ); ?>><?php echo __('JPY &#165;', 'onepiece'); ?></option>
        <option value="AUD" <?php selected( $currency, 'AUD' ); ?>><?php echo __('AUD &#36;', 'onepiece'); ?></option>
        <option value="CAD" <?php selected( $currency, 'CAD' ); ?>><?php echo __('CAD &#36;', 'onepiece'); ?></option>
        <option value="CHF" <?php selected( $currency, 'CHF' ); ?>><?php echo __('CHF &#67;&#72;&#70;', 'onepiece'); ?></option>
    </select>
    </p>
    
    <p><label for="meta-box-product-discount"><b><?php echo __('Discount(%)', 'onepiece'); ?></b></label>
    <input name="meta-box-product-discount" size="3" type="text" value="<?php echo $discount; ?>"></p>
    
    <p><label for="meta-box-product-size"><b><?php echo __('Size: ', 'onepiece'); ?></b></label>
    <select name="meta-box-product-size" id="meta-box-product-size">
        <option value="none" ><?php echo __('none', 'onepiece'); ?></option>
        <option value="xs" <?php selected( $size, 'xs' ); ?>><?php echo __('Extra Small', 'onepiece'); ?></option>
        <option value="s" <?php selected( $size, 's' ); ?>><?php echo __('Small', 'onepiece'); ?></option>
        <option value="m" <?php selected( $size, 'm' ); ?>><?php echo __('Medium', 'onepiece'); ?></option>
        <option value="l" <?php selected( $size, 'l' ); ?>><?php echo __('Large', 'onepiece'); ?></option>
        <option value="xl" <?php selected( $size, 'xl' ); ?>><?php echo __('Extra Large', 'onepiece'); ?></option>
    </select>
    </p>
    
    <p><b><?php echo __('Order buttons display: ', 'onepiece'); ?></b></p>
    <p><label for="meta-box-product-orderbymail"><?php echo __('by mail: ', 'onepiece'); ?></label>
   <select name="meta-box-product-orderbymail" id="meta-box-product-orderbymail">
        <option value="none" <?php selected( $orderbymail, 'none' ); ?>><?php echo __('No display', 'onepiece'); ?></option>
        <option value="post" <?php selected( $orderbymail, 'post' ); ?>><?php echo __('Post view only', 'onepiece'); ?></option>
        <option value="ever" <?php selected( $orderbymail, 'ever' ); ?>><?php echo __('Everywhere', 'onepiece'); ?></option>
    </select>
   
   </p>


    
    <p><b><?php echo __('Package Size', 'onepiece'); ?></b>
    <p>
    
    
    <input name="meta-box-product-dmx" size="5" type="text" placeholder="<?php echo __('size x', 'onepiece'); ?>" value="<?php echo $dmx; ?>">
    <input name="meta-box-product-dmy" size="5" type="text" placeholder="<?php echo __('size y', 'onepiece'); ?>" value="<?php echo $dmy; ?>">
    <input name="meta-box-product-dmz" size="5" type="text" placeholder="<?php echo __('size z', 'onepiece'); ?>" value="<?php echo $dmz; ?>">
    
    <!-- <label for="meta-box-product-dms"><?php echo __('Units', 'onepiece'); ?></label> -->
    <select name="meta-box-product-dms" id="meta-box-product-dms">
        <option value="none" <?php selected( $dms, 'none' ); ?>><?php echo __('none', 'onepiece'); ?></option>
        <option value="mm" <?php selected( $dms, 'mm' ); ?>><?php echo __('mm', 'onepiece'); ?></option>
        <option value="in" <?php selected( $dms, 'in' ); ?>><?php echo __('inch', 'onepiece'); ?></option>
        <option value="cm" <?php selected( $dms, 'cm' ); ?>><?php echo __('cm', 'onepiece'); ?></option>
        <option value="me" <?php selected( $dms, 'me' ); ?>><?php echo __('m', 'onepiece'); ?></option>
        <option value="km" <?php selected( $dms, 'km' ); ?>><?php echo __('km', 'onepiece'); ?></option>
        <option value="mi" <?php selected( $dms, 'mi' ); ?>><?php echo __('mile', 'onepiece'); ?></option>
    </select>
    </p>
    
    <b><?php echo __('Package Weight', 'onepiece'); ?></b>
    <p>
    
    <label for="meta-box-product-wmn"><?php echo __('Weight: ', 'onepiece'); ?></label>
    <input name="meta-box-product-wmn" size="5" type="text" value="<?php echo $wmn; ?>">
    
    <!-- <label for="meta-box-product-wms"><?php echo __('Units', 'onepiece'); ?></label> -->
    <select name="meta-box-product-wms" id="meta-box-product-wms">
        <option value="none" <?php selected( $wms, 'none' ); ?>><?php echo __('none', 'onepiece'); ?></option>
        <option value="mcg" <?php selected( $wms, 'mcg' ); ?>><?php echo __('mcg', 'onepiece'); ?></option>
        <option value="mg" <?php selected( $wms, 'mg' ); ?>><?php echo __('mg', 'onepiece'); ?></option>
        <option value="g" <?php selected( $wms, 'g' ); ?>><?php echo __('g', 'onepiece'); ?></option>
        <option value="kg" <?php selected( $wms, 'kg' ); ?>><?php echo __('kg', 'onepiece'); ?></option>
        <option value="ton" <?php selected( $wms, 'ton' ); ?>><?php echo __('ton', 'onepiece'); ?></option>
    </select>
    </p>
    
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
	
	if( isset( $_POST['meta-box-product-currency'] ) )
    update_post_meta( $post_id, 'meta-box-product-currency', $_POST['meta-box-product-currency'] );
	
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
    
    if( isset( $_POST['meta-box-product-wms'] ) )
    update_post_meta( $post_id, 'meta-box-product-wms', $_POST['meta-box-product-wms'] );
    if( isset( $_POST['meta-box-product-wmn'] ) )
    update_post_meta( $post_id, 'meta-box-product-wmn', $_POST['meta-box-product-wmn'] );
	
    if( isset( $_POST['meta-box-product-label'] ) )
    update_post_meta( $post_id, 'meta-box-product-label', $_POST['meta-box-product-label'] );


	if( isset( $_POST['meta-box-product-orderbymail'] ) )
    update_post_meta( $post_id, 'meta-box-product-orderbymail', $_POST['meta-box-product-orderbymail'] );
}
add_action("save_post", "save_custom_meta_box", 10, 3);

?>