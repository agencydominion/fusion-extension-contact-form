<?php
/**
 * @package Fusion_Extension_Contact_Form
 */
/**
 * Plugin Name: Fusion : Extension - Contact Form
 * Plugin URI: http://www.agencydominion.com/fusion/
 * Description: Contact Form Extension Package for Fusion.
 * Version: 1.1.3
 * Author: Agency Dominion
 * Author URI: http://agencydominion.com
 * License: GPL2
 */
 
/**
 * FusionExtensionContactForm class.
 *
 * Class for initializing an instance of the Fusion Contact Form Extension.
 *
 * @since 1.0.0
 */


class FusionExtensionContactForm	{ 
	public function __construct() {
						
		// Initialize the language files
		load_plugin_textdomain( 'fusion-extension-contact-form', false, plugin_dir_url( __FILE__ ) . 'languages' );
		
	}
}

$fsn_extension_contact_form = new FusionExtensionContactForm();

//EXTENSIONS

//contact form
require_once('includes/extensions/contact-form.php');

?>