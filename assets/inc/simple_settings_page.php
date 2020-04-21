<?php 
/* ----------------------------------------------------------------------------
 * Create WordPress settings page For custom options
 * ------------------------------------------------------------------------- */

// wp-content/themes/your-theme/simple_settings_page.php

class simple_settings_page {
	/**
	 * Array of custom settings/options
	**/
	private $options;

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add settings page
	 * The page will appear in Admin menu
	 */
	public function add_settings_page() {
		add_submenu_page(
        'wpcf7',
        'Settings',
        'Settings',
        'manage_options',
        'my-custom-submenu-page',
        array($this,'create_admin_page') );
}

	/**
	 * Options page callback
	 */
	public function create_admin_page() {
		// Set class property
		$this->options = get_option( 'cf7e_settings' );
		?>
		<div class="wrap">
			<h2>Contact Form 7 Settings</h2>           
			<form method="post" action="options.php">
			<?php
				// This prints out all hidden setting fields
				settings_fields( 'custom_settings_group' );   
				do_settings_sections( 'custom-settings-page' );
				submit_button(); 
			?>
			</form>
		</div>
	<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init() {
		register_setting(
			'custom_settings_group', // Option group
			'cf7e_settings', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'custom_settings_section', // ID
			'', // Title
			array( $this, 'custom_settings_section' ), // Callback
			'custom-settings-page' // Page
		);

		add_settings_field(
			'cf7e_background_color', // ID
			'Background Color', // Title 
			array( $this, 'cf7e_background_color_html' ), // Callback
			'custom-settings-page', // Page         
			'custom_settings_section'
		);

		add_settings_field(
			'cf7e_submit_button_color', 
			'Submit Button Color', 
			array( $this, 'cf7e_submit_button_color_html' ), 
			'custom-settings-page',
			'custom_settings_section'
		);

		add_settings_field(
			'cf7e_font_color', 
			'Font Color', 
			array( $this, 'cf7e_font_color_html' ), 
			'custom-settings-page',
			'custom_settings_section'
		);

		// add_settings_field( 
		// 	'cf7e_custom_css', 
		// 	'Custom CSS', 
		// 	array( $this, 'cf7e_custom_css_html' ), 
		// 	'custom-settings-page',
		// 	'custom_settings_section'
		// );
	}

	/**
	 * Sanitize POST data from custom settings form
	 *
	 * @param array $input Contains custom settings which are passed when saving the form
	 */
	public function sanitize( $input ) {
		$sanitized_input= array();
		if( isset( $input['cf7e_background_color'] ) )
			$sanitized_input['cf7e_background_color'] = sanitize_text_field( $input['cf7e_background_color'] );

		if( isset( $input['cf7e_submit_button_color'] ) )
			$sanitized_input['cf7e_submit_button_color'] = sanitize_text_field( $input['cf7e_submit_button_color'] );

		if( isset( $input['cf7e_font_color'] ) )
			$sanitized_input['cf7e_font_color'] = sanitize_text_field( $input['cf7e_font_color'] );

		return $sanitized_input;
	}

	/** 
	 * Custom settings section text
	 */
	public function custom_settings_section() {
		//print('Some text');
	}

	public function cf7e_background_color_html() {
		printf(
			'<input type="color" id="cf7e_background_color" name="cf7e_settings[cf7e_background_color]" value="%s" />',
			isset( $this->options['cf7e_background_color'] ) ? esc_attr( $this->options['cf7e_background_color']) : ''
		);
	}

	public function cf7e_submit_button_color_html() {
		printf(
			'<input type="color" id="cf7e_submit_button_color" name="cf7e_settings[cf7e_submit_button_color]" value="%s" />',
			isset( $this->options['cf7e_submit_button_color'] ) ? esc_attr( $this->options['cf7e_submit_button_color']) : ''
		);
	}

	public function cf7e_font_color_html() {
		printf(
			'<input type="color" id="cf7e_font_color" name="cf7e_settings[cf7e_font_color]" value="%s" />',
			isset( $this->options['cf7e_font_color'] ) ? esc_attr( $this->options['cf7e_font_color']) : ''
		);
	}

	public function cf7e_custom_css_html($args) {
		$options = get_option( 'cf7e_settings', array() );
	    $content = isset( $options['cf7e_custom_css'] ) ?  $options['cf7e_custom_css'] : false;
	    wp_editor( $content, 'cf7e_custom_css', array( 
	        'textarea_name' => 'cf7e_settings[cf7e_custom_css]',
	        'media_buttons' => false,
	        'editor_css ' => '',
	        'tinymce' => true,
	        'teeny' => true
	    ) );
	}

}