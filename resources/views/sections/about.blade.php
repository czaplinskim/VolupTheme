@php
    // Pobierz datę z get_theme_mod
    $eventDate = get_theme_mod('page_settings_event_date');

    // Sprawdź, czy data jest dostępna
    if ($eventDate) {
        // Rozdziel datę na części
        $dateParts = explode('T', $eventDate); // Oddziel część daty od czasu
        $dateOnly = $dateParts[0]; // Wybierz tylko część daty (YYYY-MM-DD)
        [$year, $month, $day] = explode('-', $dateOnly); // Rozdziel na rok, miesiąc, dzień

        $yearArray = str_split($year);

    }
@endphp

<section id="about" class="bg-main relative overflow-hidden">    
    
    <div class="absolute w-full h-full court-line">
        <x-court-line size="full"></x-court-line>
    </div>


    <div class='max-w-monitor w-full mx-auto px-4 md:px-14 py-14 xl:py-36 relative'>
        <h2 class='font-sans text-white text-[72px] xl:text-[86px] 2xl:text-[100px] uppercase font-semibold leading-none'>
            {{ get_theme_mod('page_settings_about_header') ?: 'Pierwsze Mistrzostwa w Squasha w Warszawie dla społeczności LGBT+!' }}
        </h2>

        <div class="max-w-3xl mx-auto grid lg:grid-cols-2 gap-x-24 xl:gap-x-32 my-14 2xl:mt-20">
            <div class="relative">
                <img class="animate-image" src="{{ get_theme_mod('page_settings_about_media') ?: '' }}">

                @if (isset($year) && isset($month) && isset($day))
                    <div class="absolute text-stroke text-transparent text-[104px] leading-none font-semibold top-0 lg:top-20 -right-10">
                        <p>{{ $day }}/</p>
                        <p>{{ $month }}/</p>
                        <p>{{ $yearArray[0] . $yearArray[1] }}</p>
                        <p>{{ $yearArray[2] . $yearArray[3] }}</p>
                    </div>
                @endif
            </div>

            <div class="mt-10 xl:mt-36 xl:pr-24">
                <p class="animate-text font-sans font-light text-2xl text-white leading-snug">
                    {!! get_theme_mod('page_settings_about_text') ?: '' !!}
                </p>
            </div>
        </div>
    </div>
</section>
