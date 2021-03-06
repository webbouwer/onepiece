<?php /******** GALLERY PAGE OPTIONS ******/
function add_theme_gallery_meta()
{
    global $post;
    if(!empty($post))
    {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
        if($pageTemplate == 'gallery.php')
        {
           add_meta_box(
                 'gallerytheme_meta', // $id
                 'Gallery settings', // $title
                 'display_theme_gallery_settings', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority
        }
    }
}
add_action('add_meta_boxes', 'add_theme_gallery_meta');

function display_theme_gallery_settings( $post )
{
$values = get_post_custom( $post->ID );
$selected = isset( $values['theme_gallery_category_selectbox'] ) ? esc_attr( $values['theme_gallery_category_selectbox'][0] ) : '';
$catarr = get_categories_select(); // customizer function
$pagetitle = isset( $values['theme_gallery_pagetitle_selectbox'] ) ? esc_attr( $values['theme_gallery_pagetitle_selectbox'][0] ) : '';
$filters = isset( $values['theme_gallery_filters_selectbox'] ) ? esc_attr( $values['theme_gallery_filters_selectbox'][0] ) : '';
$sidebars = isset( $values['theme_gallery_sidebars_selectbox'] ) ? esc_attr( $values['theme_gallery_sidebars_selectbox'][0] ) : '';
$maxitems = isset( $values['theme_gallery_items_maxinrow'] ) ? esc_attr( $values['theme_gallery_items_maxinrow'][0] ) : 4;
$itemminh = isset( $values['theme_gallery_items_minheight'] ) ? esc_attr( $values['theme_gallery_items_minheight'][0] ) : 160;
$clickaction = isset( $values['theme_gallery_items_clickaction'] ) ? esc_attr( $values['theme_gallery_items_clickaction'][0] ) : 'none';
$itemview = isset( $values['theme_gallery_items_itemview'] ) ? esc_attr( $values['theme_gallery_items_itemview'][0] ) : 'right';
?>
<p><label for="theme_gallery_category_selectbox">Select a category</label>
<select name="theme_gallery_category_selectbox" id="theme_gallery_category_selectbox">
<?php foreach($catarr as $slg => $nm){ 
echo '<option value="'.$slg.'" '.selected( $selected, $slg ).'>'.$nm.'</option>';
} 
?>
<option value="uncategorized" <?php selected( $selected, 'uncategorized' ); ?>><?php echo __('Uncategorized', 'onepiece'); ?></option>
</select>
</p>
<p><label for="theme_gallery_items_maxinrow"><?php echo __('Set the max amount of items in a row', 'onepiece'); ?></label>
<input size="3" name="theme_gallery_items_maxinrow" id="theme_gallery_items_maxinrow" value="<?php echo $maxitems; ?>">
</p>
<p><label for="theme_gallery_pagetitle_selectbox"><?php echo __('Display titlebar', 'onepiece'); ?></label>
<select name="theme_gallery_pagetitle_selectbox" id="theme_gallery_pagetitle_selectbox">
<option value="none" <?php selected( $pagetitle, 'none' ); ?>><?php echo __('No titlebar', 'onepiece'); ?></option>
<option value="title" <?php selected( $pagetitle, 'title' ); ?>><?php echo __('Title only', 'onepiece'); ?></option>
<option value="text" <?php selected( $pagetitle, 'text' ); ?>><?php echo __('Title and text', 'onepiece'); ?></option>
</select>
</p>
<p><label for="theme_gallery_filters_selectbox"><?php echo __('Display Filter Navigation', 'onepiece'); ?></label>
<select name="theme_gallery_filters_selectbox" id="theme_gallery_filters_selectbox">
<option value="none" <?php selected( $filters, 'none' ); ?>><?php echo __('No menu', 'onepiece'); ?></option>
<option value="cats" <?php selected( $filters, 'cats' ); ?>><?php echo __('Sub Category Menu', 'onepiece'); ?></option>
<option value="all" <?php selected( $filters, 'all' ); ?>><?php echo __('Sub Categories & Tags', 'onepiece'); ?></option>
</select>
</p>

<p><label for="theme_gallery_items_minheight"><?php echo __('Item minimal height in overview (px)', 'onepiece'); ?></label>
<input name="theme_gallery_items_minheight" id="theme_gallery_items_minheight" type="text" placeholder="160" value="<?php echo $itemminh; ?>" />
</p>

<p><label for="theme_gallery_items_clickaction"><?php echo __('Action on item click/touch', 'onepiece'); ?></label>
<select name="theme_gallery_items_clickaction" id="theme_gallery_items_clickaction">
<option value="none" <?php selected( $clickaction, 'none' ); ?>><?php echo __('No action', 'onepiece'); ?></option>
<option value="link" <?php selected( $clickaction, 'link' ); ?>><?php echo __('Link to post (or custom link)', 'onepiece'); ?></option>
<option value="sizeup" <?php selected( $clickaction, 'sizeup' ); ?>><?php echo __('Size up first (and link to post/custom)', 'onepiece'); ?></option>
<option value="poppost" <?php selected( $clickaction, 'poppost' ); ?>><?php echo __('Popup overlay custom default', 'onepiece'); ?></option>
<option value="popcat" <?php selected( $clickaction, 'popcat' ); ?>><?php echo __('Popup overlay gallery', 'onepiece'); ?></option>
</select>
</p>

<p><label for="theme_gallery_items_itemview"><?php echo __('Single item view', 'onepiece'); ?></label>
<select name="theme_gallery_items_itemview" id="theme_gallery_items_itemview">
<option value="right" <?php selected( $itemview, 'right' ); ?>><?php echo __('image left, text/info right', 'onepiece'); ?></option>
<option value="below" <?php selected( $itemview, 'below' ); ?>><?php echo __('text/info below image', 'onepiece'); ?></option>
<option value="left" <?php selected( $itemview, 'left' ); ?>><?php echo __('text/info left, image right', 'onepiece'); ?></option>
<?php /* <option value="popcat" <?php selected( $clickaction, 'popcat' ); ?>><?php echo __('Popup category overlay', 'onepiece'); ?></option> */ ?>
</select>
</p>
<?php 
}
function save_theme_gallery_settings( $post_id )
{
    if( isset( $_POST['theme_gallery_category_selectbox'] ) )
        update_post_meta( $post_id, 'theme_gallery_category_selectbox', esc_attr( $_POST['theme_gallery_category_selectbox'] ) );
        
    if( isset( $_POST['theme_gallery_pagetitle_selectbox'] ) )
        update_post_meta( $post_id, 'theme_gallery_pagetitle_selectbox', esc_attr( $_POST['theme_gallery_pagetitle_selectbox'] ) );
    
    if( isset( $_POST['theme_gallery_filters_selectbox'] ) )
        update_post_meta( $post_id, 'theme_gallery_filters_selectbox', esc_attr( $_POST['theme_gallery_filters_selectbox'] ) );
    if( isset( $_POST['theme_gallery_items_maxinrow'] ) )
        update_post_meta( $post_id, 'theme_gallery_items_maxinrow', esc_attr( $_POST['theme_gallery_items_maxinrow'] ) );
    if( isset( $_POST['theme_gallery_items_minheight'] ) )
        update_post_meta( $post_id, 'theme_gallery_items_minheight', esc_attr( $_POST['theme_gallery_items_minheight'] ) );

	if( isset( $_POST['theme_gallery_items_clickaction'] ) )
        update_post_meta( $post_id, 'theme_gallery_items_clickaction', esc_attr( $_POST['theme_gallery_items_clickaction'] ) );
	if( isset( $_POST['theme_gallery_items_itemview'] ) )
        update_post_meta( $post_id, 'theme_gallery_items_itemview', esc_attr( $_POST['theme_gallery_items_itemview'] ) );

}
add_action( 'save_post', 'save_theme_gallery_settings' );
?>
