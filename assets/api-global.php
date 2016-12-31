/*
 *
 * Api Global functions / Class
 *
 */

// check available plugins (like wsl)

// check theme custom settings (if no plugin primairy)

/*
 *
 * Linkedin, Twitter, Facebook, Github, Google
 * (Pinterest, Instagram, Thumblr)
 *
 */

class apiMedia(){

	function apiMedia() {

		$providers = Array('linkedin', 'twitter', 'facebook', 'github', 'google');

		$this->configApiList( $providers )

	}

	public function configApiList( $providers ) {
		// list providers data from customizer
		// get_theme_mod('onepiece_media_panel_'.PROVIDERNAME.'_id');
		// get_theme_mod('onepiece_media_panel_'.PROVIDERNAME.'_api_id');
		// ea get_theme_mod('onepiece_media_panel_'.PROVIDERNAME.'_api_secret');

	foreach($providers as $provider){
		//if( !empty( get_theme_mod('onepiece_media_panel_'.$provider.'_id') ) ){
		//}
	}

	}
}

// prepare basic elements
