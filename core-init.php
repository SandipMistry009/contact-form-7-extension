<?php 
/*
*
*	***** Contact Form 7 Extension *****
*
*	This file initializes all CF7E Core components
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
// Define Our Constants
define('CF7E_CORE_INC',dirname( __FILE__ ).'/assets/inc/');
define('CF7E_CORE_IMG',plugins_url( 'assets/img/', __FILE__ ));
define('CF7E_CORE_CSS',plugins_url( 'assets/css/', __FILE__ ));
define('CF7E_CORE_JS',plugins_url( 'assets/js/', __FILE__ ));
/*
*
*  Register CSS
*
*/
function cf7e_register_core_css(){
wp_enqueue_style('cf7e-core', CF7E_CORE_CSS . 'cf7e-core.css',null,time(),'all');
};
add_action( 'wp_enqueue_scripts', 'cf7e_register_core_css' );    
/*
*
*  Register JS/Jquery Ready
*
*/
function cf7e_register_core_js(){
// Register Core Plugin JS	
wp_enqueue_script('cf7e-core', CF7E_CORE_JS . 'cf7e-core.js','jquery',time(),true);
};
add_action( 'wp_enqueue_scripts', 'cf7e_register_core_js' );    
/*
*
*  Includes
*
*/ 
// Load the Functions
if ( file_exists( CF7E_CORE_INC . 'cf7e-core-functions.php' ) ) {
	require_once CF7E_CORE_INC . 'cf7e-core-functions.php';
}     
