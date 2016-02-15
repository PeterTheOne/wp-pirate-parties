<?php


include_once('model/parties.php');

/**
 * Class Wp_Pirate_Parties
 */
class Wp_Pirate_Parties_Widget extends WP_Widget {
    private $displayOptions = array(
        'en' => 'Party Name in English',
        'native' => 'Party Name in Native Language',
        'country' => 'Country Name'
    );

    private $linkOptions = array(
        'website' => 'Website',
        'no' => 'No Link',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'googlePlus' => 'Google+',
        'youtube' => 'Youtube'
    );

    function Wp_Pirate_Parties_Widget() {
        parent::__construct(false, $name = __('Wp Pirate Parties', 'Wp_Pirate_Parties'));
    }

    /**
     * @param array $instance
     * @return bool
     */
    function form($instance) {
        $title = '';
        $text = '';
        $displayOption = '';
        $linkOption = '';
        $ppiFilter = '';
        $ppeuFilter = '';
        if($instance) {
            $title = esc_attr($instance['title']);
            $text = esc_attr($instance['text']);
            $displayOption = esc_attr($instance['displayOption']);
            $linkOption = esc_attr($instance['linkOption']);
            $ppiFilter = esc_attr($instance['ppiFilter']);
            $ppeuFilter = esc_attr($instance['ppeuFilter']);
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
            <label for="<?php echo $this->get_field_id('linkOption'); ?>"><?php _e('Link', 'wp_widget_plugin'); ?></label>
            <select name="<?php echo $this->get_field_name('linkOption'); ?>" id="<?php echo $this->get_field_id('linkOption'); ?>" class="widefat">
                <?php
                foreach ($this->linkOptions as $key => $option) {
                    echo '<option value="' . $key . '" ', $linkOption == $key ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                ?>
            </select>
        </p>

        <p>
            <input id="<?php echo $this->get_field_id('ppiFilter'); ?>" name="<?php echo $this->get_field_name('ppiFilter'); ?>" type="checkbox" value="1" <?php checked( '1', $ppiFilter ); ?> />
            <label for="<?php echo $this->get_field_id('ppiFilter'); ?>"><?php _e('Only show PPI Members', 'wp_widget_plugin'); ?></label>
        </p>

        <p>
            <input id="<?php echo $this->get_field_id('ppeuFilter'); ?>" name="<?php echo $this->get_field_name('ppeuFilter'); ?>" type="checkbox" value="1" <?php checked( '1', $ppeuFilter ); ?> />
            <label for="<?php echo $this->get_field_id('ppeuFilter'); ?>"><?php _e('Only show PPEU Members', 'wp_widget_plugin'); ?></label>
        </p>
        <?php
        return true;
    }

    /**
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['text'] = strip_tags($new_instance['text']);
        $instance['displayOption'] = strip_tags($new_instance['displayOption']);
        $instance['linkOption'] = strip_tags($new_instance['linkOption']);
        $instance['ppiFilter'] = strip_tags($new_instance['ppiFilter']);
        $instance['ppeuFilter'] = strip_tags($new_instance['ppeuFilter']);
        return $instance;
    }

    /**
     * @param array $args
     * @param array $instance
     */
    function widget($args, $instance) {
        /**
         * @var $before_title
         * @var $after_title
         * @var $before_widget
         * @var $after_widget
         */
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $text = $instance['text'];

        $displayOption = $instance['displayOption'];
        $linkOption = $instance['linkOption'];
        $ppiFilter = $instance['ppiFilter'];
        $ppeuFilter = $instance['ppeuFilter'];

        $partiesModel = new Parties();
        $parties = $partiesModel->get($displayOption, $linkOption, $ppiFilter, $ppeuFilter);

        ob_start();
        include_once('view/widget.php');
        $output = ob_get_clean();

        echo $output;
    }

}

// register widget
add_action('widgets_init', function() {
    register_widget('Wp_Pirate_Parties_Widget');
});
