<?php

namespace App;

add_action('customize_register', function ($wp_customize) {
     
    $wp_customize->add_section('manual', [
        'title' => __('Instrukcja rejestracji'),
        'description' => __(''),
        'active_callback' => function() {

            return is_page_template('page-manual.blade.php');

        }
    ]);

       new \My_Customizer_Repeatable(
        $wp_customize,
        'manual',
        'manual_items',
        'Pytania i odpowiedzi',
        [
            'question' => ['type' => 'text', 'label' => 'Nagłówek'],
            'answer' => ['type' => 'textarea', 'label' => 'Treść'],
            'media' => ['type' => 'media', 'label' => 'Obrazek'],

        ]
    );

});




