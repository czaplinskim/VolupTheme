<?php

    /**
     * Sprawdza, czy dany URL należy do domeny aktualnej strony.
     *
     * @param string $url URL, który ma być sprawdzony.
     * @return bool True, jeśli URL należy do domeny aktualnej strony, false w przeciwnym razie.
     */
    function is_internal_url($url) {
        // Pobiera URL głównej strony (np. https://example.com) i rozbija go na komponenty.
        $home_url = wp_parse_url(home_url());

        // Rozbija sprawdzany URL na komponenty, takie jak host, schemat, ścieżka itp.
        $parsed_url = wp_parse_url($url);

        // Sprawdza, czy komponent 'host' istnieje i czy jest równy hostowi głównej domeny strony.
        // Jeśli są zgodne, oznacza to, że URL należy do tej samej domeny.
        return isset($parsed_url['host']) && $parsed_url['host'] === $home_url['host'];
    }

// Funkcja do przekształcania ID w URL (jeśli jest ID) lub pozostawienia linku jako URL
    function getImageUrl($img) {
        if (is_numeric($img)) {
            return wp_get_attachment_url($img);
        }
        return $img; // Zwróć link, jeśli to URL
    }

    /**
 * Ładuje wszystkie pliki PHP z podanego folderu.
 *
 * @param string $folder Ścieżka do folderu, z którego mają być załadowane pliki.
*/
    function require_afff($subfolder) {
        // Uzyskanie ścieżki do pliku, z którego wywołano funkcję
        $backtrace = debug_backtrace();
        $caller_file = $backtrace[0]['file'];

        // Ustal folder nadrzędny wywołującego pliku i dodaj folder wewnętrzny
        $directory = dirname($caller_file) . '/' . $subfolder;

        // Ładuj wszystkie pliki PHP w folderze
        foreach (glob($directory . '/*.php') as $file) {
            require_once $file;
        }
    }
/**
 * Ładuje wszystkie pliki PHP z bieżącego folderu, z wyjątkiem pliku wywołującego funkcję.
 */

function require_afec() {
     $backtrace = debug_backtrace();
    $caller_file = $backtrace[0]['file'];

    // Folder pliku, z którego wywołano funkcję
    $directory = dirname($caller_file);

    // Ładowanie wszystkich plików PHP w folderze
    foreach (glob($directory . '/*.php') as $file) {
        if ($file !== $caller_file) { // Pomijamy plik wywołujący funkcję
            require_once $file;
        }
    }
}

/**
 * Funkcja zastępuję wszystkie znaki '\n' tagiem <br>
 *
 * @param string $string The input string
 * @return string The processed string with <br> tags
 */

function custom_nl2br($string) {
    // Zastępuje dosłowny '\n' na rzeczywistą nową linię
    $string = str_replace('\n', PHP_EOL, $string);
    
    // Konwertuje nową linię na <br> dla HTML
    return nl2br($string);
}

/**
 * Sprawdza czy image_url istnieje.
 * Jeśli nie to generwuje placeholder image o określonej rozdzielczości.
 */

function generate_placeholder_image_url($image_url, $width, $height) {
    if (empty($image_url)) {
        return "https://placehold.co/{$width}x{$height}";
    }
    return $image_url;
}


function change_custom_title_placeholder($title, $post, $post_type, $new_title) {
    if ($post->post_type === $post_type) {
        $title = $new_title;
    }
    return $title;
}

// Dodawanie filtra z przekazaniem parametrów
function add_custom_title_placeholder_filter($post_type, $new_title) {
    add_filter('enter_title_here', function($title, $post) use ($post_type, $new_title) {
        return change_custom_title_placeholder($title, $post, $post_type, $new_title);
    }, 10, 2);
}


/**
 * Formatuje datę z formatu 'Y-m-d' do formatu 'd F Y' w języku polskim.
 *
 * @param string $date Data w formacie 'Y-m-d', np. '2024-11-21'.
 * @return string Sformatowana data w języku polskim, np. '21 listopada 2024'.
 *
 * Funkcja wykorzystuje klasę IntlDateFormatter, aby uzyskać poprawne nazwy miesięcy w języku polskim.
 * Wymaga włączonego rozszerzenia 'intl' w PHP.
 */
