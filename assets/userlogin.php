<?php
/** Custom Login/Register/Password 
 * source https://digwp.com/2010/12/login-register-password-code/ 
 */

function display_userpanel(){



echo '<div id="userpanel">';


global $user_ID, $user_identity; wp_get_current_user(); //get_currentuserinfo(); 
// MU switch_to_blog( 1 );
$regallowed = get_option( 'users_can_register' );


if (!$user_ID) { // is not logged in
		
		if( get_theme_mod('onepiece_elements_loginbar_iconhtml','') != ''){
			echo '<div class="loginboxicon">'.get_theme_mod('onepiece_elements_loginbar_iconhtml','<webicon icon="wpf:user-shield"/>').'</div>';
		}

		echo '<ul class="tabmenu"><li class="signintab"><span >'.__( 'Sign in', 'onepiece' ).'</span></li>';
		if ( $regallowed ) {
		echo '<li class="registertab"><span >'.__( 'Register', 'onepiece' ).'</span></li>';
		}
		echo '</ul>';
		
		echo '<ul class="tabcontainer"><li class="tab1 tab">';

		global $user_login; 
		global $user_email;
		global $register;
		global $reset;
		if ($regallowed && isset(  $_GET['register'] )) { $register = $_GET['register']; } 

		if (isset(  $_GET['reset'] )) { $ $reset = $_GET['reset'];} 


		if ($register == true && $regallowed) { 
		
			// registered with succes
			echo '<h3>'.__( 'Success!', 'onepiece' ).'</h3>'; 
			echo '<p>'.__( 'Check your email for the password and use it to sign in', 'onepiece').'</p>';
			
		}else if($reset == true) {  
		
			//  request reset mail send
			echo '<h3>Success!</h3><p>Check your email to reset your password.</p>';
			
		}else{ 
		
			// show login elements
			echo '<h3>'.__( 'Sign in', 'onepiece' ).'</h3>'; 
		} 
		
		// display login form
		wp_login_form();
		
		echo '<div class="resetlogin"><span>'.__( 'Forgot password?', 'onepiece' ).'</span></div>';
		
		do_action('login_form', 'login'); 

		/*
		 *	Check login/user plugins
		 * echo do_shortcode( '' );
		 */
		echo '</li>';

		if ( $regallowed ) {
		echo '<li class="tab2 tab">';
		echo '<h3>'.__( 'Register', 'onepiece' ).'</h3>'; 
		echo '<p>'.__( 'Sign up', 'onepiece' ).'</p>';
?>

		
			<form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
			<div class="username">
			<label for="user_login"><?php __('Username', 'onepiece' ); ?>: </label>
			<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" />
			</div>
			<div class="password">
			<label for="user_email"><?php _e('Your Email', 'onepiece' ); ?>: </label>
			<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" />
			</div>
			<div class="login_fields">
			<input type="submit" name="user-submit" value="<?php _e('Sign up', 'onepiece' ); ?>" class="user-submit" tabindex="103" />
			<?php do_action('register_form'); ?>
			<?php if (isset(  $_GET['register'] )) { $register = $_GET['register']; } if($register == true) { echo '<p>'.__( 'Check your email for the password!', 'onepiece' ).'</p>'; } ?>
			<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?register=true" />
			<input type="hidden" name="user-cookie" value="1" />
			</div>
			</form>
            
		</li>
		<?php } ?>
		<li class="tab3 tab">

			<?php
			echo '<h3>'.__( 'Reset password', 'onepiece' ).'</h3>';
			echo '<p>'.__( 'Reset your password. You\'ll receive an email with link to the reset form.', 'onepiece').'</p>';
			?>
            
			<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
			<div class="username">
			<label for="user_login" class="hide"><?php _e('Username or Email', 'onepiece' ); ?>: </label>
			<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
			</div>
			<div class="login_fields">
			<input type="submit" name="user-submit" value="<?php _e('Reset my password', 'onepiece' ); ?>" class="user-submit" tabindex="1002" />
			<?php do_action('login_form', 'resetpass'); ?>					
			<?php if (isset(  $_GET['reset'] )) { $reset = $_GET['reset']; } if($reset == true) { echo '<p>'.__( 'Check your mailbox for a link to the password reset form.', 'onepiece' ).'</p>'; } ?>
			<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
			<input type="hidden" name="user-cookie" value="1" />
			</div>
			</form>
</li>
</ul>

<?php } else { // is logged in 


			global $userdata; 
			wp_get_current_user(); 


			if( get_theme_mod('onepiece_elements_loginbar_usericonhtml','') != ''){
				echo '<div class="userboxicon">'.get_theme_mod('onepiece_elements_loginbar_usericonhtml','<webicon icon="wpf:collaborator"/>').'</div>';
			}
			
			echo '<div class="infocontainer">';


			echo '<div class="usericon">';
			echo get_avatar($userdata->ID, 46);
			echo '</div>';

			echo '<div class="userinfo">';
			echo '<div class="loggedtext"><span><strong>'. $user_identity .'</strong></span></div>';
		
		
		 
		
		echo '<div class="loginmenubar"><ul class="menu">';
 
		/*
		$page1 = get_page_by_name('user-info');
		$page2 = get_page_by_name('user-profile');
		
		if (!empty($page1) && current_user_can('manage_options') ) {
		// link to profile
		echo '<li class="menu-item"><a href="'.get_bloginfo('siteurl').'/user-info">' . __('Info', 'fndtn' ) . '</a></li>';
		} 
		if (!empty($page2)) {
		// link to profile
		echo '<li class="menu-item"><a href="'.get_bloginfo('siteurl').'/user-profile">' . __('Profile', 'fndtn' ) . '</a></li>';
		} 
		
		if (current_user_can('manage_options')) { 
		echo '<li class="menu-item"><a href="' . admin_url() . '">' . __('Admin', 'fndtn' ) . '</a></li>';
		} 
		*/
		
		echo '<li class="menu-item"><a class="logout-link" href="'.wp_logout_url( 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] ).'" title="Sign off"><span>'.__('Sign off', 'onepiece').'</span></a></li>';

		echo '</ul></div>';

		if ( has_nav_menu( 'usermenu' ) ) { 
		echo '<div class="usermenubar">';
		wp_nav_menu( array( 'theme_location' => 'usermenu' ) ); 
		echo '<div class="clr"></div></div>';
		}
			
		echo '</div></div>';
} 
echo '</div>';
} // end userpanel 
?>
