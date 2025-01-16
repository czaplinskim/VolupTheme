<?php



if (class_exists('WP_Customize_Control')) {
    class MyTheme_URL_Control extends WP_Customize_Control
    {
        public $type = 'url';

        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            </label>
            <input 
                type="url" 
                id="<?php echo esc_attr($this->id); ?>" 
                class="url-customizer-input" 
                <?php $this->link(); ?>
                value="<?php echo esc_attr($this->value()); ?>" 
                placeholder="Enter a valid URL"/>
            <p class="description"><?php echo esc_html($this->description); ?></p>
            <?php
        }

        public static function sanitize_link($input)
{
    error_log('Sanitize link function called with: ' . $input); // Debugging

    $url = trim($input);

    if (!empty($url) && !filter_var($url, FILTER_VALIDATE_URL)) {
        $url = 'https://' . $url;
    }

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return esc_url_raw($url);
    }

    return '';
}

    }
}
