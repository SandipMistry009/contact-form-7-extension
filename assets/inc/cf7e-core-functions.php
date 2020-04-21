<?php 
/*
*
*	***** Contact Form 7 Extension *****
*
*	Core Functions
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
/*
*
* Custom Front End Ajax Scripts / Loads In WP Footer
*
*/

/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 
// check for plugin using plugin name
if (!is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
    
    add_action( 'admin_notices', function(){
        echo '<div id="message" class="error notice is-dismissible"><p>Contact Form 7 Extension Plugin require Contact Form 7 Plugin. Kindly installed the Contact Form 7 plugin.</b></p></div>';
    } );

} 


// Let’s instantiate this class in our functions.php file:

if( is_admin() ) {
    require 'simple_settings_page.php';
    new simple_settings_page();
}

add_filter('widget_text','do_shortcode');


add_action( 'wp_head', function () {

$cf7e_settings = get_option( 'cf7e_settings' );
$background_color = $cf7e_settings['cf7e_background_color'];
$submit_button_color = $cf7e_settings['cf7e_submit_button_color'];
$font_color = $cf7e_settings['cf7e_font_color'];
?>
    <style type="text/css">
    .widget .wpcf7{
        background:<?php echo $background_color; ?>;
    }
    .wpcf7-submit{
        background:<?php echo $submit_button_color; ?> !important;   
        color: <?php echo $font_color; ?> !important;
    }
    .widget .wpcf7 p label{
        color: <?php echo $font_color; ?>;
    }
    </style>
<?php });


