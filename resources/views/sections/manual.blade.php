@php

    $manual = json_decode(get_theme_mod('manual_items', '[]'), true);
    $current_lang = isset($_SERVER['HTTP_X_GT_LANG']) ? $_SERVER['HTTP_X_GT_LANG'] : '';


@endphp

<section id="manual" class="bg-main relative  pt-36">    
         <h2 class='px-4 md:px-14 font-sans pb-10 xl:pb-28 text-white text-center text-[72px] xl:text-[84px] 2xl:text-[96px] uppercase font-semibold leading-none'>
                INSTRUKCJA REJESTRACJI
        </h2>

        @if(!empty($manual))
        @foreach ($manual as $item)

            @php
                $order = $loop->iteration;
                $imgorder = $loop->odd ? ' order-2 xl:order-1 ' : 'order-2';
                $contentorder = $loop->odd ? ' order-1 xl:order-2 ' : 'order-1'

            @endphp

            <div class="manual grid xl:grid-cols-4 relative z-10">
                <div class="my-auto xl:col-span-2 {{ $imgorder }}">
                    <div class="aspect-w-16 aspect-h-9">
                       @if(isset($current_lang) && $current_lang === 'en') 
                            {!! wp_get_attachment_image($item['media_eng'], 'full', false, ['class' => 'h-full w-full object-cover']) !!}

                        @else   
                            {!! wp_get_attachment_image($item['media'], 'full', false, ['class' => 'h-full w-full object-cover']) !!}

                       @endif
                    </div>
                </div>

                <div class="xl:col-span-2 p px-4 xl:px-14 my-auto py-14 {{ $contentorder }}">
                    <div class="font-sans text-white uppercase font-semibold">
                        <h5 class=" text-[64px] leading-none"> {{ $item['question']}} </h5>
                      

                        <div class="my-10 pl-1 font-sans font-light text-xl text-white leading-snug max-w-[560px]">{!! $item['answer'] !!}</div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif

</section>