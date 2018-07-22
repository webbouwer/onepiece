<?php
/* Onepiece widgets */


/* Custom Dashboard Widget */

add_action( 'wp_dashboard_setup', 'onepiece_dashboard_widget' );

function onepiece_dashboard_widget() {
    add_meta_box( 'onepiece_dashboard_widgetbox', 'Onepiece @ Github', 'onepiece_dashboard_widget_content', 'dashboard', 'side', 'high' );
}

function onepiece_dashboard_widget_content() {
    // widget content goes here
	
	//https://api.github.com/users/oddsized
	//$gitdata = wp_remote_get('https://api.github.com/users/oddsized');
	//$gitprofile_data = wp_remote_retrieve_body( $gitdata );
	//$gitprofile = json_decode( $gitprofile_data );
	//echo '<a href="'.$gitprofile->html_url.'" target="_blank"><img src="'.$gitprofile->avatar_url.'" style="display:inline-block;vertical-align:text-top;" border="0" width="24" height="auto" />'.$gitprofile->login.' @ github</a>';

	//https://api.github.com/repos/Oddsized/onepiece/events
	$gitdata = wp_remote_get('https://api.github.com/repos/Oddsized/onepiece/events');
	$gitevent_data = wp_remote_retrieve_body( $gitdata );
	$events = json_decode( $gitevent_data );
	
	if(count($events) > 0){
	echo '<ul>';
	foreach(array_slice($events, 0, 5) as $event){
		if($event->payload->commits[0]->message != ''){
		echo '<li><b>'.$event->payload->commits[0]->message.'</b><br />';
		echo '<small>'.$event->type.' '.$event->created_at.' by <a href="https://github.com/'.$event->actor->login.'" target="_blank">'.$event->payload->commits[0]->author->name.'</a></small></li>';
		}	
	}
	echo '</ul>';
	}
}




/* Login Widget */
class onepiece_login_widget extends WP_Widget {


	function __construct() {
		parent::__construct(
			'onepiece_login_widget', // Base ID
			__('Onepiece Login Widget', 'onepiece'), // Widget name and description in UI
			array( 'description' => __( 'Onepiece Login Widget (default settings customizer loginbar)', 'onepiece' ), )
		);
	}
	// Creating widget front-end
	public function widget( $args, $instance ) {

		$dsp = 1;

		if(isset($instance['dsp']) && $instance['dsp'] !='' )
		$dsp = $instance['dsp'];

        $title = 'Login';
        if( isset($instance['title']) ){
		$title = apply_filters( 'widget_title', $instance['title'] );
        }
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		// check if customizer loginbar is inactive befor using widget code
		if(get_theme_mod('onepiece_elements_loginbar_option', 'none') != 'none'){
		echo '<div class="notice notice-warning is-dismissible"><p>'
			. __( '! Disable the customizer loginbar first', 'onepiece' ).'</p></div>';


		}else{
		display_userpanel();
		}
		echo $args['after_widget'];

	}



	// Widget Backend
	public function form( $instance ) {

		if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
		}else{
		$title = __( 'New title', 'Posts listed' );
		}

		$dsp = 1;
		if ( isset( $instance[ 'dsp' ] ) ) {
		$dsp= $instance[ 'dsp' ];
		}

		/*
	 	 * Widget admin form
		 */
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php __( 'Title:', 'onepiece' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php
		if ( get_theme_mod('onepiece_elements_loginbar_option', 'none') != 'none' ){
			// https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
			echo '<div class="notice notice-warning is-dismissible"><p>'
			. __( '! Disable the customizer loginbar first', 'onepiece' ).'</p></div>';

		}
		?>

		<p><label for="<?php echo $this->get_field_id( 'dsp' ); ?>">Display(test):</label>
		<select name="<?php echo $this->get_field_name( 'dsp' ); ?>" id="<?php echo $this->get_field_id( 'dsp' ); ?>">
		<option value="0" <?php selected( $dsp, '0' ); ?>>Hide</option>
		<option value="1" <?php selected( $dsp, '1' ); ?>>Show</option>
		</select>
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['dsp'] = ( ! empty( $new_instance['dsp'] ) ) ? strip_tags( $new_instance['dsp'] ) : '';
		return $instance;

	}
}



