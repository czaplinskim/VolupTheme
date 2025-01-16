<?php



if (class_exists('WP_Customize_Control')) {
    class MyCustomizer_Repeatable_Image_Control extends WP_Customize_Control
    {
        public $type = 'repeatable_image';

        protected function get_icon()
        {
            return \Roots\asset('images/icons/dragable.svg');
        }

        public function render_content()
        {
            $unique_id = uniqid('my-customizer-repeatable-image_'); // Unikalny identyfikator
            $images = explode(',', $this->value());
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            </label>

            <div class="my-customizer-repeatable-image-outer-container" data-unique-id="<?php echo esc_attr($unique_id); ?>">
                <?php foreach ($images as $image): ?>
                    <div class="my-customizer-repeatable-image-container" data-unique-id="<?php echo esc_attr($unique_id); ?>">
                        <div class="my-customizer-repeatable-image-preview <?php echo empty($image) ? '' : 'my-customizer-repeatable-image-has-image'; ?>" style="background-image: url('<?php echo esc_url($image); ?>');">
                            <?php if (!empty($image)): ?>
                                <button type="button" class="my-customizer-repeatable-image-remove">Usuń</button>
                                <button type="button" class="my-customizer-repeatable-image-replace">Zmień obraz</button>
                             
                            <?php else: ?>
                                <button type="button" class="my-customizer-repeatable-image-select">Wybierz obraz</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <input type="hidden" class="my-customizer-repeatable-image-input" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" data-unique-id="<?php echo esc_attr($unique_id); ?>" />
            <?php
        }
    }
}
