<?php 


if (class_exists('WP_Customize_Control')) {
    class MyCustomizer_Repeatable_Header_With_Description extends WP_Customize_Control {
        public $type = 'repeatable_header_with_description';
        public $header_label;
        public $description_label;

        public $button_label;


        public function __construct($manager, $id, $args = array()) {
            // Pobieranie etykiet z args (lub ustawianie domyślnych wartości)
            $this->header_label = isset($args['header_label']) ? $args['header_label'] : 'Nagłówek';
            $this->description_label = isset($args['description_label']) ? $args['description_label'] : 'Opis';
            $this->button_label = isset($args['button_label']) ? $args['button_label'] : 'Dodaj nowy element';


            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            // Pobierz zapisane wartości i przekształć je na tablicę
            $values = json_decode($this->value(), true);

            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            </label>
            <div id="my-customizer-repeatable-header-with-description-<?php echo esc_attr($this->id); ?>" class="my-customizer-repeatable-header-with-description-wrapper">
                <div class="my-customizer-repeatable-header-with-description-items">
                    <?php if (!empty($values)) : ?>
                        <?php foreach ($values as $index => $item) : ?>
                            <div class="my-customizer-repeatable-header-with-description-item">
                                <label for="header_<?php echo esc_attr($index); ?>"><?php echo esc_html($this->header_label); ?></label>
                                <input type="text" name="header_<?php echo esc_attr($index); ?>" class="my-customizer-repeatable-header-with-description-header" value="<?php echo esc_attr($item['header']); ?>" placeholder="<?php echo esc_attr($this->header_label); ?>">
                                
                                <label for="description_<?php echo esc_attr($index); ?>"><?php echo esc_html($this->description_label); ?></label>
                                <textarea name="description_<?php echo esc_attr($index); ?>" class="my-customizer-repeatable-header-with-description-description" rows="5" placeholder="<?php echo esc_attr($this->description_label); ?>"><?php echo esc_textarea($item['description']); ?></textarea>
                                <button type="button" class="button remove-repeatable-header-description"><?php _e('Usuń', 'textdomain'); ?></button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" class="button add-new-repeatable-header-description"><?php echo esc_html($this->button_label); ?></button>

                <!-- Hidden input to hold JSON values -->
                <input type="hidden" <?php $this->link(); ?> class="my-customizer-repeatable-header-with-description-hidden" value="<?php echo esc_attr($this->value()); ?>" />
            </div>
            <?php
        }



        public static function sanitize_repeatable_header_with_description($input) {
                $sanitized_data = array();

                // Spróbuj zdekodować dane JSON
                $input = json_decode($input, true);

                // Sprawdź, czy dekodowanie JSON się powiodło
                if (json_last_error() !== JSON_ERROR_NONE) {
                    error_log('Błąd dekodowania JSON: ' . json_last_error_msg()); // Zaloguj błąd
                    return ''; // Zwróć pustą wartość w przypadku błędu
                }

                if (is_array($input)) {
                    foreach ($input as $item) {
                        // Sprawdź, czy zarówno header, jak i description są ustawione i nie są puste
                        if (!empty($item['header']) && !empty($item['description'])) {
                            // Oczyszczanie danych - usuwamy potencjalnie niebezpieczne fragmenty
                            $sanitized_data[] = array(
                                'header' => sanitize_text_field($item['header']),
                                'description' => sanitize_textarea_field($item['description']),
                            );
                        }
                    }
                }

                // Zwracamy dane jako zakodowany JSON
                return json_encode($sanitized_data);
            }



        

    }
}
