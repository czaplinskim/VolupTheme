<?php

if (class_exists('WP_Customize_Control')) {
    class MyCustomizer_Single_Image_Control extends WP_Customize_Control
    {
        public $type = 'single_image';

        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            </label>

            <?php $image = $this->value(); ?>

                <div class="my-customizer-image-container" data-unique-id="<?php echo esc_attr($this->id); ?>">
                    <div class="my-customizer-image-preview <?php echo empty($image) ? '' : 'my-customizer-image-has-preview'; ?>" style="background-image: url('<?php echo esc_url($image); ?>');">
                        <?php if (!empty($image)): ?>
                            <button type="button" class="my-customizer-image-replace">Zmień obraz</button>
                            <button type="button" class="my-customizer-image-remove">Usuń</button>
                        <?php else: ?>
                            <button type="button" class="my-customizer-image-select">Wybierz obraz</button>
                        <?php endif; ?>
                    </div>
                </div>

            <input type="hidden" class="my-customizer-single-image-input" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" data-unique-id="<?php echo esc_attr($this->id); ?>" />
            <?php
        }
    }
}
