<?php

include_once(plugin_dir_path(__FILE__) . 'model/partyRepository.php');

/**
 * Class Wp_Pirate_Parties
 */
class Wp_Pirate_Parties_Widget extends WP_Widget {
    private $displayOptions = [];

    private $linkOptions = [];

    function Wp_Pirate_Parties_Widget() {
        parent::__construct(false, $name = __('Wp Pirate Parties', 'wp-pirate-parties'));

        $this->displayOptions = array(
            'en' => __('Party name in english', 'wp-pirate-parties'),
            'code' => __('Party Code', 'wp-pirate-parties'),
            'native' => __('Party name in native languages', 'wp-pirate-parties'),
            'country' => __('Country Name', 'wp-pirate-parties')
        );

        $this->linkOptions = array(
            'website' => __('Website', 'wp-pirate-parties'),
            'papi' => 'Papi',
            'no' => __('No Link', 'wp-pirate-parties'),
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'googlePlus' => 'Google+',
            'youtube' => 'Youtube',
            'irc' => 'IRC',
            'wiki' => 'Wiki',
            'forum' => 'Forum',
            'liquidfeedback' => 'LiquidFeedback'
        );
    }

    /**
     * @param array $instance
     * @return bool
     */
    function form($instance) {
        // todo: use wp_parse_args?
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

        ob_start();
        include(plugin_dir_path(__FILE__) . 'view/widgetForm.php');
        $output = ob_get_clean();
        echo $output;

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
        $instance['text'] = $new_instance['text'];
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

        $partyRepository = new PartyRepository();
        $parties = $partyRepository->getParties($ppiFilter, $ppeuFilter, $displayOption);

        ob_start();
        include(plugin_dir_path(__FILE__) . 'view/widget.php');
        $output = ob_get_clean();
        echo $output;
    }

}

// register widget
add_action('widgets_init', function() {
    register_widget('Wp_Pirate_Parties_Widget');
});
