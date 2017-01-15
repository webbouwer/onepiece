<?php
/**
 * Onepiece Share Widget
 *
 * Display share/follow 'social' buttons
 *
 * Based on custom webentities data array (https://github.com/oddsized/webentities)
 * See first entity (email) for info
 */


// Create the global entity array to use
// (might move to functions.php or retrieve this from github production branch
// if not available in other themes, contruct the array here)
function onepiece_global_share_entities() {

	/* contruct the global array */
    global $onepiece_share_entities;
    $onepiece_share_entities = array(

		/* Update list on github */

		"email" => array(
			'company' => array(
				'name' => 'Email',
			),
			'share' => array(
				"l_name"=> "Email",
				"l_icon"=> 'fa:envelope-square', // testing font awsome https://icons8.com/welovesvg
				"l_url" => "mailto:?",
				//"l_attr" => 'data-action=', //unused properties kept in place for future changes

				"s_url" => "Body=",
				"s_ttl" => "Subject=",
				//"s_txt" => "text=",
				//"s_img" => "media=",
				//"s_via" => "via=",
			),
		),
		"google" => array(
			'company' => array(
				'name' => 'Google',
			),
			'share' => array(
				"l_name"=> "Google+", 							// link name
				"l_icon"=> 'fa:google-plus-square', 					// link icon
				"l_url" => "https://plus.google.com/share?", 	// link url
				//"l_attr" => "data-action=", 					// link data-action attribute

				"s_url" => "url=", 								// share url
				//"s_txt" => "text=", 							// share description
				//"s_ttl" => "title=", 							// share title
				//"s_img" => "media=", 							// share image
				//"s_via" => "via=", 							// share via/source
			),
			//'api' => Array(),
		),

		"linkedin" => array(
			'company' => array(
				'name' => 'LinkedIn',
			),
			'share' => array(
				"l_name"=> "Linkedin",
				"l_icon"=> 'fa:linkedin-square',
				"l_url" => "http://www.linkedin.com/shareArticle?mini=true&",
				//"l_attr" => "data-action="

				"s_url" => "url=",
				"s_ttl" => "title=",
				"s_txt" => "summary=",
				//"s_img" => "media=",
				"s_via" => "source=",
			),
		),
		"twitter" => array(
			'company' => array(
					'name' => 'Twitter',
			),
			'share' => array(
				"l_name"=> "Twitter",
				"l_icon"=> 'fa:twitter-square',
				"l_url" => "https://twitter.com/intent/tweet?",
				//"l_attr" => "data-action=",
				"s_url" => "url=",
				//"s_ttl" => "",
				"s_txt" => "text=",
				//"s_img" => "media=",
				"s_via" => "via=",
			),
		),
		"facebook" => array(
			'company' => array(
					'name' => 'Facebook',
			),
			'share' => array(
				"l_name"=> "Facebook",
				"l_icon"=> 'fa:facebook-square',
				"l_url" => "https://www.facebook.com/sharer/sharer.php?",
				//"l_attr" => "data-action=",

				"s_url" => "u=",
				"s_ttl" => "title=",
				//"s_txt" => "text=",
				//"s_img" => "media=",
				//"s_via" => "via=",
			),
		),
		"whatsapp" => array(
			'company' => array(
					'name' => 'Whatsapp',
			),
			'share' => array(
				"l_name"=> "Whatsapp",
				"l_icon"=> 'fa:whatsapp',
				"l_url" => "whatsapp://send?",
				"l_attr" => 'data-action="share/whatsapp/share"',

				//"s_url" => "u=",
				//"s_ttl" => "",
				"s_txt" => "text=",
				//"s_img" => "media=",
				//"s_via" => "via=",
			),
		),
		"pinterest" => array(
			'company' => array(
					'name' => 'Pinterest',
			),
			'share' => array(
				"l_name"=> "Pinterest",
				"l_icon"=> 'fa:pinterest-square',
				"l_url" => "http://pinterest.com/pin/create/bookmarklet/?",
				//"l_attr" => 'data-action=',

				"s_url" => "url=",
				"s_ttl" => "description=",
				//"s_txt" => "description=",
				"s_img" => "media=",
				//"s_via" => "via=",
			),
		),
		"tumblr" => array(
			'company' => array(
				'name' => 'Tumblr',
			),
			'share' => array(
				"l_name"=> "Tumblr",
				"l_icon"=> 'fa:tumblr-quare',
				"l_url" => "http://www.tumblr.com/share?v=3&",
				//"l_attr" => 'data-action=',

				"s_url" => "u=",
				"s_ttl" => "t=",
				//"s_txt" => "desc=",
				//"s_img" => "media=",
				//"s_via" => "via=",
			),
		),

		'slashdot' => array(), // http://slashdot.org/bookmark.pl?url=[URL]&title=[TITLE]
		'technorati' => array(),// http://technorati.com/faves?add=[URL]&title=[TITLE]
		'tapiture' => array(), // http://tapiture.com/bookmarklet/image?img_src=[IMAGE]&page_url=[URL]&page_title=[TITLE]&img_title=[TITLE]&img_width=[IMG WIDTH]img_height=[IMG HEIGHT]
		'reddit' => array(), // http://www.reddit.com/submit?url=[URL]&title=[TITLE]
		'stumbleupon' => array(), //http://www.stumbleupon.com/submit?url=[URL]&title=[TITLE]
		'posterous' => array(), // http://posterous.com/share?linkto=[URL]

		'delicious' => array(), // http://del.icio.us/post?url=[URL]&title=[TITLE]&notes=[DESCRIPTION]
		'newsvine' => array(), // http://www.newsvine.com/_tools/seed&save?u=[URL]&h=[TITLE]
		'evernote' => array(), // http://www.evernote.com/clip.action?url=[URL]&title=[TITLE]
		'friendfeed' => array(), // http://www.friendfeed.com/share?url=[URL]&title=[TITLE]

		// Google Bookmarks // http://www.google.com/bookmarks/mark?op=edit&bkmk=[URL]&title=[title]&annotation=[DESCRIPTION]
		// Ping.fm // http://ping.fm/ref/?link=[URL]&title=[TITLE]&body=[DESCRIPTION]
		// Evernote // http://www.evernote.com/clip.action?url=[URL]&title=[TITLE]
		// 'instagram' => array(),
		//'github' => array(),
		//'gitlab' => array(),

		// source: http://petragregorova.com/articles/social-share-buttons-with-custom-icons/

		);

}
add_action( 'init', 'onepiece_global_share_entities' ); // add early in flow













