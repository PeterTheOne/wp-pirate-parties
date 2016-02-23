<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp-pirate-parties'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text', 'wp-pirate-parties'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
</p>

<p>
    <input id="<?php echo $this->get_field_id('showFlags'); ?>" name="<?php echo $this->get_field_name('showFlags'); ?>" type="checkbox" value="1" <?php checked( '1', $showFlags ); ?> />
    <label for="<?php echo $this->get_field_id('showFlags'); ?>"><?php _e('Show flags', 'wp-pirate-parties'); ?></label>
</p>

<p>
    <label for="<?php echo $this->get_field_id('linkText'); ?>"><?php _e('Party Text', 'wp-pirate-parties'); ?></label>
    <select name="<?php echo $this->get_field_name('linkText'); ?>" id="<?php echo $this->get_field_id('linkText'); ?>" class="widefat">
        <?php
        foreach ($this->linkTexts as $key => $option) {
            echo '<option value="' . $key . '" ', $linkText == $key ? ' selected="selected"' : '', '>', $option, '</option>';
        }
        ?>
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link', 'wp-pirate-parties'); ?></label>
    <select name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" class="widefat">
        <?php
        foreach ($this->links as $key => $option) {
            echo '<option value="' . $key . '" ', $link == $key ? ' selected="selected"' : '', '>', $option, '</option>';
        }
        ?>
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id('displayOption'); ?>"><?php _e('Display Option', 'wp-pirate-parties'); ?></label>
    <select name="<?php echo $this->get_field_name('displayOption'); ?>" id="<?php echo $this->get_field_id('displayOption'); ?>" class="widefat">
        <option value="list"<?php echo $displayOption == "list" ? ' selected="selected"' : ''; ?>>List</option>
        <option value="inline"<?php echo $displayOption == "inline" ? ' selected="selected"' : ''; ?>>Inline</option>
    </select>
</p>

<p>
    <input id="<?php echo $this->get_field_id('hideNoLink'); ?>" name="<?php echo $this->get_field_name('hideNoLink'); ?>" type="checkbox" value="1" <?php checked( '1', $hideNoLink ); ?> />
    <label for="<?php echo $this->get_field_id('hideNoLink'); ?>"><?php _e('Hide when no Link found', 'wp-pirate-parties'); ?></label>
</p>

<p>
    <input id="<?php echo $this->get_field_id('ppiFilter'); ?>" name="<?php echo $this->get_field_name('ppiFilter'); ?>" type="checkbox" value="1" <?php checked( '1', $ppiFilter ); ?> />
    <label for="<?php echo $this->get_field_id('ppiFilter'); ?>"><?php _e('Only show PPI Members', 'wp-pirate-parties'); ?></label>
</p>

<p>
    <input id="<?php echo $this->get_field_id('ppeuFilter'); ?>" name="<?php echo $this->get_field_name('ppeuFilter'); ?>" type="checkbox" value="1" <?php checked( '1', $ppeuFilter ); ?> />
    <label for="<?php echo $this->get_field_id('ppeuFilter'); ?>"><?php _e('Only show PPEU Members', 'wp-pirate-parties'); ?></label>
</p>
