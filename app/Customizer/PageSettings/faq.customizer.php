<?php

namespace App;

add_action('customize_register', function ($wp_customize) {
     
    $wp_customize->add_section('faq', [
        'title' => __('FAQ'),
        'description' => __(''),
    ]);

       new \My_Customizer_Repeatable(
        $wp_customize,
        'faq',
        'items',
        'Pytania i odpowiedzi',
        [
            'question' => ['type' => 'text', 'label' => 'Pytanie'],
            'answer' => ['type' => 'textarea', 'label' => 'Odpowiedź'],
        ]
    );

});




