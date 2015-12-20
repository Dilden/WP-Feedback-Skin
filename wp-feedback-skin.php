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
            <h2>WP Feedback Skin Settings</h2>".
            settings_fields( 'wpfeedbackskin_set_group' ).
            "<form action='options.php' method='post'>
                <table class='form-table'>
                    <tr>
                        <td><label for='ajaxUrl'>Ajax URL:</label>
                            <input type='text' id='ajaxurl'> 
                        </td>
                    </tr>
                    <tr>
                        <td><label for='html2CanvasUrl'>HTML 2 Canvas URL:</label>
                            <input type='text' id='html2CanvasUrl'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='initButtonText'>Initial Button Text:</label>
                            <input type='text' id='initButtonText'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='browserInfo'>Post Browser Info?</label>
                            <input type='checkbox' id='browserInfo'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='postHtml'>Post HTML?:</label>
                            <input type='checkbox' id='postHtml'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='postUrl'>Post URL?:</label>
                            <input type='checkbox' id='postUrl'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='proxy'>Proxy:</label>
                            <input type='text' id='proxy'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='letterRendering'>Letter Rendering?:</label>
                            <input type='checkbox' id='letterRendering'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='strokeStyle'>Stroke Style:</label>
                            <input type='text' id='strokeStyle'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='shadowColor'>Stroke Color:</label>
                            <input type='text' id='shadowColor'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='shadowOffsetX'>Shadow Offset X:</label>
                            <input type='number' id='shadowOffsetX'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='shadowOffsetY'>Shadow Offset Y:</label>
                            <input type='number' id='shadowOffsetY'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='shadowBlur'>Shadow Blur:</label>
                            <input type='number' id='shadowBlur'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='lineJoin'>Line Join:</label>
                            <input type='text' id='lineJoin'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='lineWidth'>Line Width:</label>
                            <input type='number' id='lineWidth'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='onClose'>On Close (JS):</label>
                            <input type='text' id='onClose'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='screenshotStroke'>Screenshot Stroke?</label>
                            <input type='checkbox' id='screenshotStroke'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='highlightElement'>Highlight HTML Elements?</label>
                            <input type='checkbox' id='highlightElement'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='initialBox'>Describe bug before hightlight?</label>
                            <input type='checkbox' id='initialBox'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='feedbackButton'>Define a Custom button with a CSS class:</label>
                            <input type='text' id='feedbackButton'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='showDescriptionModal'>Show Description?</label>
                            <input type='checkbox' id='showDescriptionModal'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='onScreenshotTaken'>On Screenshot Taken (JS):</label>
                            <input type='textbox' id='onScreenshotTaken'>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='isDraggable'>Draggable?</label>
                            <input type='checkbox' id='isDraggable'>
                        </td>
                    </tr>
                </table>
                <p class='submit'>
                    <input type='submit' class='button button-primary' value='Save Changes'>
                </p>
            </form>
        </div>";
    }

    function wpfeedbackskin_menu_register_settings() { // whitelist options
      register_setting( 'wpfeedbackskin_set_group', 'new_option_name' );
    }

    if ( is_admin() ){ // admin actions
      add_action( 'admin_menu', 'wpfeedbackskin_menu' );
      add_action( 'admin_init', 'wpfeedbackskin_menu_register_settings' );
    }

?>