// Register and load the widget
function onepiece_loadlogin_widget() {
	register_widget( 'onepiece_login_widget' );
}
add_action( 'widgets_init', 'onepiece_loadlogin_widget' );


















/* Recent posts Widget */
class onepiece_postlist_widget extends WP_Widget {


	function __construct() {
		parent::__construct(
			'onepiece_postlist_widget', // Base ID
			__('Onepiece Postlist Widget', 'onepiece'), // Widget name and description in UI
			array( 'description' => __( 'Onepiece Widget Post Listing with options', 'onepiece' ), )
		);
	}

	
	// Creating widget front-end
	public function widget( $args, $instance ) {


		$itemcount = 3;
		$itemorder = 'DESC';
		$excerptlength = 10;
		$dsp_image = 'center';//(none,center,left,right)
		$dsp_date = 0;
		$dsp_author = 0;
		$dsp_tags = 0;
		$currentid = get_queried_object_id();


		if(isset($instance['itemcount']) && $instance['itemcount'] !='' )
			$itemcount = $instance['itemcount'];

		if(isset($instance['itemorder']) && $instance['itemorder'] !='' )
			$itemorder = $instance['itemorder'];

		if(isset($instance['excerptlength']) && $instance['excerptlength'] !='' )
			$excerptlength = $instance['excerptlength'];

		if(isset($instance['dsp_image']) && $instance['dsp_image'] !='' )
			$dsp_image = $instance['dsp_image'];

		if(isset($instance['dsp_date']) && $instance['dsp_date'] !='' )
			$dsp_date = $instance['dsp_date'];

		if(isset($instance['dsp_author']) && $instance['dsp_author'] !='' )
			$dsp_author = $instance['dsp_author'];

		if(isset($instance['dsp_tags']) && $instance['dsp_tags'] !='' )
			$dsp_tags = $instance['dsp_tags'];


		$title = apply_filters( 'widget_title', $instance['title'] );



		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];



		/*
		 * Query for post category or related
		 * - widget selected category
		 * .. related categories / tags (or default / recent posts)
		 */




			// Category related posts
			$catsrel = "";
			//$posttags = get_the_tags();
			$postcats = get_the_category();
			if ($postcats) {
			foreach($postcats as $tag) {
				$catsrel .= ',' . $tag->name;
			}
			}
			$catsrel = substr($catsrel, 1); // remove first comma

			// Tag related posts
			$tagsrel = "";
			$posttags = get_the_tags();
			if ($posttags) {
			foreach($posttags as $tag) {
				$tagsrel .= ',' . $tag->name;
			}
			}
			$tagsrel = substr($tagsrel, 1); // remove first comma


		// list the post accoording to settings category/related
		if($instance['post_category'] == '' ||
		   (is_category() && ( $instance['post_category'] == 'PostRelCat' || $instance['post_category'] == 'PostRelTag' || $instance['post_category'] == 'PostRelCatTag' ) )  ){

			// latest of all or any '' category
			query_posts('post_status=publish&post_not_in='.$currentid.'&order='.$itemorder.'&posts_per_page='.$itemcount);

		}elseif($instance['post_category'] == 'PostRelCat' && $catsrel != ""){

			// posts with same categories
			query_posts('category_name=' .$catsrel . '&post_status=publish&post_not_in='.$currentid.'&order='.$itemorder.'&posts_per_page='.$itemcount);

		}elseif($instance['post_category'] == 'PostRelTag' && $tagsrel != ""){

			// posts with same tags
			query_posts('tag=' .$tagsrel . '&post_status=publish&post_not_in='.$currentid.'&order='.$itemorder.'&posts_per_page='.$itemcount);

		}elseif($instance['post_category'] == 'PostRelCatTag'){

			// or both tags and cats : cat=6&tag=a1
			query_posts('category_name=' .$catsrel . '&tag=' .$tagsrel . '&post_status=publish&post_not_in='.$currentid.'&order='.$itemorder.'&posts_per_page='.$itemcount);

		}else{

			// latest from specific category
			query_posts('category_name='.$instance['post_category'].'&post_status=publish&post_not_in='.$currentid.'&order='.$itemorder.'&posts_per_page='.$itemcount);

		}

