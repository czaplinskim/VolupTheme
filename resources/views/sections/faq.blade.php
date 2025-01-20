@php

$faq_items = json_decode(get_theme_mod('items', '[]'), true) ?: null;

@endphp

<section id="faq" class="bg-pink relative py-14 xl:py-36 px-4 md:px-14 ">    
            
         <h2 class='font-sans pb-10 xl:pb-28 text-white text-center text-[72px] xl:text-[84px] 2xl:text-[96px] uppercase font-semibold leading-none'>
                NAJCZĘŚCIEJ ZADAWANE PYTANIA
        </h2>

            <div class="animate-text flex flex-col max-w-xl mx-auto mb-10 w-full divide-y-[1.5px] divide-stroke border-stroke border-y-[1.5px] " id="faq-accordion">
                @if(isset($faq_items))
                @foreach ($faq_items as $index => $item)
                    <div class="faq-accordion-item px-2 md:px-3.5 lg:px-8 cursor-pointer">
                        <div class="flex justify-between items-baseline py-6 faq-accordion-header gap-x-2" id="accordion-title-{{ $index }}">
                                <h6 class="uppercase text-white font-medium font-sans text-[26px]">{{ $item['question'] }}</h6>
                                <span><x-i-arrow height="15" fill="white"></x-i-arrow></span>
                        </div>
                        <div class="pt-2 pb-8  pr-8">
                            <p class="font-sans font-light text-2xl text-white leading-snug">
                                {!! $item['answer'] !!}
                            </p>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
    </section>
