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

function tweetTime( $t ) {
	/**** Begin Time Loop ****/
	// Set time zone
	date_default_timezone_set('America/New_York');
	// Get Current Server Time
	$server_time = $_SERVER['REQUEST_TIME'];
	// Convert Twitter Time to UNIX
	$new_tweet_time = strtotime($t);
	// Set Up Output for the Timestamp if over 24 hours
	$this_tweet_day =  date('D. M j, Y', strtotime($t));
	// Subtract Twitter time from current server time
	$time = $server_time - $new_tweet_time;			
	// less than an hour, output 'minutes' messaging
	if( $time < 3599) {
		$time = round($time / 60) . ' minutes ago';
			}
	// less than a day but over an hour, output 'hours' messaging 
	else if ($time >= 3600 && $time <= 86400) {
		$time = round($time / 3600) . ' hours ago';
		}
	// over a day, output the $tweet_day formatting
	else if ( $time > 86400)  {
		$time = $this_tweet_day;
		}
	// return final time from tweetTime()
	return $time;
	/**** End Time Loop ****/
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

/*
class onepiece_widget extends WP_Widget {

function __construct() {
parent::__construct(
'onepiece_widget', // Base ID of your widget
__('Onepiece Widget', 'onepiece'), // Widget name will appear in UI
array( 'description' => __( 'Onepiece Theme Widget', 'onepiece' ), ) 
); // Widget description
}

// Creating widget front-end
public function widget( $args, $instance ) {
    
    $title = apply_filters( 'widget_title', $instance['title'] );
    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];
    
	// This is where you run the code and display the output
	if($instance['function_type'] == 'login'){
	
	display_userpanel();
	
	}else{
	
	echo '('.$instance['function_type'].')';
	
	}
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
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php __( 'Title:', 'onepiece' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <?php
    if ( isset( $instance[ 'function_type' ] ) ) {
    $function_type = $instance[ 'function_type' ];
    }else{
    $function_type = 'code';
    }
    ?>
    <p><label for="<?php echo $this->get_field_id( 'function_type' ); ?>">Function:</label>
    <select name="<?php echo $this->get_field_name( 'function_type' ); ?>" id="<?php echo $this->get_field_id( 'function_type' ); ?>">
    <option value="code" <?php selected( $function_type, 'code' ); ?>>Code</option>
    <option value="login" <?php selected( $function_type, 'login' ); ?>>Login</option>
    <option value="content" <?php selected( $function_type, 'content' ); ?>>Content</option>
    <option value="media" <?php selected( $function_type, 'media' ); ?>>Media</option>
    </select>
    </p>
    <?php 
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['function_type'] = ( ! empty( $new_instance['function_type'] ) ) ? strip_tags( $new_instance['function_type'] ) : '';
    return $instance;
    }
} // Class wpb_widget ends here

// Register and load the widget
function onepiece_load_widget() {
	register_widget( 'onepiece_widget' );
}
add_action( 'widgets_init', 'onepiece_load_widget' );
*/

?>