<?php
/*
Plugin Name: WP Feedback Skin
Plugin URI: https://github.com/Dilden/WP-Feedback-Skin
Description: This WordPress plugin is a skin of the <a target="_blank" title="ivoviz/feedback" href="https://github.com/ivoviz/feedback">ivoviz/feedback</a> JS plugin. It is intended to be a simpler solution to getting feedback from WordPress site user to the site admin.
Version: 0.0.1
Author: Dylan Hildenbrand
Author URI: http://closingtags.com/
License: GPL2


Copyright 2015 Dylan Hildenbrand  (email : dylan.hildenbrand@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    class WPFeedbackSkin {

    }

    function wpfeedbackskin_menu() {
        add_options_page( 
            'WP Feedback Skin Options', 
            'WP Feedback Skin', 
            'manage_options', 
            'wp-feedback-skin-options-menu', 
            'wpfeedbackskin_options' 
        );
    }

    function wpfeedbackskin_options() {
        if ( !current_user_can( 'manage_options' ) )  {
          wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        echo "<div class='wrap'>
            <h2>WP Feedback Skin Settings</h2>
                <form action='options.php' method='post'>";

            settings_fields('wpfeedbackskin_set_group');
            do_settings_sections('wpfeedbackskin-settings');

            echo "<p class='submit'>
                    <input type='submit' class='button button-primary' value='Save Changes'>
                </p>
            </form>
        </div>";
    }

    function wpfeedbackskin_main_settings_output() {
        echo "<p>Standard settings</p>";

    }

    // function wpfeedbackskin_adv_settings_output() {
    //     echo "<p>These settings should only be changed if you know what you are doing. Only recommended for advanced users!</p>";
    // }

    function wpfeedbackskin_display_inputs() {
        $options = get_option('wpfeedbackskin_options');
        echo "<input id='plugin_text_string' name='wpfeedbackskin_options[text_string]' size='40' type='text' value='{$options['text_string']}' />";
    }

    function wpfeedbackskin_menu_register_settings() { // whitelist options
        register_setting( 'wpfeedbackskin_set_group', 'wpfeedbackskin_options' );
      add_settings_section('wpfeedbackskin_main_settings', 'Standard Settings', 'wpfeedbackskin_main_settings_output', 'wpfeedbackskin-settings');
      add_settings_field('wpfeedbackskin_ajaxURL', 'Ajax URL', 'wpfeedbackskin_display_inputs', 'wpfeedbackskin-settings', 'wpfeedbackskin_main_settings');

      // add_settings_section('wpfeedbackskin_adv_settings', 'Advanced Settings', 'wpfeedbackskin_adv_settings_output', 'wpfeedbackskin-settings');  
    }

    if ( is_admin() ){ // admin actions
      add_action( 'admin_menu', 'wpfeedbackskin_menu' );
      add_action( 'admin_init', 'wpfeedbackskin_menu_register_settings' );
    }

?>