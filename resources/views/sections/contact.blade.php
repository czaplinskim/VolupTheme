<section id="contact" class="bg-main lg:border-b relative">

    <div class="absolute w-full top-1/3 aspect-w-4 aspect-h-1 -translate-y-1/3 diagonal-line">
        <x-angle-line></x-angle-line>
    </div>

    <div class="grid lg:grid-cols-4 gap-x-20 2xl:gap-x-40 relative z-10">
        <div class="lg:col-span-2 order-2 lg:order-1">
            <img class="h-full w-full object-cover" src="{{ get_theme_mod('contact_media') ?: '' }}">
        </div>

        <div class=" lg:col-span-2 px-4  py-14 lg:py-36 order-1 lg:order-2">
        
            <div class="animate-text font-sans text-white uppercase font-semibold">
                <h5 class=" text-[64px] md:text-[96px] leading-none"> MASZ PYTANIA?</h5>
                 <p class="my-10 font-sans font-medium text-[26px] pl-1 text-white leading-snug max-w-[560px]">
                    {!! get_theme_mod('contact_text') ?: '' !!}
                </p>

                <img src="{{ get_theme_mod('volup_logo') ?: '' }}">

            </div>
        </div>
    </div>
</section>