<?php

include_once(plugin_dir_path(__FILE__) . 'model/partyRepository.php');

function piratePartyShortcode($attributes) {
    $defaultAttributes = array(
        'id' => null,
        'show-logo' => true,
        'show-native-name' => true,
        'show-memberships' => true,
        'show-website' => true,
        'show-facebook' => false,
        'show-twitter' => true,
        'show-googleplus' => false,
        'show-youtube' => false
    );
    $attributes = shortcode_atts($defaultAttributes, $attributes);

    $partyRepository = new PartyRepository();
    $party = $partyRepository->getParty($attributes['id']);

    if ($party === null) {
        return '<p>' . $attributes['id'] . ' ' . __('not found.', 'wp-pirate-parties') . '</p>';
    }

    ob_start();
    include(plugin_dir_path(__FILE__) . 'view/shortcode.php');
    return ob_get_clean();
}

add_shortcode('pirate-party', 'piratePartyShortcode');
