<footer class="bg-main min-h-[100px] px-4 py-4 lg:px-6 flex items-center justify-between flex-wrap gap-x-2 text-white font-sans text-base uppercase">
        @if (has_nav_menu('footer_navigation'))
          <nav class="flex flex-row items-baseline" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
            {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'list-none	flex gap-6	 [&>*>a]:text-white [&>*>a]:whitespace-nowrap	 [&>*>a]:underline', 'echo' => false]) !!}
          </nav>
          @endif

          <p>© Stowarzyszenie Warszawski Klub Sportowy „Volup” </p>
</footer>
