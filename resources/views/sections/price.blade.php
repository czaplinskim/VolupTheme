@php 

    $prices = [[
            'name' => 'EARLY BIRD',
            'subtitle' => 'REJESTRACJA OD 20.01 do 28.02',
            'price' => '160',
            'disabled' => false
            ],
            [
            'name' => 'NIGHT OWL',
            'subtitle' => 'REJESTRACJA OD 01.03 do 25.04',
            'price' => '200',
            'disabled' => true
            ],
        ];

@endphp

<section id="fee" class="bg-pink relative overflow-hidden">    
    <h2 class='font-sans px-4 md:px-14 py-20 text-white text-center text-[72px] xl:text-[96px] 2xl:text-[120px] uppercase font-semibold leading-none'>
        OPŁATY TURNIEJOWE
    </h2>

    <div class="relative">
        <div class="absolute w-full horizontal-line">
            <x-line direction="horizontal" stroke="0.4" color="white" />
        </div>

        <div class="absolute w-full horizontal-line top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 md:hidden">
            <x-line direction="horizontal" stroke="0.4"  color="white" />
        </div>

        <div class="absolute h-full left-1/2 -translate-x-1/2 vertical-line hidden md:block">
            <x-line direction="vertical" stroke="0.4"  color="white" />
        </div> 
        <div class="max-w-monitor mx-auto grid md:grid-cols-2">
            @foreach( $prices as $price)
                <div class="text-center font-sans text-white uppercase font-semibold py-20 px-4 md:px-14">
                    <div>
                        <h5 class="text-[64px] text-stroke leading-none"> {{$price['name']}} </h5>
                        <h5 class="text-[28px]">{{$price['subtitle']}} </h5>
                    </div>

                    <h5 class="text-[64px] leading-none my-10">{{$price['price']}} PLN</h5>
                    @php
                        $tag = $price['disabled'] ? 'p' : 'a';
                    @endphp
                    <{{ $tag }} href='{{ get_theme_mod('page_settings_register_url') ?: '' }}' target="_blank" rel="noref" class="underline text-[30px] {{ $price['disabled'] ? 'opacity-20' : '' }}">DOŁĄCZ DO TURNIEJU<{{ $tag }}/> 
                </div>
            @endforeach 
        </div>
    </div>
</section>
