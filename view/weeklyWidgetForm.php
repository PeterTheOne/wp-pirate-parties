<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp-pirate-parties'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
    <input id="<?php echo $this->get_field_id('ppiFilter'); ?>" name="<?php echo $this->get_field_name('ppiFilter'); ?>" type="checkbox" value="1" <?php checked( '1', $ppiFilter ); ?> />
    <label for="<?php echo $this->get_field_id('ppiFilter'); ?>"><?php _e('Only show PPI Members', 'wp-pirate-parties'); ?></label>
</p>

<p>
    <input id="<?php echo $this->get_field_id('ppeuFilter'); ?>" name="<?php echo $this->get_field_name('ppeuFilter'); ?>" type="checkbox" value="1" <?php checked( '1', $ppeuFilter ); ?> />
    <label for="<?php echo $this->get_field_id('ppeuFilter'); ?>"><?php _e('Only show PPEU Members', 'wp-pirate-parties'); ?></label>
</p>
