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
        ?>
        <div class='wrap'>
            <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
            <h3 class="nav-tab-wrapper">
                <?php 
                    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'wpfeedback-bools';

                    // Add more tabs to options here
                    $tab_page_array = [
                        'wpfeedback-bools' => 'Boolean Options',
                        'wpfeedback-strings' => 'String Options',
                        'wpfeedback-funcs' => 'Custom Functions'
                        ];

                    // Show tabbed options pages
                    foreach ($tab_page_array as $tp_key => $tp_val) {?>
                        <a class="nav-tab <?php echo $active_tab == $tp_key ? 'nav-tab-active' : ''; ?>" href="?page=wp-feedback-skin-options-menu&tab=<?php echo $tp_key;?>" class="nav-tab"><?php echo $tp_val;?></a>
                        
                    <?php }
                ?>

            </h3>

            <form method="post" action='options.php' method='post'>

                <?php
                    if ($active_tab == 'wpfeedback-bools') {
                        ?>
                        <fieldset>
                            <label for="wpfeedbackskin_options-browserInfo">
                                <input type="checkbox" id="wpfeedbackskin_options-browserInfo" name="wpfeedbackskin_options[browserInfo]" value="1"/>
                                <span><?php esc_attr_e('Post Browser Info');?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-postUrl">
                                <input type="checkbox" id="wpfeedbackskin_options-postUrl" name="wpfeedbackskin_options[postUrl]" value="1"/>
                                <span><?php esc_attr_e('Post URL');?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-postHtml">
                                <input type="checkbox" id="wpfeedbackskin_options-postHtml" name="wpfeedbackskin_options[postHtml]" value="1"/>
                                <span><?php esc_attr_e('Post HTML');?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-letterRendering">
                                <input type="checkbox" id="wpfeedbackskin_options-letterRendering" name="wpfeedbackskin_options[letterRendering]" value="1"/>
                                <span><?php esc_attr_e('Letter Rendering');?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-screenshotStroke">
                                <input type="checkbox" id="wpfeedbackskin_options-screenshotStroke" name="wpfeedbackskin_options[screenshotStroke]" value="1"/>
                                <span><?php esc_attr_e('Screenshot Stroke');?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-highlightElement">
                                <input type="checkbox" id="wpfeedbackskin_options-highlightElement" name="wpfeedbackskin_options[highlightElement]" value="1"/>
                                <span><?php esc_attr_e('Highlight HTML Elements');?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-initialBox">
                                <input type="checkbox" id="wpfeedbackskin_options-initialBox" name="wpfeedbackskin_options[initialBox]" value="1"/>
                                <span><?php esc_attr_e('Describe bug before hightlight');?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-showDescriptionModal">
                                <input type="checkbox" id="wpfeedbackskin_options-showDescriptionModal" name="wpfeedbackskin_options[showDescriptionModal]" value="1"/>
                                <span><?php esc_attr_e('Show Description');?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-isDraggable">
                                <input type="checkbox" id="wpfeedbackskin_options-isDraggable" name="wpfeedbackskin_options[isDraggable]" value="1"/>
                                <span><?php esc_attr_e('Draggable');?></span>
                            </label>
                        </fieldset>
                        <?php
                    }
                    elseif ($active_tab == 'wpfeedback-strings') {
                        ?>
                        <fieldset>
                            <label for="wpfeedbackskin_options-ajaxUrl">
                                <div><?php esc_attr_e('Ajax URL');?></div>
                                <input type="text" id="wpfeedbackskin_options-ajaxUrl" name="wpfeedbackskin_options[ajaxUrl]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-html2CanvasUrl">
                                <div><?php esc_attr_e('HTML 2 Canvas URL');?></div>
                                <input type="text" id="wpfeedbackskin_options-html2CanvasUrl" name="wpfeedbackskin_options[html2CanvasUrl]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-initButtonText">
                                <div><?php esc_attr_e('Initial Button Text');?></div>
                                <input type="text" id="wpfeedbackskin_options-initButtonText" name="wpfeedbackskin_options[initButtonText]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-proxy">
                                <div><?php esc_attr_e('Proxy');?></div>
                                <input type="text" id="wpfeedbackskin_options-proxy" name="wpfeedbackskin_options[proxy]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-lineJoin">
                                <div><?php esc_attr_e('Line Join');?></div>
                                <input type="text" id="wpfeedbackskin_options-lineJoin" name="wpfeedbackskin_options[lineJoin]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-feedbackButton">
                                <div><?php esc_attr_e('Define a Custom button with a CSS class');?></div>
                                <input type="text" id="wpfeedbackskin_options-feedbackButton" name="wpfeedbackskin_options[feedbackButton]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-strokeStyle">
                                <div><?php esc_attr_e('Stroke Style');?></div>
                                <input type="text" id="wpfeedbackskin_options-strokeStyle" name="wpfeedbackskin_options[strokeStyle]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-shadowColor">
                                <div><?php esc_attr_e('Stroke Color');?></div>
                                <input type="text" id="wpfeedbackskin_options-shadowColor" name="wpfeedbackskin_options[shadowColor]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-shadowOffsetX">
                                <div><?php esc_attr_e('Shadow Offset X');?></div>
                                <input type="number" id="wpfeedbackskin_options-shadowOffsetX" name="wpfeedbackskin_options[shadowOffsetX]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-shadowOffsetY">
                                <div><?php esc_attr_e('Shadow Offset Y');?></div>
                                <input type="number" id="wpfeedbackskin_options-shadowOffsetY" name="wpfeedbackskin_options[shadowOffsetY]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-shadowBlur">
                                <div><?php esc_attr_e('Shadow Blur');?></div>
                                <input type="number" id="wpfeedbackskin_options-shadowBlur" name="wpfeedbackskin_options[shadowBlur]" value=""/>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-lineWidth">
                                <div><?php esc_attr_e('Line Width');?></div>
                                <input type="number" id="wpfeedbackskin_options-lineWidth" name="wpfeedbackskin_options[lineWidth]" value=""/>
                            </label>
                        </fieldset>
                        <?php
                    }
                    else {
                        ?>
                        <fieldset>
                            <label for="wpfeedbackskin_options-onClose">
                                <div><?php esc_attr_e('On Close (JS)');?></div>
                                <textarea id="wpfeedbackskin_options-onClose" name="wpfeedbackskin_options[onClose]" value="" rows="6" cols="60"></textarea>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="wpfeedbackskin_options-onScreenshotTaken">
                                <div><?php esc_attr_e('On Screenshot Taken (JS)');?></div>
                                <textarea type="textbox" id="wpfeedbackskin_options-onScreenshotTaken" name="wpfeedbackskin_options[onScreenshotTaken]" value="" rows="6" cols="60"></textarea>
                            </label>
                        </fieldset>

                        <?php
                    }
                ?>
                <p class='submit'>
                    <input type='submit' class='button button-primary' value='Save Changes'>
                </p>
            </form>
        </div>
        <?php
    }

    // function wpfeedbackskin_menu_register_settings() { // whitelist options
    //   register_setting( 'wpfeedbackskin_set_group', 'new_option_name' );
    // }

    if ( is_admin() ){ // admin actions
      add_action( 'admin_menu', 'wpfeedbackskin_menu' );
      // add_action( 'admin_init', 'wpfeedbackskin_menu_register_settings' );
    }

?>