/*
 *
 * Create the widget (onepiece theme)
 *
 */

class onepiece_share_widget extends WP_Widget {

	public function __construct() {
	    // basic wp stuff for widget id
		$widget_options = array(
		  'classname' => 'onepiece_share_widget',
		  'description' => 'This is an Example Widget',
		);

		parent::__construct( 'onepiece_share_widget', 'Onepiece Share Widget', $widget_options );

	}


	/**
	 * Frontend widget
	 */

	public function widget( $args, $instance ) {

	  	// Default widget title
	  	$title = apply_filters( 'widget_title', $instance[ 'title' ] );

		// Default settings
		$icos = 24;							// Default iconsize for sharebutton
		$sttl = get_bloginfo( 'title' );		// Default title to share
		$stxt = get_bloginfo( 'description' );	// Default text to share
		$surl = site_url();						// Default url to share

		// Default media to share
		$simg = get_theme_mod('onepiece_identity_featured_image');

		// overwrite defaults with widget settings
		if( !empty($instance[ 'share_title' ]) ){
			$sttl = $instance[ 'share_title' ];
		}
		if( !empty($instance[ 'share_text' ]) ){
			$stxt = $instance[ 'share_text' ];
		}
		if( !empty($instance[ 'share_url' ]) ){
			$surl = $instance[ 'share_url' ];
		}
		if( !empty($instance[ 'share_image' ]) ){
			$simg = $instance[ 'share_image' ];
		}
		if( !empty($instance[ 'icon_size' ]) || $instance[ 'icon_size' ] == 0 ){
			$icos = $instance[ 'icon_size' ];
		}

		// get share data
		$entities = $GLOBALS['onepiece_share_entities'];
	  	$select_entities = $instance['select_entities'];

		// prepare share bundle
		$select_entities_data = array();
	  	foreach( $select_entities as $id ){
		  	$select_entities_data[$id] = $entities[$id];
	  	}

	  	// output frontend html
	  	echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

	  	echo '<ul>';

		// button list
	  	$entities_html = array();
		foreach( $select_entities_data as $id => $entity ){

			// button html (text or img)
			$button = $entity['company']['name'];
			if(isset($entity['share']['l_icon']) && $icos != 0){
				$button = '<webicon style="display:block;max-width:'.$icos.'px;max-height:'.$icos.'px;" icon="'.$entity['share']['l_icon'].'"/>';
				//$button = '<img src="'.$entity['share']['l_icon'].'" name="Share on '.$entity['share']['l_name'].'" />';
			}

			// url string part 1: specific sharer url
			$urlstr = $entity['share']['l_url'].$entity['share']['s_url'].$surl;

			// url string part 2: share title and/or text
			if( isset($entity['share']['s_ttl']) && isset($entity['share']['s_txt'])){ // title & text

				$urlstr .='&'.$entity['share']['s_ttl'].$sttl.'&'.$entity['share']['s_txt'].$stxt;

			}else if( isset($entity['share']['s_ttl']) && !isset($entity['share']['s_txt']) ){ // description

				$urlstr .='&'.$entity['share']['s_ttl'].$sttl;

			}else if( isset($entity['share']['s_txt']) ){ // description

				if(!isset($entity['share']['s_ttl']))
					$stxt = $sttl.' - '.$stxt;
				if(!isset($entity['share']['s_url']))
					$stxt = $stxt.' - '.$s_url;

				$urlstr .='&'.$entity['share']['s_txt'].$stxt;

			}

			// url string part 3: share media
			if(isset($entity['share']['s_img'])){
				$urlstr .='&'.$entity['share']['s_img'].'{'.$simg.'}';
			}

			// url string part 4: shared from/via
			if(isset($entity['share']['s_via'])){
				$urlstr .='&'.$entity['share']['s_via'].get_bloginfo( 'name' );
			}

			// html add full data-action attribute like 'share/whatsapp/share' for whats app
			$data_attr = '';
			if(isset($entity['share']['l_attr'])){
				// data-action attribute like 'share/whatsapp/share' for whats app
				$data_attr = ' '.$entity['share']['l_attr']; //' data-action="share/whatsapp/share"';
			}

			// create & output html
			echo '<li style="display:inline-block;"><a href="'.$urlstr.'" title="Share on '.$entity['company']['name'].'" target="_blank"'.$data_attr.'><span>'.$button.'</span></a></li>';

		}
		echo '<ul>';

	  	echo $args['after_widget'];
	}









