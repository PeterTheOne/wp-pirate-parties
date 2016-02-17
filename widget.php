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

        ob_start();
        include('view/widgetForm.php');
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
        include('view/widget.php');
        $output = ob_get_clean();
        echo $output;
    }

}

// register widget
add_action('widgets_init', function() {
    register_widget('Wp_Pirate_Parties_Widget');
});
