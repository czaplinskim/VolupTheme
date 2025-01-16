@php
    $schedule = [
    ['title' => 'Piątek',
    'subtitle' => '16.05',
    'items' => json_decode(get_theme_mod('friday', '[]'), true)
    ],
    ['title' => 'Sobota',
    'subtitle' => '17.05',
    'items' => json_decode(get_theme_mod('saturday', '[]'), true)
    ],
    ['title' => 'Niedziela',
    'subtitle' => '18.05',
    'items' => json_decode(get_theme_mod('sunday', '[]'), true)
    ],
    
    ];


@endphp

<section id="schedule" class="bg-main relative overflow-hidden">    

   <div class="absolute w-full h-full court-line">
        <x-court-line></x-court-line>
    </div>


    <div class='max-w-3xl w-full mx-auto px-4 md:px-14 py-14 xl:py-36'>
        <h2 class='font-sans text-white text-[64px] md:text-[72px] xl:text-[86px] 2xl:text-[100px] uppercase font-semibold leading-none'>
            HARMONOGRAM
        </h2>

        <div class="animate-text grid lg:grid-cols-5 gap-y-20 py-10">
            <div class="lg:col-span-3 flex flex-col gap-y-10">
                @foreach ( $schedule as $day )
                    <div>
                        <h5 class="font-sans text-white uppercase font-semibold text-[64px]">{{ $day['title'] }}<span class="text-[48px] text-stroke"> {{ $day['subtitle'] }}</span></h5>
                            <div class="flex flex-col gap-y-6">
                                @foreach ( $day['items'] as $item )
                                    <div class="flex font-sans text-white uppercase font-semibold gap-x-6">
                                        @php($time_range = strpos($item['date'], '-') !== false ? array_map('trim', explode('-', $item['date'])) : null)
                    
                                            <h5 class="text-[48px] flex flex-col leading-none w-24">
                                                @if($time_range)
                                                    <span> {{ $time_range[0] }}</span>
                                                    <span>{{ $time_range[1] }}</span>
                                                @else
                                                    <span>{{ $item['date'] }}</span>
                                                @endif
                                            </h5>

                                            <div>
                                                <p class="text-[28px] leading-none">{{ $item['name'] }}</p>
                                                <span class="text-[20px] block leading-tight">{{ $item['location'] }}</span>
                                            </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                @endforeach
            </div>
            <div class="lg:col-span-2">
                <img class="animate-image" src="{{ get_theme_mod('schedule_media') ?: '' }}">
            </div>
        </div>

    </div>

</section>