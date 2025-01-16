@php

  $bg_image = get_header_image() ?: @asset('images/bg.jpeg');
  $logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ?: @asset('images/logo.svg');

  $current_lang = isset($_SERVER['HTTP_X_GT_LANG']) ? $_SERVER['HTTP_X_GT_LANG'] : '';
  $swtich_lang = $current_lang === 'en' ? 'pl' : 'en';

@endphp


<header id="parallaxHeader" class="w-full h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('{{ get_header_image() }}');">
  <div id='navbar' class='max-w-monitor w-full mx-auto flex justify-between items-center px-4 md:px-14 py-4 md:py-12 fixed z-50'>
      <a href='{{ site_url()  }}'>
              <img class='pt-1 h-12 md:h-14' src='{!! $logo !!}'>
      </a>
      <div class='flex' >
  

            <x-burger/>


            <div class="lang-buttons font-light text-sm gap-1 flex items-center flex-nowrap mx-5">
                {!! do_shortcode('[gt-link lang="' . $swtich_lang .'" widget_look="flags"]') !!}
            </div>

           
      </div>
  </div>

  <div class='h-full flex flex-col justify-end px-4 md:px-14 py-20'>
    <h1 class='font-sans text-white text-[96px] md:text-[140px] font-semibold leading-none'>
      WARSAW<br/>VOLUP SQUASH CUP
    </h1>
  </div>

     <div id="slideMenu" data-isopen='false' class="hidden fixed inset-y-0  bg-main text-white flex-col items-center justify-center z-40 w-full overflow-scroll">
      <div class=' pt-28 pb-20 w-full min-h-full grid items-center justify-stretch overflow-scroll'>
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'font-sans font-medium text-3xl uppercase text-center divide-y-[1px] divide-white flex flex-col w-full font-sans [&>li]:py-4', 'echo' => false]) !!}

        <div class='text-center mt-10 flex justify-center items-end h-full'>
          <a href='{{ get_theme_mod('page_settings_register_url') ?: '' }}' target="_blank" rel="noref" class="font-medium text-center underline text-3xl">DOŁĄCZ DO TURNIEJU</a> 
        </div>

      </div>

  </div>
</header>
