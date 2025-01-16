<section id="rules" class="bg-main relative overflow-hidden px-4 md:px-14">    
        <div class="max-w-3xl mx-auto py-14 xl:py-36">

            <div class="relative text-animate text-sans text-[64px] lg:text-[120px] text-white uppercase font-semibold space-y-14 xl:space-y-20 z-10">
                <div class="space-y-6 md:space-y-0">
                    @for ($i = 1; $i <= 3; $i++)
                        <h3 class="leading-[0.9] md:leading-none">{{ get_theme_mod("rules_item_$i") ?: '' }}</h3>
                    @endfor
                </div>

                @php
                    $file_url = get_theme_mod('rules_file', '');
                @endphp

                @if ($file_url)
                    <a href="{{ esc_url($file_url) }}" target="_blank" class="underline text-[24px]">Pobierz regulamin</a>
                @endif

            </div>

             <div class="absolute right-0 top-1/2 -translate-y-1/2 h-full py-14 xl:py-20 flex justify-end">
                <img class="object-cover animate-image h-full w-1/2 md:w-2/3 lg:w-auto" src="{{ get_theme_mod('rules_media') ?: '' }}">
            </div>

             
        </div>
</section>