<?php



class Customizer_Separator
{
    /**
     * Adds a separator control to the WordPress Customizer
     *
     * @param WP_Customize_Manager $wp_customize WordPress Customizer manager.
     * @param string $section The section where the separator should be added.
     * @param string $separator_id Optional. The unique ID for the separator. Defaults to 'separator'.
     * @param string $style Optional. Inline styles for the separator. Defaults to dashed line style.
     */
    public static function add_separator($wp_customize, $section, $separator_id = 'separator', $style = 'border-top: 1px dashed #ccc; margin-bottom: 20px;')
    {
        $wp_customize->add_setting($separator_id, [
            'default' => '',
            'sanitize_callback' => '__return_empty_string',
        ]);

        $wp_customize->add_control(new \WP_Customize_Control($wp_customize, $separator_id, [
            'label' => '',
            'section' => $section,
            'type' => 'hidden',
            'description' => '<hr id="' . esc_attr($separator_id) . '" style="' . esc_attr($style) . '">',
        ]));
        
        // Dodajemy nasz skrypt JavaScript, aby dynamicznie ustawić margines
        add_action('customize_controls_enqueue_scripts', function() use ($separator_id) {
            wp_add_inline_script('customize-controls', "
                jQuery(document).ready(function($) {
                    const separator = $('#" . esc_attr($separator_id) . "');
                    const previousElement = separator.closest('.customize-control').prev('.customize-control');
                    
                    if (previousElement.length) {
                        const previousMarginBottom = parseInt(previousElement.css('margin-bottom')) || 0;
                        const previousPaddingBottom = parseInt(previousElement.css('padding-bottom')) || 0;
                        const marginTop = 25 - previousMarginBottom + previousPaddingBottom;
                        
                        separator.css('margin-top', marginTop + 'px');
                    }
                });
            ");
        });
    }
}
