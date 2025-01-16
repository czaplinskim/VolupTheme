<?php



if (class_exists('WP_Customize_Control')) {
    class PostDropdownControl extends WP_Customize_Control
    {
        public $type = 'post_dropdown';
        public $post_type; // Przechowujemy typ CPT

        // Konstruktor, który akceptuje typ CPT
        public function __construct(
            $manager,
            $id,
            $args = [],
            $post_type = 'post'
        ) {
            parent::__construct($manager, $id, $args);
            $this->post_type = $post_type; // Ustawienie custom post type
        }

        // Metoda render_content odpowiedzialna za wyświetlenie kontrolki
        public function render_content()
        {
            // Pobieramy wszystkie posty z podanego custom post type
            $posts = get_posts([
                'post_type' => $this->post_type, // Używamy dynamicznie przekazanego CPT
                'posts_per_page' => -1,
            ]);

            if (!empty($posts)) { ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html(
                        $this->label
                    ); ?></span>
                    <select <?php $this->link(); ?>>
                        <option value=""><?php esc_html_e(
                            'Wybierz wpis',
                            'your-text-domain'
                        ); ?></option>
                        <?php foreach ($posts as $post): ?>
                            <option value="<?php echo esc_attr(
                                $post->ID
                            ); ?>" <?php selected(
    $this->value(),
    $post->ID
); ?>>
                                <?php echo esc_html(
                                    get_the_title($post->ID)
                                ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <?php } else {echo '<p>' .
                    __('Brak dostępnych wpisów', 'your-text-domain') .
                    '</p>';}
        }
    }
}
