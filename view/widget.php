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
?>

    </ul>
</div>
<?php echo $after_widget; ?>
