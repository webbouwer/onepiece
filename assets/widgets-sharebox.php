<?php
/**
 * Onepiece Share Widget

class onepiece_share_widget extends WP_Widget {


	///Contruct
	function __construct() {

		// clients to share to
		$clients = array(

			"google" => array(
				"a_name"=> "Google+",
				//"a_icon"=> 'ICONURL',
				"a_url" => "https://plus.google.com/share?",
				"q_url" => "url=",
				//"q_txt" => "text=",
				//"q_ttl" => "title=",
				//"q_img" => "media=",
				//"q_via" => "via=",
				//"d_attr" => "data-action="
			),

			"linkedin" => array(

				"a_name"=> "Linkedin",
				//"a_icon"=> 'ICONURL',
				"a_url" => "http://www.linkedin.com/shareArticle?mini=true&",
				"q_url" => "url=",
				"q_ttl" => "title=",
				"q_txt" => "summary=",
				//"q_img" => "media=",
				"q_via" => "source=",
				//"d_attr" => "data-action="
			),

			"twitter" => array(
				"a_name"=> "Twitter",
				//"a_icon"=> 'ICONURL',
				"a_url" => "https://twitter.com/intent/tweet?",
				"q_url" => "url=",
				//"q_ttl" => "",
				"q_txt" => "text=",
				//"q_img" => "media=",
				"q_via" => "via=",
				//"d_attr" => "data-action="
			),

			"facebook" => array(
				"a_name"=> "Facebook",
				//"a_icon"=> 'ICONURL',
				"a_url" => "https://www.facebook.com/sharer/sharer.php?",
				"q_url" => "u=",
				//"q_ttl" => "",
				//"q_txt" => "text=",
				//"q_img" => "media=",
				//"q_via" => "via=",
				//"d_attr" => "data-action="
			),

			"whatsapp" => array(
				"a_name"=> "Whatsapp",
				//"a_icon"=> 'ICONURL',
				"a_url" => "whatsapp://send?",
				"q_url" => "text=",
				//"q_ttl" => "",
				//"q_txt" => "text=",
				//"q_img" => "media=",
				//"q_via" => "via=",
				"d_attr" => 'data-action="share/whatsapp/share"',
			),

			"pinterest" => array(
				"a_name"=> "Pinterest",
				//"a_icon"=> 'ICONURL',
				"a_url" => "http://pinterest.com/pin/create/button/?",
				"q_url" => "url=",
				//"q_ttl" => "",
				"q_txt" => "description=",
				"q_img" => "media=",
				//"q_via" => "via=",
				//"d_attr" => 'data-action=',
			),

			"email" => array(
				"a_name"=> "Email",
				//"a_icon"=> 'ICONURL',
				"a_url" => "mailto:?",
				"q_url" => "Body=",
				"q_ttl" => "Subject=",
				//"q_txt" => "desc=",
				//"q_img" => "media=",
				//"q_via" => "via=",
				//"d_attr" => 'data-action=',
			),

		);


		$widget_ops = array('classname' => 'onepiece_share_widget', 'description' => __('Display your favourite share buttons'));
    	$control_ops = array('clients' => $clients);
    	parent::__construct('onepiece_share_widget', __('Share buttons'), $widget_ops, $control_ops);

		//parent::__construct( 'onepiece_share_widget', // Base ID
			//__('Onepiece Share Widget', 'onepiece'), // Widget name and description in UI
			//array( 'description' => __( 'Display your favourite share buttons', 'onepiece' ),

			//)
		//);
	}


	//Widget front-end
	public function widget( $args, $instance ) {

		extract( $args );

    	$clients   = ($instance['clients']);

		// Widget Title
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Share Title & Text
		$titletext = get_bloginfo( 'title' );
		$desctext = get_bloginfo( 'description' );

		// Share Url
		$siteurl = site_url();

		// Share image
		//if(get_theme_mod()){ // check theme site featured image(onepiece theme)
		//}else{ // check site logo
		//}else{ // check widgets image set
		//}
		$imageurl = get_theme_mod('onepiece_identity_featured_image');

		//$itemcount = 3;
		//if(isset($instance['itemcount']) && $instance['itemcount'] !='' )
		//$itemcount = $instance['itemcount'];
		//echo $itemamount;







		$linklist = '';
		foreach( $clients as $nm => $client ){

			//.. check if selected (maybe check if an api is available..)
			// if no a_url(fixed) or q_url(var)
			// if selected in widget settings

			$button = $client['a_name'];
			if(isset($client['a_icon'])){
				$button = '<img src="'.$client['a_icon'].'" name="Share on '.$client['a_name'].'" />';
			}


			$urlstr = $client['a_url'].$client['q_url'].$siteurl;

			if( isset($client['q_ttl']) && isset($client['q_txt'])){ // title & text
				$urlstr .='&'.$client['q_ttl'].$titletext.'&'.$client['q_txt'].$desctext;
			}else if( isset($client['q_ttl']) && !isset($client['q_txt']) ){ // description
				$urlstr .='&'.$client['q_ttl'].$titletext;
			}else if( isset($client['q_txt']) ){ // description
				$urlstr .='&'.$client['q_txt'].$titletext.' - '.$desctext;
			}

			if(isset($client['q_img'])){ // site featured image
				$urlstr .='&'.$client['q_img'].'{'.$imageurl.'}';
			}

			if(isset($client['q_via'])){ // from website name
				$urlstr .='&'.$client['q_via'].get_bloginfo( 'name' );
			}

			// data-action attribute like 'share/whatsapp/share' for whats app
			$data_attr = '';
			if(isset($client['d_attr'])){ // data-action attribute like 'share/whatsapp/share' for whats app
				$data_attr = ' data-action="share/whatsapp/share"';
			}

			// create html
			$linklist .= '<li style="display:inline-block"><a href="'.$urlstr.'" title="Share on '.$client['a_name'].'" target="_blank"'.$data_attr.'><span>'.$button.'</span></a></li>';

		}




		echo $args['before_widget']; // before and after widget arguments are defined by themes

		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		echo '<ul class="sharebox">'.$linklist.'</ul>';

		echo $args['after_widget'];



		//echo '<ul class="sharebox">';

		//echo '<li style="display:inline-block;"><a href="http://www.linkedin.com/shareArticle?mini=true&title='.$titletext.'&summary='.$desctext.'&source=http://www.webdesigndenhaag.net&url='.$siteurl.'" target="_blank">Linkedin</a></li>';
		//echo '<li style="display:inline-block;"><a href="https://plus.google.com/share?url='.$siteurl.'" target="_blank">Google+</a></li>';
		//echo '<li style="display:inline-block;"><a href="https://twitter.com/intent/tweet?url='.$siteurl.'&text='.$titletext.' - '.$desctext.'&via='.get_bloginfo('name').'" target="_blank">Twitter</a></li>';
		//echo '<li style="display:inline-block;"><a href="https://www.facebook.com/sharer/sharer.php?u='.$siteurl.'" target="_blank">Facebook</a></li>';
		//echo '<li style="display:inline-block;"><a href="whatsapp://send?text='.$titletext.' - '.$desctext.' - '.$siteurl.' " data-action="share/whatsapp/share">Whatsapp</a></li>';
		//echo '<li style="display:inline-block;"><a href="http://pinterest.com/pin/create/button/?url='.$siteurl.'&media={'.$imageurl.'}&description='.$titletext.' - '.$desctext.'" target="_blank">Pinterest</a></li>';
		//echo '<li style="display:inline-block;"><a href="mailto:?Subject='.$titletext.'&Body='.$bodytext.'" target="_blank">Email</a></li>';
		//echo '<li style="display:inline-block;"><a href="http://www.tumblr.com/share/link?url='.$siteurl.'&amp;title='.$titletext.'" target="_blank">Tumblr</a></li>';
		//echo '<li style="display:inline-block;"><a href="http://reddit.com/submit?url='.$siteurl.'&amp;title='.$titletext.'" target="_blank">Reddit</a></li>';
		//echo '<li style="display:inline-block;"><a href="http://www.stumbleupon.com/submit?url='.$siteurl.'&amp;title='.$titletext.'" target="_blank">StumbleUpon</a></li>';
		//echo '<li style="display:inline-block;"><a href="http://www.digg.com/submit?url='.$siteurl.'" target="_blank">Digg</a></li>';
		//echo '<li style="display:inline-block;"><a href="whatsapp://send?text='.$titletext.' - '.$desctext.' - '.$siteurl.' " data-action="share/whatsapp/share">Instagram</a></li>'; // ?


	}



	// Widget Backend
	public function form( $instance ) {



		echo '!Widget in development!';



		//option:
		 // - select link/page to share (select page)
		 // - display text (name)
		 // - display icons (positioning)
		 // - set image to share





		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else{
			$title = __( 'New title', 'Posts listed' );
		}

		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php __( 'Title:', 'onepiece' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
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
		if(isset($instance['clients'])){
			print_r($instance['clients']);
		}

	}

	// Widget update/save settings
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['itemcount'] = ( ! empty( $new_instance['itemcount'] ) ) ? strip_tags( $new_instance['itemcount'] ) : '';
		return $instance;
	}

} // Class wpb_widget ends here

// Register and load the widget
function onepiece_load_share_widget() {
	register_widget( 'onepiece_share_widget' );
}
add_action( 'widgets_init', 'onepiece_load_share_widget' );
*/
?>
