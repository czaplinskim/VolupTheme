<?php

if (class_exists('WP_Customize_Control')) {
    class MyCustomizer_Instagram_Reels extends WP_Customize_Control
    {
        public $type = 'instagram_reels';

        public function render_content()
        {
            $unique_id = uniqid('my-customizer-instagram-reels-'); // Unikalny identyfikator
            $reels = explode(',', $this->value()); // Pobieramy zapisane wartości (ID postów)
            
            // Upewniamy się, że tablica $reels ma zawsze 5 elementów
            $reels = array_pad($reels, 5, ''); // Dodaje puste wartości, jeśli brakuje elementów
            
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            </label>

            <div class="my-customizer-instagram-reels-wrapper" data-unique-id="<?php echo esc_attr($unique_id); ?>">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="my-customizer-instagram-reels-container" data-unique-id="<?php echo esc_attr($unique_id); ?>">
                        <div class="my-customizer-instagram-reels-preview <?php echo empty($reels[$i]) ? '' : 'my-customizer-instagram-reels-has-preview'; ?>" data-reel-id="<?php echo esc_attr($reels[$i]); ?>" data-unique-id="<?php echo esc_attr($unique_id); ?>" style="background-image: url('<?php echo !empty($reels[$i]) ? esc_url(wp_get_attachment_url($reels[$i])) : ''; ?>');">
                            <?php if (!empty($reels[$i])): ?>
                                <button type="button" class="my-customizer-instagram-reels-replace">Zmień post</button>
                                <button type="button" class="my-customizer-instagram-reels-remove">Usuń</button>
                            <?php else: ?>
                                <button type="button" class="my-customizer-instagram-reels-select">Wybierz post</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>

            <input type="hidden" class="my-customizer-instagram-reels-input" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" data-unique-id="<?php echo esc_attr($unique_id); ?>" />
            <?php
        }
    }
}
