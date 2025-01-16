@php
    // Pobierz datę z get_theme_mod
    $eventDate = get_theme_mod('page_settings_event_date');

    // Sprawdź, czy data jest dostępna
    if ($eventDate) {
        // Stwórz obiekt DateTime z daty
        $formattedDate = (new DateTime($eventDate))->format('d.m.Y'); // Format DD.MM.YYYY
    }
@endphp

<section class="bg-pink relative overflow-hidden">    
    
    <div class="absolute w-full top-1/3 aspect-w-4 aspect-h-1 -translate-y-1/3 diagonal-line">
        <x-angle-line></x-angle-line>
    </div>

    <div class="px-4 lg:px-14 lg:pl-40">
        <div class=" relative max-w-3xl mx-auto grid xl:grid-cols-2 py-14 xl:py-36">
            <div class="z-20 relative text-animate text-sans text-[76px] md:text-[96px] text-white leading-none font-semibold space-y-14 xl:space-y-20">
                <div>
                    <h3><span class="text-stroke">GDZIE:</span> WARSZAWA</h3>
                    <h3><span class="text-stroke">KIEDY:</span> {{ $formattedDate }}</h3>
                    <h3><span class="text-stroke">POZIOMY:</span> {{ get_theme_mod('page_settings_details_levels') ?: '' }}</h3>
                </div>
                <h3><span class="text-stroke">REJESTRACJA</span> OD 20.01 <a href='{{ get_theme_mod('page_settings_manual_url') ?: '' }}' target="_blank" rel="noref" class="underline">INSTRUKCJA</a> </h3>

            </div>
            <div class="relative z-10 my-auto mt-10 xl:mt-0 xl:-left-40">
                <img class="animate-image" src="{{ get_theme_mod('page_settings_details_media') ?: '' }}">
            </div>
        </div>
    </div>
</section>
