<?php
/**
 * @package Fusion_Extension_Contact_Form
 */

/**
 * Contact Form Extension.
 *
 * Function for adding a Contact Form element to the Fusion Engine. Relies on Contact Form 7
 *
 * @since 1.0.0
 */

add_action('init', 'fsn_init_contact_form', 12);
function fsn_init_contact_form() {
	
	//OUTPUT SHORTCODE
	function fsn_contact_form_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'contact_form_id' => '',
			'form_class' => ''
		), $atts ) );
		
		$output = '';
		
		if (!empty($contact_form_id)) {
			$contact_form = get_post($contact_form_id);
			if (!empty($contact_form)) {
				$output .= '<div class="fsn-contact-form '. fsn_style_params_class($atts) .'">';
					$output .= do_shortcode('[contact-form-7 id="'. esc_attr($contact_form_id) .'" title="'. $contact_form->post_title .'"'. (!empty($form_class) ? ' html_class="'. $form_class .'"' : '') .']');
				$output .= '</div>';
			}
		}
		
		return $output;
		
	}
	add_shortcode('fsn_contact_form', 'fsn_contact_form_shortcode');
	
	//MAP SHORTCODE
	if (function_exists('fsn_map') && function_exists('wpcf7_contact_form')) {
		
		$contact_forms_array = array();
		$contact_forms_array[''] = 'Select form.';
		$contact_forms = fsn_get_post_ids_titles_by_type('wpcf7_contact_form');
		if (!empty($contact_forms)) {
			foreach($contact_forms as $contact_form) {
				$contact_forms_array[$contact_form['id']] = $contact_form['post_title'];
			}
		}
		
		fsn_map(array(
			'name' => __('Contact Form', 'fusion-extension-contact-form'),
			'shortcode_tag' => 'fsn_contact_form',
			'description' => __('Add Contact Form 7 Form. These can be customized under the "Contact" section listed in the Dashboard.', 'fusion-extension-contact-form'),
			'icon' => 'mail_outline',
			'params' => array(
				array(
					'type' => 'select',
					'options' => $contact_forms_array,
					'param_name' => 'contact_form_id',
					'label' => __('Contact Form', 'fusion-extension-contact-form')
				),
				array(
					'type' => 'text',
					'param_name' => 'form_class',
					'label' => __('Form Class', 'fusion-extension-contact-form'),
					'help' => __('Input CSS class for form element.', 'fusion-extension-contact-form'),
					'section' => 'advanced'
				)
			)
		));
	}
}
?>