<?php

include_once(plugin_dir_path(__FILE__) . 'model/partyRepository.php');

/**
 * Class Wp_Pirate_Parties
 */
class Wp_Pirate_Parties_Weekly_Widget extends WP_Widget {

    function Wp_Pirate_Parties_Weekly_Widget() {
        parent::__construct(false, $name = __('Pirate Parties Weekly', 'wp-pirate-parties'));
    }

    /**
     * @param array $instance
     * @return bool
     */
    function form($instance) {
        // todo: use wp_parse_args?
        $title = '';
        $ppiFilter = '';
        $ppeuFilter = '';
        if($instance) {
            $title = esc_attr($instance['title']);
            $ppiFilter = esc_attr($instance['ppiFilter']);
            $ppeuFilter = esc_attr($instance['ppeuFilter']);
        }

        ob_start();
        include(plugin_dir_path(__FILE__) . 'view/weeklyWidgetForm.php');
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
        $ppiFilter = $instance['ppiFilter'];
        $ppeuFilter = $instance['ppeuFilter'];

        $partyRepository = new PartyRepository();
        $parties = $partyRepository->getParties($ppiFilter, $ppeuFilter, 'nameLength');

        $date = new DateTime();
        $number = ($date->format('Y') * $date->format('W')) % count($parties);
        echo $date->format('Y') . "\n";
        echo $date->format('W') . "\n";
        echo count($parties) . "\n";
        echo $number . "\n";

        $party = $parties[$number];

        ob_start();
        include(plugin_dir_path(__FILE__) . 'view/weeklyWidget.php');
        $output = ob_get_clean();
        echo $output;
    }

}

// register widget
add_action('widgets_init', function() {
    register_widget('Wp_Pirate_Parties_Weekly_Widget');
});