	/**
	 * Backend widget
	 */

	public function form( $instance ) {

		// initialize widget instance variables
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'select_entities' => '' ));

		// collect variables for backend form output
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		// widget settings
		$icos = 24;							// Default iconsize for sharebutton
		$sttl = get_bloginfo( 'title' );		// Default title to share
		$stxt = get_bloginfo( 'description' );	// Default text to share
		$surl = site_url();						// Default url to share
		$simg = get_theme_mod('onepiece_identity_featured_image'); // Default media to share


		if( !empty($instance[ 'share_title' ]) ){
			$sttl = $instance[ 'share_title' ];
		}
		if( !empty($instance[ 'share_text' ]) ){
			$stxt = $instance[ 'share_text' ];
		}
		if( !empty($instance[ 'share_url' ]) ){
			$surl = $instance[ 'share_url' ];
		}
		if( !empty($instance[ 'share_image' ]) ){
			$simg = $instance[ 'share_image' ];
		}
		if( !empty($instance[ 'icon_size' ]) || $instance[ 'icon_size' ] == 0 ){
			$icos = $instance[ 'icon_size' ];
		}



		$entities = $GLOBALS['onepiece_share_entities'];
		$select_entities = (array)$instance['select_entities'];

		// output backend form
		?>
	    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	    </p>

		<p><label for="<?php echo $this->get_field_id( 'share_title' ); ?>">Share Title:</label>
		<input type="text" id="<?php echo $this->get_field_id( 'share_title' ); ?>" name="<?php echo $this->get_field_name( 'share_title' ); ?>" value="<?php echo esc_attr( $sttl ); ?>" />
	    </p>

		<p><label for="<?php echo $this->get_field_id( 'share_text' ); ?>">Share Text:</label>
			<textarea id="<?php echo $this->get_field_id( 'share_text' ); ?>" name="<?php echo $this->get_field_name( 'share_text' ); ?>"><?php echo esc_attr( $stxt ); ?></textarea>
	    </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'share_image' ); ?>">Share Image:</label>
            <input name="<?php echo $this->get_field_name( 'share_image' ); ?>" id="<?php echo $this->get_field_id( 'share_image' ); ?>" class="upload_share_image widefat" type="text" size="36"  value="<?php echo esc_url( $simg ); ?>" />
            <input class="upload_image_button button button-primary" type="button" value="Upload Image" />
        </p>

		<p><label for="<?php echo $this->get_field_id( 'share_url' ); ?>">Share url:</label>
			<textarea id="<?php echo $this->get_field_id( 'share_url' ); ?>" name="<?php echo $this->get_field_name( 'share_url' ); ?>"><?php echo esc_attr( $surl ); ?></textarea>
	    </p>

		<p><label for="<?php echo $this->get_field_id( 'icon_size' ); ?>">Button icon display:</label>
			<select id="<?php echo $this->get_field_id( 'icon_size' ); ?>" name="<?php echo $this->get_field_name( 'icon_size' ); ?>">
				<option value="0" <?php if($icos == 0) echo 'selected="selected"'; ?>>No icon, text only</option>
				<option value="16" <?php if($icos == 16) echo 'selected="selected"'; ?>>16px</option>
				<option value="24" <?php if($icos == 24) echo 'selected="selected"'; ?>>24px</option>
				<option value="32" <?php if($icos == 32) echo 'selected="selected"'; ?>>32px</option>
				<option value="48" <?php if($icos == 48) echo 'selected="selected"'; ?>>48px</option>
			</select>
		</p>
		<?php

		$htmllist = '';

		// entity listing
		foreach($entities as $id => $entity) {
   			if( $entity['company']['name'] != '' && $entity['share']['l_url'] != ''){ // minimal property check
			?>
    			<label>
					<?php echo $entity['company']['name']; ?>
					<input id="<?php echo $this->get_field_id( 'select_entities' ) . $id; ?>"
						name="<?php echo $this->get_field_name('select_entities'); ?>[]"
						type="checkbox" value="<?php echo $id; ?>"
						<?php foreach ( $select_entities as $checked ) { checked( $checked, $id, true ); } ?>>
				</label><br>
			<?php
			}
        }

	}




	/**
	 * Update widget
	 */

	public function update( $new_instance, $old_instance ) {

	  	// save it
	  	$instance = $old_instance; // $instance = array();

	  	$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

		$instance[ 'share_title' ] = strip_tags( $new_instance[ 'share_title' ] );

		$instance[ 'share_text' ] = strip_tags( $new_instance[ 'share_text' ] );

		$instance[ 'share_url' ] = $new_instance[ 'share_url' ];

		$instance[ 'share_image' ] = $new_instance[ 'share_image' ];

		$instance[ 'icon_size' ] = $new_instance[ 'icon_size' ];

	  	$instance['select_entities'] = $new_instance['select_entities'];

		return $instance;

	}



}


// Register and load the widget
function onepiece_load_share_widget() {
	register_widget( 'onepiece_share_widget' );
}
add_action( 'widgets_init', 'onepiece_load_share_widget' );

// include webicon
function onepiece_load_share_widget_icons(){
wp_enqueue_script('jquery-webicon', '//cdn.rawgit.com/icons8/bower-webicon/v0.10.7/jquery-webicon.min.js');
}
add_action( 'wp_print_scripts', 'onepiece_load_share_widget_icons' );

// upload image scripts
function photo_upload_option($hook) {

    	if( $hook != 'widgets.php' )
        return; //not in widget admin

    	//enque Javasript Media API
		// sources
		// https://dzone.com/articles/add-upload-media-library), http://stackoverflow.com/questions/41438151/image-upload-in-custom-widget-wp
		// final solution -> http://www.divyanshiinfotech.com/add-wp-media-uploader-plugin/
		wp_enqueue_media();
    	wp_register_script( 'uploadphoto', get_template_directory_uri() . '/assets/upload-media.js', array('jquery'), '1.0', 'true' );
		wp_enqueue_script('uploadphoto');

}
add_action('admin_enqueue_scripts', 'photo_upload_option');

?>