		// if no results throw global query
		if ( ! have_posts() ){
			query_posts('post_status=publish&post_not_in='.$currentid.'&order='.$itemorder.'&posts_per_page='.$itemcount);
		}



		if (have_posts()) :

		echo '<ul>';

		while (have_posts()) : the_post();

		if($currentid!= get_the_ID()){ // double check if item is current active page/post id

		// define title link
		$custom_metabox_url = get_post_meta( get_the_ID() , 'meta-box-custom-url', true);
		$custom_metabox_useurl = get_post_meta( get_the_ID() , 'meta-box-custom-useurl', true);
		$custom_metabox_urltext = get_post_meta( get_the_ID() , 'meta-box-custom-urltext', true);

		$title_link = '<a class="rel-item" data-id="'.get_the_ID().'" href="'.get_the_permalink().'" target="_self" title="'.get_the_title().'">';

		if( $custom_metabox_url != '' && $custom_metabox_useurl == 'replaceblank'){
		$title_link = '<a class="rel-item" data-id="'.get_the_ID().'" href="'.$custom_metabox_url.'" target="_blank" title="'.get_the_title().'">';
		}elseif( $custom_metabox_url != '' && $custom_metabox_useurl == 'replaceself'){
		$title_link = '<a class="rel-item" data-id="'.get_the_ID().'" href="'.$custom_metabox_url.'" target="_self" title="'.get_the_title().'">';
		}


		// include product options
		include('product.php');

		//start output
		echo '<li>'. $title_link;

		echo '<div class="post-titlebox"><h4>'. get_the_title() .'</h4>';
		
			
		if($dsp_date == 1 ){
		echo '<span class="post-date time-ago">'.wp_time_ago(get_the_time( 'U' )).' </span>';
		}
			
		if($dsp_date == 2 ){
		echo '<span class="post-date">'.get_the_date().' </span>';
		}
			
		if($dsp_date == 3 ){
		echo '<span class="post-date date-time">'.get_the_date().' - '.get_the_time().'</span>';
		}
			
		if($dsp_author != 0 ){
		echo '<span class="post-author">'.get_the_author().' </span>';
		}
		echo '</div>';

		// post product label
		/*if( isset($post_meta_label) && $post_meta_label[0] != 'none' &&  $instance[ 'dsp_label' ] != 0 ){
		echo '<div class="labelbox"><span class="productlabel">'.$post_meta_label[0].'</span></div>';
		}*/

			// post product label
			echo $productlabel;

		// product box
		if( isset( $instance[ 'dsp_price' ] ) && $instance[ 'dsp_price' ] != 0)
		echo $productbox;

		echo '<div class="item-excerpt">'; //.$title_link;

		if ( has_post_thumbnail() && $dsp_image != 'none' ) {
			$align = 'align-'.$dsp_image;
			echo get_the_post_thumbnail( get_the_ID(), 'big-thumb', array( 'class' => $align )); //the_post_thumbnail('big-thumb');
    	}

		// Post intro content

		// preg_replace('/(?i)<a([^>]+)>(.+?)<\/a>/','', get_the_excerpt() );

		echo '<p>';
		the_excerpt_length( $excerptlength, false );
		echo '</p>';

		echo '</div><div class="clr"></div>';

		echo '</a>';

		// package box
		if( $instance[ 'dsp_packweight' ] !=0)
			echo $packagebox;

		// order box
		if( isset( $instance[ 'dsp_order' ] )  && $instance[ 'dsp_order' ] != 0)
			echo $orderbox;

		if( isset( $instance[ 'dsp_tags' ] )  && $dsp_tags != 0 ){
			echo '<div class="post-tags">';
    		the_tags('Tagged with: ',' '); // the_tags(', ');  //
			echo '</div>';
		}

			echo '</li>';
		}

