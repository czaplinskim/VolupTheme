<?php


class MyCustomizer_Section_Details
{
    public function __construct($args = [])
    {
        if (isset($args['wp_customize'], $args['section'], $args['label'], $args['description'])) {
            $wp_customize = $args['wp_customize'];

            // Ustawienie
            $wp_customize->add_setting($args['section'] . '_heading', [
                'sanitize_callback' => '__return_false', // Ponieważ nie zapisujemy wartości
            ]);

            // Kontrolka
            $wp_customize->add_control(new \WP_Customize_Control($wp_customize, $args['section'] . '_heading', [
                'label'       => $args['label'],
                'description' => $args['description'],
                'section'     => $args['section'],
                'type'        => 'hidden', // Brak inputu, tylko nagłówek i opis
            ]));
        }
    }
}
