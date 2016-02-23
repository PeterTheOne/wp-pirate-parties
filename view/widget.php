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

    <ul class="wp-pp-<?php echo $displayOption; ?>">

<?php
foreach ($parties as $party) {
    $partyLink = null;
    $partyText = null;
    switch ($linkText) {
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
        case 'code':
            $partyText = $party->code;
            break;
        case 'country_code':
            $partyText = $party->country_code;
            break;
        case 'en': default:
            $partyText = $party->name->en;
            break;
    }

    $flag = '';
    if ($showFlags) {
        $flag = '<span class="flag-icon flag-icon-' . $party->country_code . '"></span> ';
    }

    if ($link === 'no') {
        echo '<li>'. $flag . $partyText . '</li>';
        continue;
    }

    switch ($link) {
        case 'facebook':
            if (isset($party->social_networks->facebook->id)) {
                $facebookId = $party->social_networks->facebook->id;
                $partyLink = $facebookId ? '//facebook.com/' . $facebookId : null;
                if ($linkText === 'link') {
                    $facebookUsername = $party->social_networks->facebook->username;
                    $partyText = $facebookUsername ? 'facebook.com/' . $facebookUsername : null;
                }
            }
            break;
        case 'twitter':
            if (isset($party->social_networks->twitter->username)) {
                $twitterId = $party->social_networks->twitter->username;
                $partyLink = $twitterId ? '//twitter.com/' . $twitterId : null;
                if ($linkText === 'link') {
                    $partyText = $twitterId ? '@' . $twitterId : null;
                }
            }
            break;
        case 'googlePlus':
            if (isset($party->social_networks->googlePlus)) {
                $googleId = $party->social_networks->googlePlus;
                $partyLink = $googleId ? '//plus.google.com/u/0/' . $googleId : null;
                if ($linkText === 'link') {
                    $partyText = $googleId ? 'plus.google.com/u/0/' . $googleId : null;
                }
            }
            break;
        case 'youtube':
            if (isset($party->social_networks->youtube)) {
                $youtubeId = $party->social_networks->youtube;
                $partyLink = $youtubeId ? '//youtube.com/user/' . $youtubeId : null;
                if ($linkText === 'link') {
                    $partyText = $youtubeId ? 'youtube.com/user/' . $youtubeId : null;
                }
            }
            break;
        case 'papi':
            $partyLink = $party->code ? 'http://api.piratetimes.net/party/' . strtolower($party->code) : null;
            if ($linkText === 'link') {
                $partyText = $party->code ? 'api.piratetimes.net/party/' . strtolower($party->code) : null;
            }
            break;
        case 'irc':
            if (isset($party->social_networks->irc) &&
                    isset($party->social_networks->irc->ircServer) &&
                    isset($party->social_networks->irc->ircChannel)) {
                $ircServer = $party->social_networks->irc->ircServer;
                $ircChannel = $party->social_networks->irc->ircChannel;
                $partyLink = 'irc://' . $ircServer . '/' . $ircChannel;
                if ($linkText === 'link') {
                    $partyText = $partyLink;
                }
            }
            break;
        case 'wiki':
            if (isset($party->websites->wiki)) {
                $partyLink = $party->websites->wiki;
                if ($linkText === 'link') {
                    $partyText = $partyLink;
                }
            }
            break;
        case 'forum':
            if (isset($party->websites->forum)) {
                $partyLink = $party->websites->forum;
                if ($linkText === 'link') {
                    $partyText = $partyLink;
                }
            }
            break;
        case 'liquidfeedback':
            if (isset($party->websites->liquidfeedback)) {
                $partyLink = $party->websites->liquidfeedback;
                if ($linkText === 'link') {
                    $partyText = $partyLink;
                }
            }
            break;
        case 'contactGeneralEmail':
            if (isset($party->contact->general->email)) {
                $partyLink = 'mailto:' . $party->contact->general->email;
                if ($linkText === 'link') {
                    $partyText = $partyLink;
                }
            }
            break;
        case 'website': default:
            if (isset($party->websites->official)) {
                $partyLink = $party->websites->official;
                if ($linkText === 'link') {
                    $partyText = $partyLink;
                }
            }
            break;
    }

    if (!$partyText) {
        continue;
    }
    if (!$partyLink) {
        if (!$hideNoLink) {
            echo '<li>'. $flag . $partyText . '</li>';
        }
        continue;
    }
    echo '<li><a href="' . $partyLink . '">' . $flag . $partyText . '</a></li>';
}
?>

    </ul>
</div>
<?php echo $after_widget; ?>
