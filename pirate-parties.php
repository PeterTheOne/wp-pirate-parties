<?php
/*
	Plugin Name: wp-pirate-parties
	Plugin URI: https://github.com/PeterTheOne/wp-pirate-parties
	Description: A wordpress plugin that displays pirate parties as a widget.
	Version: 0.1.0
	Author: Peter Grassberger
	Author URI: http://petergrassberger.com
	Text Domain: wp-pirate-parties
	Domain Path: /languages
	License: MIT
	License URI: http://opensource.org/licenses/MIT
*/

class Wp_Pirate_Parties extends WP_Widget
{
    private $apiUrl = 'http://api.piratetimes.net/api/v1/parties/';

    private $displayOptions = array(
        'en' => 'Party Name in English',
        'native' => 'Party Name in Native Language',
        'country' => 'Country'
    );

    private $linkOptions = array(
        'website' => 'Website',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'googlePlus' => 'Google+',
        'youtube' => 'Youtube'
    );

    function Wp_Pirate_Parties() {
        parent::WP_Widget(false, $name = __('Wp Pirate Parties', 'Wp_Pirate_Parties') );
    }

    function form($instance) {
        $title = '';
        $text = '';
        $displayOption = '';
        $linkOption = '';
        if($instance) {
            $title = esc_attr($instance['title']);
            $text = esc_attr($instance['text']);
            $displayOption = esc_attr($instance['displayOption']);
            $linkOption = esc_attr($instance['linkOption']);
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('displayOption'); ?>"><?php _e('Party Text', 'wp_widget_plugin'); ?></label>
            <select name="<?php echo $this->get_field_name('displayOption'); ?>" id="<?php echo $this->get_field_id('displayOption'); ?>" class="widefat">
                <?php
                foreach ($this->displayOptions as $key => $option) {
                    echo '<option value="' . $key . '" ', $displayOption == $key ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('linkOption'); ?>"><?php _e('Party Link', 'wp_widget_plugin'); ?></label>
            <select name="<?php echo $this->get_field_name('linkOption'); ?>" id="<?php echo $this->get_field_id('linkOption'); ?>" class="widefat">
                <?php
                foreach ($this->linkOptions as $key => $option) {
                    echo '<option value="' . $key . '" ', $linkOption == $key ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                ?>
            </select>
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['text'] = strip_tags($new_instance['text']);
        $instance['displayOption'] = strip_tags($new_instance['displayOption']);
        $instance['linkOption'] = strip_tags($new_instance['linkOption']);
        return $instance;
    }

    function widget($args, $instance) {
        $partiesContents = file_get_contents($this->apiUrl);
        if (!$partiesContents) {
            return;
        }
        $parties = json_decode($partiesContents);

        extract($args);

        // these are the widget options
        $title = apply_filters('widget_title', $instance['title']);
        $text = $instance['text'];
        $displayOption = $instance['displayOption'];
        $linkOption = $instance['linkOption'];

        echo $before_widget;
        // displayOption the widget
        echo '<div class="widget-text wp_widget_plugin_box">';

        // Check if title is set
        if ($title) {
            echo $before_title . $title . $after_title;
        }

        // Check if text is set
        if($text) {
            echo '<p class="wp_widget_plugin_text">'.$text.'</p>';
        }

        echo '<ul>';
        foreach ($parties as $party) {
            $partyLink = null;
            $partyText = null;
            switch ($displayOption) {
                case 'native':
                    $countryCode = $party->countryCode;
                    $partyText = $party->partyName->{$countryCode};
                    break;
                case 'country':
                    $partyText = $party->country;
                    break;
                case 'en': default:
                    $partyText = $party->partyName->en;
                    break;
            }

            switch ($linkOption) {
                case 'facebook':
                    $facebookId = $party->socialNetworks->facebook->id;
                    $partyLink = $facebookId ? '//www.facebook.com/' . $facebookId : null;
                    break;
                case 'twitter':
                    $twitterId = $party->socialNetworks->twitter->username;
                    $partyLink = $twitterId ? '//twitter.com/' . $twitterId : null;
                    break;
                case 'googlePlus':
                    $googleId = $party->socialNetworks->googlePlus;
                    $partyLink = $googleId ? '//plus.google.com/u/0/' . $googleId : null;
                    break;
                case 'youtube':
                    $youtubeId = $party->socialNetworks->youtube;
                    $partyLink = $youtubeId ? '//www.youtube.com/user/' . $youtubeId : null;
                    break;
                case 'website': default:
                    $partyLink = $party->websites->official;
                    break;
            }

            if (!$partyLink || !$partyText) {
                continue;
            }
            echo '<li>';
            echo '<a href="' . $partyLink . '">' . $partyText . '</a>';
            echo '</li>';
        }
        echo '</ul>';

        echo '</div>';
        echo $after_widget;
    }

}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("Wp_Pirate_Parties");'));
