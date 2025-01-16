<?php

if (class_exists('WP_Customize_Control')) {
    class MyCustomizer_Date_Picker extends WP_Customize_Control
    {
        public $type = 'date_picker';

        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            </label>

            <?php $date_value = $this->value(); ?>

            <div class="my-customizer-date-picker-container" data-unique-id="<?php echo esc_attr($this->id); ?>">
                <input type="datetime-local" 
                       class="my-customizer-date-picker-input"
                       value="<?php echo esc_attr($date_value); ?>" 
                       <?php $this->link(); ?> />
            </div>
            <?php
        }
    }
}
