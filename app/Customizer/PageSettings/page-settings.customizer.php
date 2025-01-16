<?php

namespace App;

add_action('customize_register', function ($wp_customize) {

    $wp_customize->add_section('page_settings', [
        'title' => __('Ustawienia szablonu'),
        'description' => __(''),
    ]);

    $wp_customize->add_setting('page_settings_about_header', array(
        'default'           => 'Pierwsze Mistrzostwa w Squasha w Warszawie dla społeczności LGBT+!', // Domyślna wartość
        'sanitize_callback' => 'sanitize_text_field', // Funkcja sanitizująca
    ));

    // Dodaj kontrolkę
    $wp_customize->add_control('page_settings_about_header', array(
        'label'       => __('Nagłówek główny', 'mytheme'),
        'section'     => 'page_settings', // Sekcja, do której ma być przypisana
        'type'        => 'text', // Typ kontrolki
    ));

    $wp_customize->add_setting("page_settings_about_media", [
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new \MyCustomizer_Single_Image_Control($wp_customize, "page_settings_about_media", [
        'label' => "Zdjęcie w sekcji o wydarzeniu",
        'section' => 'page_settings',
     ]));


    $wp_customize->add_setting("page_settings_about_text", [
        'default' => '',
        'type' => 'theme_mod',
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ]);


    $wp_customize->add_control(new \MyCustomizer_Quicktags_Control($wp_customize, "page_settings_about_text", [
        'label' => "Tekst sekcji",
        'section' => 'page_settings',
    ]));

    $wp_customize->add_setting('page_settings_event_date', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field', // Możesz dostosować sanitizację
    )); 

    $wp_customize->add_control(new \MyCustomizer_Date_Picker(
        $wp_customize,
        'page_settings_event_date',
        array(
            'label'    => __('Wybierz datę wydarzenia', 'textdomain'),
            'section'  => 'page_settings',
        )
    ));

    \Customizer_Separator::add_separator( $wp_customize, 'page_settings', 'page_settings_separator');


    $wp_customize->add_setting("page_settings_details_media", [
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new \MyCustomizer_Single_Image_Control($wp_customize, "page_settings_details_media", [
        'label' => "Zdjęcie w sekcji informacyjnej",
        'section' => 'page_settings',
     ]));


    $wp_customize->add_setting('page_settings_details_levels', array(
        'default'           => 'A-B-C', // Domyślna wartość
        'sanitize_callback' => 'sanitize_text_field', // Funkcja sanitizująca
    ));

    // Dodaj kontrolkę
    $wp_customize->add_control('page_settings_details_levels', array(
        'label'       => __('Poziomy', 'mytheme'), // Etykieta
        'section'     => 'page_settings', // Sekcja, do której ma być przypisana
        'type'        => 'text', // Typ kontrolki
    ));

    $wp_customize->add_setting('page_settings_register_url', [
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => ['MyTheme_URL_Control', 'sanitize_link'], // Użycie niestandardowej metody sanitizing
    ]);

    $wp_customize->add_control(new \MyTheme_URL_Control($wp_customize, 'page_settings_register_url', [
        'label' => '',
        'section' => 'page_settings',
        'description' => 'Podaj link do rejestracji',
    ]));


    \Customizer_Separator::add_separator( $wp_customize, 'page_settings', 'page_settings_separator');


     for ($i = 1; $i <= 3; $i++) {
        // Dodaj ustawienie
        $wp_customize->add_setting("rules_item_$i", array(
            'default'           => "Domyślna zasada #$i", // Domyślna wartość dla każdego ustawienia
            'sanitize_callback' => 'sanitize_text_field', // Funkcja sanitizująca
        ));

        // Dodaj kontrolkę
        $wp_customize->add_control("rules_item_$i", array(
            'label'   => __("Zasada #$i", 'mytheme'), // Etykieta dynamiczna
            'section' => 'page_settings', // Sekcja, do której ma być przypisana
            'type'    => 'text', // Typ kontrolki
        ));
    }

    // Dodaj ustawienie
        $wp_customize->add_setting('rules_file', array(
            'default'           => '', // Domyślna wartość
            'sanitize_callback' => 'esc_url_raw', // Funkcja sanitizująca URL pliku
        ));

        // Dodaj kontrolkę
        $wp_customize->add_control(new \WP_Customize_Upload_Control(
            $wp_customize,
            'rules_file', // Unikalne ID kontrolki
            array(
                'label'       => __('Wybierz regulamin', 'mytheme'), // Etykieta widoczna w Customizerze
                'description' => __('Wybierz plik, który chcesz użyć.', 'mytheme'), // Opcjonalny opis
                'section'     => 'page_settings', // Sekcja, do której ma być przypisana
            )
        ));



                $wp_customize->add_setting("rules_media", [
                    'default' => '',
                    'type' => 'theme_mod',
                    'sanitize_callback' => 'esc_url_raw',
                ]);

                $wp_customize->add_control(new \MyCustomizer_Single_Image_Control($wp_customize, "rules_media", [
                    'label' => "Zdjęcie w sekcji zasad",
                    'section' => 'page_settings',
                ]));

    \Customizer_Separator::add_separator( $wp_customize, 'page_settings', 'page_settings_separator');


              

                 $wp_customize->add_setting("contact_text", [
                    'default' => '',
                    'type' => 'theme_mod',
                    'transport' => 'postMessage',
                    'sanitize_callback' => 'wp_kses_post',
                ]);


                $wp_customize->add_control(new \MyCustomizer_Quicktags_Control($wp_customize, "contact_text", [
                    'label' => "Tekst sekcji",
                    'section' => 'page_settings',
                ]));

                  $wp_customize->add_setting("contact_media", [
                    'default' => '',
                    'type' => 'theme_mod',
                    'sanitize_callback' => 'esc_url_raw',
                ]);

                $wp_customize->add_control(new \MyCustomizer_Single_Image_Control($wp_customize, "contact_media", [
                    'label' => "Zdjęcie w sekcji kontakt",
                    'section' => 'page_settings',
                ]));

                  $wp_customize->add_setting("volup_logo", [
                    'default' => '',
                    'type' => 'theme_mod',
                    'sanitize_callback' => 'esc_url_raw',
                ]);

                $wp_customize->add_control(new \MyCustomizer_Single_Image_Control($wp_customize, "volup_logo", [
                    'label' => "Logo volup",
                    'section' => 'page_settings',
                ]));


});