		endwhile;

		echo '</ul>';

		endif;

		wp_reset_query();

		echo $args['after_widget'];
	}



	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
		}else{
		$title = __( 'New title', 'Posts listed' );
		}


		/*
	 	 * Widget admin form
		 */

		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php __( 'Title:', 'onepiece' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php

		
		if ( isset( $instance[ 'post_category' ] ) ) {
		$post_category = $instance[ 'post_category' ];
		}else{
		$post_category = '';
		}

		$catarr = get_categories_select(); // functions.php
		?>
		<p><label for="<?php echo $this->get_field_id( 'post_category' ); ?>">Posts category or related:</label>
		<select name="<?php echo $this->get_field_name( 'post_category' ); ?>" id="<?php echo $this->get_field_id( 'post_category' ); ?>">
		<?php
		foreach($catarr as $slg => $nm){
			echo '<option value="'.$slg.'" '.selected( $post_category, $slg ).'>- '.$nm.'</option>';
		}
		?>
		<option value="PostRelCatTag" <?php selected( $post_category, 'PostRelCatTag' ); ?>>Related by cats &amp; tags</option>
		<option value="PostRelCat" <?php selected( $post_category, 'PostRelCat' ); ?>>Related by category</option>
		<option value="PostRelTag" <?php selected( $post_category, 'PostRelTag' ); ?>>Related by tags</option>
		<option value="" <?php selected( $post_category, '' ); ?>>Any (Recents) Posts</option>
		</select>
		</p>

		<?php
		$value = '';
		if ( isset( $instance[ 'itemcount' ] ) ) {
			$value = 'value="'.$instance[ 'itemcount' ].'" ';
		}
		?>
		<p><label for="<?php echo $this->get_field_id( 'itemcount' ); ?>">Amount of items:</label>
		<input type="text" size="3" <?php echo $value; ?>name="<?php echo $this->get_field_name( 'itemcount' ); ?>" id="<?php echo $this->get_field_id( 'itemcount' ); ?>" />
		</p>

		<?php
		$itemorder = 'DESC';
		if ( isset( $instance[ 'itemorder' ] ) ) {
		$itemorder = $instance[ 'itemorder' ];
		}
		?>
		<p><label for="<?php echo $this->get_field_id( 'itemorder' ); ?>">List order:</label>
		<select name="<?php echo $this->get_field_name( 'itemorder' ); ?>" id="<?php echo $this->get_field_id( 'itemorder' ); ?>">
		<option value="DESC" <?php selected( $itemorder, 'DESC' ); ?>>Recent</option>
		<option value="ASC" <?php selected( $itemorder, 'ASC' ); ?>>Oldest first</option>
		</select>
		</p>


		<?php
		$value = '';
		if ( isset( $instance[ 'excerptlength' ] ) ) {
			$value = 'value="'.$instance[ 'excerptlength' ].'" ';
		}
		?>
		<p><label for="<?php echo $this->get_field_id( 'excerptlength' ); ?>">Amount of text in words:</label>
		<input type="text" size="3" <?php echo $value; ?>name="<?php echo $this->get_field_name( 'excerptlength' ); ?>" id="<?php echo $this->get_field_id( 'excerptlength' ); ?>" />
		</p>




		<?php
		$dsp_image = '';
		if ( isset( $instance[ 'dsp_image' ] ) ) {
		$dsp_image = $instance[ 'dsp_image' ];
		}

		?>
		<p><label for="<?php echo $this->get_field_id( 'dsp_image' ); ?>">Featured image:</label>
		<select name="<?php echo $this->get_field_name( 'dsp_image' ); ?>" id="<?php echo $this->get_field_id( 'dsp_image' ); ?>">
		<option value="none" <?php selected( $dsp_image, 'none' ); ?>>None</option>
		<option value="center" <?php selected( $dsp_image, 'center' ); ?>>Center</option>
		<option value="left" <?php selected( $dsp_image, 'left' ); ?>>Left</option>
		<option value="right" <?php selected( $dsp_image, 'right' ); ?>>Right</option>
		</select>
		</p>

		<?php
		$dsp_date = 0;
		if ( isset( $instance[ 'dsp_date' ] ) ) {
		$dsp_date = $instance[ 'dsp_date' ];
		}

		?>
		<p><label for="<?php echo $this->get_field_id( 'dsp_date' ); ?>">Show Post Time:</label>
		<select name="<?php echo $this->get_field_name( 'dsp_date' ); ?>" id="<?php echo $this->get_field_id( 'dsp_date' ); ?>">
		<option value="0" <?php selected( $dsp_date, 0 ); ?>>Hide</option>
		<option value="1" <?php selected( $dsp_date, '1' ); ?>>Show Time Ago</option>
		<option value="2" <?php selected( $dsp_date, '2' ); ?>>Show Date</option>
		<option value="3" <?php selected( $dsp_date, '3' ); ?>>Show Date and Time</option>
		</select>
		</p>

		<?php
		$dsp_author = 0;
		if ( isset( $instance[ 'dsp_author' ] ) ) {
		$dsp_author = $instance[ 'dsp_author' ];
		}

		?>
		<p><label for="<?php echo $this->get_field_id( 'dsp_author' ); ?>">Show author:</label>
		<select name="<?php echo $this->get_field_name( 'dsp_author' ); ?>" id="<?php echo $this->get_field_id( 'dsp_author' ); ?>">
		<option value="0" <?php selected( $dsp_author, '0' ); ?>>Hide</option>
		<option value="1" <?php selected( $dsp_author, '1' ); ?>>Show</option>
		</select>
		</p>

		<?php
		$dsp_tags = 0;
		if ( isset( $instance[ 'dsp_tags' ] ) ) {
		$dsp_tags = $instance[ 'dsp_tags' ];
		}

		?>
		<p><label for="<?php echo $this->get_field_id( 'dsp_tags' ); ?>">Show tags:</label>
		<select name="<?php echo $this->get_field_name( 'dsp_tags' ); ?>" id="<?php echo $this->get_field_id( 'dsp_tags' ); ?>">
		<option value="0" <?php selected( $dsp_tags, '0' ); ?>>Hide</option>
		<option value="1" <?php selected( $dsp_tags, '1' ); ?>>Show</option>
		</select>
		</p>

		<h4>Product options</h4>
		<?php
		$dsp_label = 0;
		if ( isset( $instance[ 'dsp_label' ] ) ) {
		$dsp_label = $instance[ 'dsp_label' ];
		}
		?>
		<p><label for="<?php echo $this->get_field_id( 'dsp_label' ); ?>">Show label:</label>
		<select name="<?php echo $this->get_field_name( 'dsp_label' ); ?>" id="<?php echo $this->get_field_id( 'dsp_label' ); ?>">
		<option value="0" <?php selected( $dsp_label, '0' ); ?>>Hide</option>
		<option value="1" <?php selected( $dsp_label, '1' ); ?>>Show</option>
		</select>
		</p>

		<?php
		$dsp_size = 0;
		if ( isset( $instance[ 'dsp_size' ] ) ) {
		$dsp_size = $instance[ 'dsp_size' ];
		}
		?>
		<p><label for="<?php echo $this->get_field_id( 'dsp_size' ); ?>">Show size:</label>
		<select name="<?php echo $this->get_field_name( 'dsp_size' ); ?>" id="<?php echo $this->get_field_id( 'dsp_size' ); ?>">
		<option value="0" <?php selected( $dsp_size, '0' ); ?>>Hide</option>
		<option value="1" <?php selected( $dsp_size, '1' ); ?>>Show</option>
		</select>
		</p>

		<?php
		$dsp_price = 0;
		if ( isset( $instance[ 'dsp_price' ] ) ) {
		$dsp_price = $instance[ 'dsp_price' ];
		}

		?>
		<p><label for="<?php echo $this->get_field_id( 'dsp_price' ); ?>">Show price (incl. discount):</label>
		<select name="<?php echo $this->get_field_name( 'dsp_price' ); ?>" id="<?php echo $this->get_field_id( 'dsp_price' ); ?>">
		<option value="0" <?php selected( $dsp_price, '0' ); ?>>Hide</option>
		<option value="1" <?php selected( $dsp_price, '1' ); ?>>Show</option>
		</select>
		</p>

		<?php
		$dsp_packweight = 0;
		if ( isset( $instance[ 'dsp_packweight' ] ) ) {
		$dsp_packweight = $instance[ 'dsp_packweight' ];
		}

		?>
		<p><label for="<?php echo $this->get_field_id( 'dsp_packweight' ); ?>">Show package weight and size:</label>
		<select name="<?php echo $this->get_field_name( 'dsp_packweight' ); ?>" id="<?php echo $this->get_field_id( 'dsp_packweight' ); ?>">
		<option value="0" <?php selected( $dsp_packweight, '0' ); ?>>Hide</option>
		<option value="1" <?php selected( $dsp_packweight, '1' ); ?>>Show</option>
		</select>
		</p>


		<?php
		$dsp_order = 0;
		if ( isset( $instance[ 'dsp_order' ] ) ) {
		$dsp_order = $instance[ 'dsp_order' ];
		}

		?>
		<p><label for="<?php echo $this->get_field_id( 'dsp_order' ); ?>">Show order option(s):</label>
		<select name="<?php echo $this->get_field_name( 'dsp_order' ); ?>" id="<?php echo $this->get_field_id( 'dsp_order' ); ?>">
		<option value="0" <?php selected( $dsp_order, '0' ); ?>>Hide</option>
		<option value="1" <?php selected( $dsp_order, '1' ); ?>>Show</option>
		</select>
		</p>

		<?php

	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		//$instance['function_type'] = ( ! empty( $new_instance['function_type'] ) ) ? strip_tags( $new_instance['function_type'] ) : '';
		$instance['post_category'] = ( ! empty( $new_instance['post_category'] ) ) ? strip_tags( $new_instance['post_category'] ) : '';
		$instance['itemcount'] = ( ! empty( $new_instance['itemcount'] ) ) ? strip_tags( $new_instance['itemcount'] ) : '';
		$instance['itemorder'] = ( ! empty( $new_instance['itemorder'] ) ) ? strip_tags( $new_instance['itemorder'] ) : '';
		$instance['excerptlength'] = ( ! empty( $new_instance['excerptlength'] ) ) ? strip_tags( $new_instance['excerptlength'] ) : '';
		$instance['dsp_image'] = ( ! empty( $new_instance['dsp_image'] ) ) ? strip_tags( $new_instance['dsp_image'] ) : '';
		$instance['dsp_date'] = ( ! empty( $new_instance['dsp_date'] ) ) ? strip_tags( $new_instance['dsp_date'] ) : '';
		$instance['dsp_author'] = ( ! empty( $new_instance['dsp_author'] ) ) ? strip_tags( $new_instance['dsp_author'] ) : '';
		$instance['dsp_tags'] = ( ! empty( $new_instance['dsp_tags'] ) ) ? strip_tags( $new_instance['dsp_tags'] ) : '';


		$instance['dsp_label'] = ( ! empty( $new_instance['dsp_label'] ) ) ? strip_tags( $new_instance['dsp_label'] ) : '';
		$instance['dsp_size'] = ( ! empty( $new_instance['dsp_size'] ) ) ? strip_tags( $new_instance['dsp_size'] ) : '';
		$instance['dsp_price'] = ( ! empty( $new_instance['dsp_price'] ) ) ? strip_tags( $new_instance['dsp_price'] ) : '';
		$instance['dsp_packweight'] = ( ! empty( $new_instance['dsp_packweight'] ) ) ? strip_tags( $new_instance['dsp_packweight'] ) : '';
		$instance['dsp_order'] = ( ! empty( $new_instance['dsp_order'] ) ) ? strip_tags( $new_instance['dsp_order'] ) : '';
		return $instance;
	}

} // Class wpb_widget ends here