function formatDateToPolish($date) {
    // Tworzymy obiekt DateTime z podanej daty
    $dateTime = DateTime::createFromFormat('Y-m-d', $date);

    // Ustawienie lokalizacji na polski i formatowanie daty za pomocą IntlDateFormatter
    $formatter = new IntlDateFormatter(
        'pl_PL', 
        IntlDateFormatter::LONG, 
        IntlDateFormatter::NONE,
        'Europe/Warsaw',
        IntlDateFormatter::GREGORIAN,
        'd MMMM yyyy'
    );

    // Zwracamy sformatowaną datę
    return $formatter->format($dateTime);
}

/**
 * Dodaje znacznik <br/> przed rokiem w dacie w formacie 'd miesiąc RRRR'.
 *
 * @param string $date Tekst zawierający datę, np. '21 listopada 2024'.
 * @return string Tekst ze znacznikiem <br/> przed rokiem, np. '21 listopada<br/>2024'.
 */
function addLineBreakBeforeYear($date) {
    // Dodaje znacznik <br/> przed 4-cyfrowym rokiem na końcu tekstu
    return preg_replace('/(\d{4})$/', '<br/>$1', $date);
}


/**
 * Funkcja zwraca dzień tygodnia dla podanej daty.
 *
 * @param string $date Data w formacie 'Y-m-d' (np. '2024-11-07').
 * @return string Nazwa dnia tygodnia (np. 'Czwartek' dla języka polskiego).
 */
function getDayOfWeek($date) {
    // Ustawienie lokalizacji na polski, aby dni tygodnia były zwracane w języku polskim.
    setlocale(LC_TIME, 'pl_PL.UTF-8');

    // Przekształcenie daty na znacznik czasu (timestamp).
    $timestamp = strtotime($date);

    // Pobranie pełnej nazwy dnia tygodnia na podstawie znacznika czasu.
    $dayOfWeek = strftime('%A', $timestamp);

    // Zwrócenie dnia tygodnia z pierwszą literą wielką.
    return $dayOfWeek;
}

/**
 * Pobiera dane sekcji z WordPress Customizer na podstawie prefiksu oraz kluczy pojedynczych i grupowanych.
 *
 * Funkcja służy do pobierania danych z sekcji Customizera, umożliwiając pobieranie pojedynczych wartości oraz grupowanych itemów.
 * Działa dynamicznie na podstawie przekazanego prefiksu sekcji oraz listy kluczy.
 *
 * @param string $section_prefix Prefiks sekcji w Customizerze, np. 'footer', 'header'.
 * @param array|string $single_keys Tablica kluczy dla pojedynczych wartości w sekcji (string zostanie zamieniony na tablicę).
 * @param array|string $grouped_keys Tablica kluczy dla grupowanych wartości w sekcji (string zostanie zamieniony na tablicę).
 *
 * @return array Tablica z danymi sekcji, która zawiera klucze odpowiadające przekazanym wartościom oraz zgrupowane itemy.
 *               Struktura zwracanej tablicy:
 *               [
 *                   'single_key1' => 'Wartość pojedyncza',
 *                   'single_key2' => 'Wartość pojedyncza',
 *                   'items' => [
 *                       [
 *                           'grouped_key1' => 'Wartość zgrupowana',
 *                           'grouped_key2' => 'Wartość zgrupowana',
 *                       ],
 *                       ...
 *                   ],
 *               ]
 */
