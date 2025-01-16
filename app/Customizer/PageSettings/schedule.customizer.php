<?php

namespace App;

add_action('customize_register', function ($wp_customize) {
     
    $wp_customize->add_section('schedule', [
        'title' => __('Harmonogram'),
        'description' => __(''),
    ]);


    $wp_customize->add_setting("schedule_media", [
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new \MyCustomizer_Single_Image_Control($wp_customize, "schedule_media", [
        'label' => "Zdjęcie sekcji",
        'section' => 'schedule',
     ]));


       new \My_Customizer_Repeatable(
        $wp_customize,
        'schedule',
        'friday',
        'Piątek',
        [
            'date' => ['type' => 'text', 'label' => 'Godziny (jeśli przediał odziel znakiem -)'],
            'name' => ['type' => 'text', 'label' => 'Nazwa punktu programu'],
            'location' => ['type' => 'text', 'label' => 'Lokalizacja'],
        ]
    );


    \Customizer_Separator::add_separator( $wp_customize, 'page_settings', 'page_settings_separator');


    new \My_Customizer_Repeatable(
        $wp_customize,
        'schedule',
        'saturday',
        'Sobota',
        [
            'date' => ['type' => 'text', 'label' => 'Godziny (jeśli przediał odziel znakiem -)'],
            'name' => ['type' => 'text', 'label' => 'Nazwa punktu programu'],
            'location' => ['type' => 'text', 'label' => 'Lokalizacja'],
        ]
    );

    \Customizer_Separator::add_separator( $wp_customize, 'page_settings', 'page_settings_separator');


    new \My_Customizer_Repeatable(
        $wp_customize,
        'schedule',
        'sunday',
        'Niedziela',
        [
            'date' => ['type' => 'text', 'label' => 'Godziny (jeśli przediał odziel znakiem -)'],
            'name' => ['type' => 'text', 'label' => 'Nazwa punktu programu'],
            'location' => ['type' => 'text', 'label' => 'Lokalizacja'],
        ]
    );

});