// Register and load the widget
function onepiece_load_widget() {
	register_widget( 'onepiece_postlist_widget' );
}
add_action( 'widgets_init', 'onepiece_load_widget' );













/* Category Posts Slider
this function can output different types of content lists for multiple usages like sliders and carrousels */
/*
function display_posts_by_category( $cat=0, $columnset=0, $content='full', $target='self', $url=''){

	// $cat array or $id
 	// $columnset amount of posts/items in a row/box, 0 for single most recent post
	// $content title / text / image / full / imgtitle / imgtitlecat / imgtitletext / titlecat
	// $target blank / self / none
	// $url



	if($cat == 0){
		$cat = get_option('default_category');
	}
	$ppp = 50; // max posts to retrieve
	if($columnset == 0){
	$ppp = 1;
	}
	query_posts("cat=$cat&post_status=publish&posts_per_page=$ppp&orderby=date&order=ASC");
	if( have_posts() ) :
	$count = 0;
	echo '<div class="listcategoryposts"><div class="covertop"></div><ul>';
	while ( have_posts() ) : the_post();

	$custom = get_post_custom( get_the_ID() );
	if($target != 'none'){
	$titlelink = '<a href="'.get_the_permalink().'" target="_'.$target.'">';

	if( $url !='' ){ // overwrite single target urls
		$titlelink = '<a href="'.$url.'" target="_'.$target.'">';
	}
	}

	if($count == 0){
    	echo '<li class="colset'.$columnset.'">';
	}
	echo '<div class="cat-post">';
    	if(get_the_post_thumbnail( $post->ID, 'medium' )!='' && ($content != 'title' || $content != 'text' || $content != 'titlecat') ){
			if($target == 'none'){
			    echo '<div class="imagebox">'.get_the_post_thumbnail( $post->ID, 'medium' ).'</div>';
			}else{
			    echo '<div class="imagebox">'.$titlelink.''.get_the_post_thumbnail( $post->ID, 'medium' ).'</a></div>';
			}
		}

		if($content != 'image' && $content != 'text'){

		$title = get_the_title();

		echo '<h4>';
		if($target == 'none'){
    	echo $title;
		}else{
		echo $titlelink.$title.'</a>';
		}
		echo '</h4>';

		}

		if($content == 'full' || $content == 'imgtitlecat' || $content == 'titlecat'){
		echo '<div class="catname signbut">';
    		foreach((get_the_category()) as $category) {
    			echo $category->cat_name;
			break; // show only 1 category
		}
		echo '</div>';
		}
		if($content == 'full' || $content == 'text' || $content == 'imgtitletext'){
		echo '<div class="textbox">';
    		the_excerpt();
		echo '</div>';
		}
	echo '</div>';
	$count++;
	if($count >= $columnset){
    	echo '</li>';
	$count = 0;
	}
	endwhile;
	echo '</ul><div class="coverbottom"></div><div class="clr"></div></div>';
	endif;
	wp_reset_query();

}

*/
?>
