<?php



if (class_exists('WP_Customize_Control')) {
    class MyCustomizer_Quicktags_Control extends WP_Customize_Control
    {
        public $type = 'quicktags';

    

       public function render_content()
            {
                // Generowanie unikalnego ID dla textarea na podstawie kontrolki
                $id = 'quicktags-customizer-editor-' . esc_attr($this->id);
                ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                </label>
                <textarea id="<?php echo esc_attr($id); ?>" class="quicktags-customizer-editor" rows="10" <?php $this->link(); ?>>
                    <?php echo esc_textarea($this->value()); ?>
                </textarea>
                <?php
            }
    }
}