function get_customizer_section_data(
    $section_prefix,
    $single_keys = [],
    $grouped_keys = [],
    $default_values = []
) {
    // Sprawdzenie, czy podano prefix
    if (empty($section_prefix)) {
        return []; // Jeśli nie ma prefixu, zwracamy pustą tablicę
    }

    // Inicjujemy tablicę wynikową
    $data = [];

    // Jeśli drugi argument (single_keys) jest pojedynczym stringiem, zamieniamy go na tablicę
    if (!is_array($single_keys)) {
        $single_keys = [$single_keys];
    }

    // Pobieranie pojedynczych wartości
    foreach ($single_keys as $key) {
        // Tworzymy pełną nazwę klucza
        $full_key = $section_prefix . '_' . $key;
        
        // Pobieramy wartość z customizera lub default
        $data[$key] = get_theme_mod($full_key, $default_values[$key] ?? null);
    }

    // Jeśli trzeci argument (grouped_keys) jest pojedynczym stringiem, zamieniamy go na tablicę
    if (!is_array($grouped_keys)) {
        $grouped_keys = [$grouped_keys];
    }

    // Grupowanie wartości
    $items = [];
    for ($i = 1; true; $i++) {
        $item_data = [];

        foreach ($grouped_keys as $key) {
            // Tworzymy pełną nazwę klucza dla każdej grupowanej wartości
            $full_key = $section_prefix . '_item_' . $i . '_' . $key;

            // Pobieramy wartość z customizera lub default
            $value = get_theme_mod($full_key, $default_values["item_{$i}_{$key}"] ?? null);

            if ($value === null) {
                // Jeśli brak wartości (nawet domyślnej) dla konkretnego itemu, przerywamy pętlę
                break 2;
            }

            $item_data[$key] = $value;
        }

        // Dodajemy zebrane dane do grupy 'items'
        if (!empty($item_data)) {
            $items[] = $item_data;
        }
    }

    // Jeśli zebraliśmy jakieś zgrupowane wartości, dodajemy je do tablicy $data
    if (!empty($items)) {
        $data['items'] = $items;
    }

    return $data;
}

/**
 * Uzupełnia tablicę brakującymi elementami do określonej długości, 
 * wypełniając je wartością placeholdera.
 *
 * @param array $images Tablica wejściowa z linkami do obrazów.
 * @param int $targetCount Docelowa liczba elementów w tablicy (domyślnie 6).
 * @param string $placeholder Wartość placeholdera dla brakujących elementów (domyślnie 'https://placehold.co/270x360').
 * @return array Zaktualizowana tablica z wypełnionymi brakującymi miejscami.
 */
function fillPlaceholderImages(array $images, int $targetCount = 6, string $placeholder = 'https://placehold.co/270x360'): array {
    // Oblicz, ile elementów brakuje do osiągnięcia docelowej liczby elementów
    $missingCount = $targetCount - count($images);
    
    // Jeśli brakuje elementów, wypełnij brakujące miejsca placeholderem
    if ($missingCount > 0) {
        // Tworzymy tablicę brakujących elementów i łączymy ją z oryginalną tablicą
        $images = array_merge($images, array_fill(0, $missingCount, $placeholder));
    }
    
    // Zwracamy zaktualizowaną tablicę
    return $images;
}

/**
 * Funkcja sprawdza typ pliku na podstawie rozszerzenia w URL.
 * Rozróżnia obrazy i wideo na podstawie zdefiniowanych list rozszerzeń.
 *
 * @param string $url URL pliku do sprawdzenia.
 * @return string Zwraca 'image' dla obrazów, 'video' dla wideo lub 'unknown' dla innych typów plików.
 */
function getMediaTypeFromUrl($url) {
    // Lista rozszerzeń dla plików graficznych
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'];
    
    // Lista rozszerzeń dla plików wideo
    $videoExtensions = ['mp4', 'avi', 'mov', 'mkv', 'flv', 'webm', 'wmv', 'mpeg', '3gp'];

    // Pobranie rozszerzenia pliku z URL
    // parse_url() rozdziela URL na części, a PHP_URL_PATH zwraca ścieżkę (bez parametrów i hosta).
    // pathinfo() wyodrębnia rozszerzenie z podanej ścieżki pliku.
    $extension = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));

    // Sprawdzenie, czy rozszerzenie pliku znajduje się w liście rozszerzeń graficznych
    if (in_array($extension, $imageExtensions)) {
        return 'image'; // Jeśli rozszerzenie pasuje do obrazów, zwróć 'image'
    }

    // Sprawdzenie, czy rozszerzenie pliku znajduje się w liście rozszerzeń wideo
    if (in_array($extension, $videoExtensions)) {
        return 'video'; // Jeśli rozszerzenie pasuje do wideo, zwróć 'video'
    }

    // Jeśli rozszerzenie nie pasuje do żadnej z list, zwróć 'unknown'
    return 'unknown';
}

/**
 * Function to retrieve a specific cookie value.
 *
 * @param string $cname The name of the cookie.
 * @return string The value of the cookie, or an empty string if not found.
 */
function getCookie($cname) {
    if (isset($_COOKIE[$cname])) {
        return $_COOKIE[$cname];
    }
    return "";
}