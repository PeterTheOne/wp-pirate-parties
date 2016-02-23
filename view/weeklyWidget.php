<?php echo $before_widget; ?>

<div class="widget-text wp_widget_plugin_box">

<?php

// Check if title is set
if ($title) {
    echo $before_title . $title . $after_title;
}
?>
    <h3 class="partyName"><?php echo $party->name->en; ?></h3>

    <?php if (isset($party->name->{$party->country_code})) { ?>
        <span><?php echo $party->name->{$party->country_code}; ?></span><br />
    <?php } ?>

    <ul>
        <?php if (isset($party->websites->official)) { ?>
            <li><a href="<?php echo $party->websites->official; ?>"><?php echo $party->websites->official; ?></a></li>
        <?php } ?>
        <?php if (isset($party->social_networks->facebook->username)) { ?>
            <li><a href="//facebook.com/<?php echo $party->social_networks->facebook->id; ?>">http://facebook.com/<?php echo $party->social_networks->facebook->username; ?></a></li>
        <?php } ?>
        <?php if (isset($party->social_networks->twitter->username)) { ?>
            <li><a href="//twitter.com/<?php echo $party->social_networks->twitter->username; ?>">@<?php echo $party->social_networks->twitter->username; ?></a></li>
        <?php } ?>
    </ul>
</div>
<?php echo $after_widget; ?>
