<?php echo $before_widget; ?>

<div class="widget-text wp_widget_plugin_box">

<?php

// Check if title is set
if ($title) {
    echo $before_title . $title . $after_title;
}

// Check if text is set
if($text) {
    echo '<p class="wp_widget_plugin_text">'.$text.'</p>';
}

?>

    <ul>

<?php
foreach ($parties as $party) {
    $partyLink = null;
    $partyText = null;
    switch ($displayOption) {
        case 'native':
            $country_code = strtolower($party->country_code);
            if (isset($party->name->{$country_code})) {
                $partyText = $party->name->{$country_code};
            } else {
                $partyText = $party->name->en;
            }
            break;
        case 'country':
            $partyText = $party->country_name;
            break;
        case 'en': default:
            $partyText = $party->name->en;
            break;
    }

    if ($linkOption === 'no') {
        echo '<li>'. $partyText . '</li>';
        continue;
    }

    switch ($linkOption) {
        case 'facebook':
            if (isset($party->social_networks->facebook->id)) {
                $facebookId = $party->social_networks->facebook->id;
                $partyLink = $facebookId ? '//facebook.com/' . $facebookId : null;
            }
            break;
        case 'twitter':
            if (isset($party->social_networks->twitter->username)) {
                $twitterId = $party->social_networks->twitter->username;
                $partyLink = $twitterId ? '//twitter.com/' . $twitterId : null;
            }
            break;
        case 'googlePlus':
            if (isset($party->social_networks->googlePlus)) {
                $googleId = $party->social_networks->googlePlus;
                $partyLink = $googleId ? '//plus.google.com/u/0/' . $googleId : null;
            }
            break;
        case 'youtube':
            if (isset($party->social_networks->youtube)) {
                $youtubeId = $party->social_networks->youtube;
                $partyLink = $youtubeId ? '//youtube.com/user/' . $youtubeId : null;
            }
            break;
        case 'papi':
            $partyLink = 'http://api.piratetimes.net/party/' . strtolower($party->code);
            break;
        case 'website': default:
            if (isset($party->websites->official)) {
                $partyLink = $party->websites->official;
            }
            break;
    }

    if (!$partyText) {
        continue;
    }
    if (!$partyLink) {
        echo '<li>'. $partyText . '</li>';
        continue;
    }
    echo '<li><a href="' . $partyLink . '">' . $partyText . '</a></li>';
}
?>

    </ul>
</div>
<?php echo $after_widget; ?>
