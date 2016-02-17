<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'wp_widget_plugin'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('displayOption'); ?>"><?php _e('Party Text', 'wp_widget_plugin'); ?></label>
    <select name="<?php echo $this->get_field_name('displayOption'); ?>" id="<?php echo $this->get_field_id('displayOption'); ?>" class="widefat">
        <?php
        foreach ($this->displayOptions as $key => $option) {
            echo '<option value="' . $key . '" ', $displayOption == $key ? ' selected="selected"' : '', '>', $option, '</option>';
        }
        ?>
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id('linkOption'); ?>"><?php _e('Link', 'wp_widget_plugin'); ?></label>
    <select name="<?php echo $this->get_field_name('linkOption'); ?>" id="<?php echo $this->get_field_id('linkOption'); ?>" class="widefat">
        <?php
        foreach ($this->linkOptions as $key => $option) {
            echo '<option value="' . $key . '" ', $linkOption == $key ? ' selected="selected"' : '', '>', $option, '</option>';
        }
        ?>
    </select>
</p>

<p>
    <input id="<?php echo $this->get_field_id('ppiFilter'); ?>" name="<?php echo $this->get_field_name('ppiFilter'); ?>" type="checkbox" value="1" <?php checked( '1', $ppiFilter ); ?> />
    <label for="<?php echo $this->get_field_id('ppiFilter'); ?>"><?php _e('Only show PPI Members', 'wp_widget_plugin'); ?></label>
</p>

<p>
    <input id="<?php echo $this->get_field_id('ppeuFilter'); ?>" name="<?php echo $this->get_field_name('ppeuFilter'); ?>" type="checkbox" value="1" <?php checked( '1', $ppeuFilter ); ?> />
    <label for="<?php echo $this->get_field_id('ppeuFilter'); ?>"><?php _e('Only show PPEU Members', 'wp_widget_plugin'); ?></label>
</p>
