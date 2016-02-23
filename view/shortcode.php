<div class="pirate-party shortcode code-<?php echo $party->code; ?>" data-code="<?php echo $party->code; ?>">
    <?php if ($attributes['show-logo'] && isset($party->logo)) { ?>
    <div class="logo">
        <img src="http://api.piratetimes.net/<?php echo $party->logo; ?>" alt="party logo" />
    </div>
    <?php } ?>

    <h3 class="partyName"><?php echo $party->name->en; ?></h3><br />

    <?php if ($attributes['show-native-name'] && isset($party->name->{$party->country_code})) { ?>
    <span><?php echo $party->name->{$party->country_code}; ?></span><br />
    <?php } ?>

    <?php
        if ($attributes['show-memberships'] && isset($party->membership)) {
            $memberships = array();
            if (isset($party->membership->ppi)) {
                $memberships[] = 'PPI';
            }
            if (isset($party->membership->ppeu)) {
                $memberships[] = 'PPEU';
            }
        $memberships = implode(', ', $memberships);
            if ($memberships !== '') {
    ?>
    <span><?php echo __('Member of ', 'wp-pirate-parties') . $memberships; ?></span><br />
        <?php } ?>
    <?php } ?>

    <ul>
        <?php if ($attributes['show-website'] && isset($party->websites->official)) { ?>
        <li><a href="<?php echo $party->websites->official; ?>"><?php echo $party->websites->official; ?></a></li>
        <?php } ?>
        <?php if ($attributes['show-facebook'] && isset($party->social_networks->facebook->username)) { ?>
        <li><a href="//facebook.com/<?php echo $party->social_networks->facebook->id; ?>">http://facebook.com/<?php echo $party->social_networks->facebook->username; ?></a></li>
        <?php } ?>
        <?php if ($attributes['show-twitter'] && isset($party->social_networks->twitter->username)) { ?>
        <li><a href="//twitter.com/<?php echo $party->social_networks->twitter->username; ?>">@<?php echo $party->social_networks->twitter->username; ?></a></li>
        <?php } ?>
        <?php if ($attributes['show-googleplus'] && isset($party->social_networks->googlePlus)) { ?>
        <li><a href="//plus.google.com/u/0/<?php echo $party->social_networks->googlePlus; ?>">Google+</a></li>
        <?php } ?>
        <?php if ($attributes['show-youtube'] && isset($party->social_networks->youtube)) { ?>
        <li><a href="//youtube.com/user/<?php echo $party->social_networks->youtube; ?>">Youtube</a></li>
        <?php } ?>
    </ul>
</div>