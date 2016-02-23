<?php

include_once(plugin_dir_path(__FILE__) . 'model/partyRepository.php');

/**
 * Class Wp_Pirate_Parties
 */
class Wp_Pirate_Parties_List_Widget extends WP_Widget {
    private $linkTexts = [];

    private $links = [];

    function Wp_Pirate_Parties_List_Widget() {
        parent::__construct(false, $name = __('Pirate Parties List', 'wp-pirate-parties'));

        $this->linkTexts = array(
            'en' => __('Party name in english', 'wp-pirate-parties'),
            'native' => __('Party name in native languages', 'wp-pirate-parties'),
            'code' => __('Party Code', 'wp-pirate-parties'),
            'country' => __('Country Name', 'wp-pirate-parties'),
            'country_code' => __('Country Code', 'wp-pirate-parties'),
            'link' => __('Link dependent', 'wp-pirate-parties')
        );

        $this->links = array(
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
            'liquidfeedback' => 'LiquidFeedback',
            'contactGeneralEmail' => __('Contact generel E-Mail', 'wp-pirate-parties')
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
        $showFlags = '';
        $linkText = '';
        $link = '';
        $displayOption = '';
        $hideNoLink = '';
        $ppiFilter = '';
        $ppeuFilter = '';
        if($instance) {
            $title = esc_attr($instance['title']);
            $text = esc_attr($instance['text']);
            $showFlags = esc_attr($instance['showFlags']);
            $linkText = esc_attr($instance['linkText']);
            $link = esc_attr($instance['link']);
            $displayOption = esc_attr($instance['displayOption']);
            $hideNoLink = esc_attr($instance['hideNoLink']);
            $ppiFilter = esc_attr($instance['ppiFilter']);
            $ppeuFilter = esc_attr($instance['ppeuFilter']);
        }

        ob_start();
        include(plugin_dir_path(__FILE__) . 'view/listWidgetForm.php');
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
        $instance['showFlags'] = strip_tags($new_instance['showFlags']);
        $instance['linkText'] = strip_tags($new_instance['linkText']);
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['displayOption'] = strip_tags($new_instance['displayOption']);
        $instance['hideNoLink'] = strip_tags($new_instance['hideNoLink']);
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
        $showFlags = $instance['showFlags'];
        $linkText = $instance['linkText'];
        $link = $instance['link'];
        $displayOption = $instance['displayOption'];
        $hideNoLink = $instance['hideNoLink'];
        $ppiFilter = $instance['ppiFilter'];
        $ppeuFilter = $instance['ppeuFilter'];

        $partyRepository = new PartyRepository();
        $parties = $partyRepository->getParties($ppiFilter, $ppeuFilter, $linkText);

        ob_start();
        include(plugin_dir_path(__FILE__) . 'view/listWidget.php');
        $output = ob_get_clean();
        echo $output;
    }

}

// register widget
add_action('widgets_init', function() {
    register_widget('Wp_Pirate_Parties_List_Widget');
});
