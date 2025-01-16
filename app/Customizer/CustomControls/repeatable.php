<?php

class My_Customizer_Repeatable
{
    private $customizer;
    private $setting_id;
    private $fields;
    private $section_id;
    private $title;

    public function __construct($wp_customize, $section_id, $setting_id, $title, $fields)
    {
        $this->customizer = $wp_customize;
        $this->section_id = $section_id;
        $this->setting_id = $setting_id;
        $this->title = $title;
        $this->fields = $fields;

        $this->initialize();
    }

    private function initialize()
    {
        // Rejestruj ustawienie w Customizerze
        $this->customizer->add_setting($this->setting_id, [
            'default' => json_encode([]),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage', // Ustaw transport na postMessage
        ]);

        // Dodaj kontrolkę powiązaną z ustawieniem
        $this->customizer->add_control($this->setting_id, (
            [
                'settings' => $this->setting_id,
                'section' => $this->section_id,
                'label' => $this->title,
                'description' => $this->generate_html(),
                'type' => 'hidden',
                'input_attrs' => [
                    'class' => 'my-customizer-repeatable-data', // Dodana klasa CSS
                ],
            ]
        ));

    }

    private function generate_html()
{
    // Pobierz aktualne wartości zapisane w ustawieniu
    $saved_data = json_decode(get_theme_mod($this->setting_id, '[]'), true);
    if (!is_array($saved_data)) {
        $saved_data = [];
    }

    $html = '<div class="my-customizer-repeatable-container" data-setting-id="' . esc_attr($this->setting_id) . '">';
    $html .= '<div class="my-customizer-repeatable-items">';

    // Generuj elementy na podstawie zapisanych danych
    if (!empty($saved_data)) {
        foreach ($saved_data as $index => $values) {
            $html .= $this->generate_template($index, $values);
        }
    } else {
        // Jeśli brak danych, generuj pusty element
        $html .= $this->generate_template(0, []);
    }

    $html .= '</div>';
    $html .= '<button type="button" class="my-customizer-repeatable-add">Dodaj Następny</button>';

    // Dodaj ukryty szablon
    $html .= '<script type="text/template" class="my-customizer-template">';
    $html .= $this->generate_template('__INDEX__', []); // Szablon z placeholderem
    $html .= '</script>';

    $html .= '</div>';

    return $html;
}


    private function generate_template($index, $values)
{
    $html = '<div class="my-customizer-repeatable-item">';
    foreach ($this->fields as $key => $field) {
        $value = isset($values[$key]) ? esc_attr($values[$key]) : '';
        $html .= '<label class="customize-control-title">' . esc_html($field['label']) . ':</label>';
        if ($field['type'] === 'text') {
            $html .= '<input type="text" class="customize-control-input" data-field="' . esc_attr($key) . '" value="' . $value . '" />';
        } elseif ($field['type'] === 'textarea') {
            $html .= '<textarea class="customize-control-textarea" data-field="' . esc_attr($key) . '">' . $value . '</textarea>';
        } elseif ($field['type'] === 'media') {
            $html .= '<input type="hidden" data-field="' . esc_attr($key) . '" value="' . $value . '" />';
            $html .= '<button type="button" class="button-secondary my-customizer-media-upload">Wybierz</button>';
        }
    }
    $html .= '<button type="button" class="button-secondary my-customizer-repeatable-remove">Usuń</button>';
    $html .= '</div>';
    return $html;
}



};


