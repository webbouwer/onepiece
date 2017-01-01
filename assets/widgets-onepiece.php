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
		echo '<small>'.$event->type.' '.tweetTime($event->created_at).' by <a href="https://github.com/'.$event->actor->login.'" target="_blank">'.$event->payload->commits[0]->author->name.'</a></small></li>';
		}	
	}
	echo '</ul>';
	}
}



















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












/* Add Custom Onepiece Widget */
class onepiece_widget extends WP_Widget {


	function __construct() {
		parent::__construct(
			'onepiece_widget', // Base ID
			__('Onepiece Widget', 'onepiece'), // Widget name and description in UI
			array( 'description' => __( 'Onepiece Theme Widget', 'onepiece' ), )
		);
	}

	
	// Creating widget front-end
	public function widget( $args, $instance ) {


		$itemcount = 3;
		$excerptlength = 10;
		$dsp_image = 'center';//(none,center,left,right)
		$dsp_date = 0;
		$dsp_author = 0;
		$dsp_tags = 0;


		if(isset($instance['itemcount']) && $instance['itemcount'] !='' )
			$itemcount = $instance['itemcount'];

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



		if($instance['post_category'] == ''){

		// latest of all
		query_posts('post_status=publish&order=DESC&posts_per_page='.$itemcount);

		}else{

		// latest from category
		query_posts('category_name='.$instance['post_category'].'&post_status=publish&order=DESC&posts_per_page='.$itemamount);

		}



		//query_posts('category_name='.$category->slug); // or use  something with get_category_link( $category )
		if (have_posts()) :

		echo '<ul>';

		while (have_posts()) : the_post();

		// define title link
		$custom_metabox_url = get_post_meta( get_the_ID() , 'meta-box-custom-url', true);
		$custom_metabox_useurl = get_post_meta( get_the_ID() , 'meta-box-custom-useurl', true);
		$custom_metabox_urltext = get_post_meta( get_the_ID() , 'meta-box-custom-urltext', true);

		$title_link = '<a href="'.get_the_permalink().'" target="_self" title="'.get_the_title().'">';
		if( $custom_metabox_url != '' && $custom_metabox_useurl == 'replaceblank'){
		$title_link = '<a href="'.$custom_metabox_url.'" target="_blank" title="'.get_the_title().'">';
		}elseif( $custom_metabox_url != '' && $custom_metabox_useurl == 'replaceself'){
		$title_link = '<a href="'.$custom_metabox_url.'" target="_self" title="'.get_the_title().'">';
		}



		echo '<li>';

		echo '<div><h4>'.$title_link . get_the_title() .'</a></h4>';
		if($dsp_date != 0 ){
		echo '<span class="post-date">'.tweetTime(get_the_date('c')).' </span>';
		}
		if($dsp_author != 0 ){
		echo '<span class="post-author">'.get_the_author().' </span>';
		}
		echo '</div>';


		if ( has_post_thumbnail() && $dsp_image != 'none' ) {
			echo '<div class="coverimage">'.$title_link;
			the_post_thumbnail('big-thumb');
   			echo '</a></div>';
    	}


		echo '<div class="post-excerpt">';
		the_excerpt_length( $excerptlength );
		'</div>';



		if( $dsp_tags != 0 ){
			echo '<div class="post-tags">';
    		the_tags('Tagged with: ',' '); // the_tags(', ');  //
			echo '</div>';
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
		$title = __( 'New title', 'onepiece' );
		}
		// Widget admin form

		/*
	 	 * TODO:
	 	 * display options: max items, image[placement], date, author, excerpt length, readmore link, tags
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
		<p><label for="<?php echo $this->get_field_id( 'post_category' ); ?>">Posts category:</label>
		<select name="<?php echo $this->get_field_name( 'post_category' ); ?>" id="<?php echo $this->get_field_id( 'post_category' ); ?>">
		<option value="" <?php selected( $post_category, '' ); ?>>Any</option>
		<?php
		foreach($catarr as $slg => $nm){
			echo '<option value="'.$slg.'" '.selected( $post_category, $slg ).'>'.$nm.'</option>';
		}
		?>
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
		/*
		$itemcount = 3;
		$excerptlength = 10;
		$dsp_image = 'center';//(none,center,left,right)
		$dsp_date = 0;
		$dsp_author = 0;
		$dsp_tags = 0;
		*/

	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		//$instance['function_type'] = ( ! empty( $new_instance['function_type'] ) ) ? strip_tags( $new_instance['function_type'] ) : '';
		$instance['post_category'] = ( ! empty( $new_instance['post_category'] ) ) ? strip_tags( $new_instance['post_category'] ) : '';
		$instance['itemcount'] = ( ! empty( $new_instance['itemcount'] ) ) ? strip_tags( $new_instance['itemcount'] ) : '';
		$instance['excerptlength'] = ( ! empty( $new_instance['excerptlength'] ) ) ? strip_tags( $new_instance['excerptlength'] ) : '';
		$instance['dsp_image'] = ( ! empty( $new_instance['dsp_image'] ) ) ? strip_tags( $new_instance['dsp_image'] ) : '';
		$instance['dsp_date'] = ( ! empty( $new_instance['dsp_date'] ) ) ? strip_tags( $new_instance['dsp_date'] ) : '';
		$instance['dsp_author'] = ( ! empty( $new_instance['dsp_author'] ) ) ? strip_tags( $new_instance['dsp_author'] ) : '';
		$instance['dsp_tags'] = ( ! empty( $new_instance['dsp_tags'] ) ) ? strip_tags( $new_instance['dsp_tags'] ) : '';
		return $instance;
	}

} // Class wpb_widget ends here

// Register and load the widget
function onepiece_load_widget() {
	register_widget( 'onepiece_widget' );
}
add_action( 'widgets_init', 'onepiece_load_widget' );


?>
