import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export function navbarInit() {

              $('#burger').on('click', function () {
                const menu = $('#slideMenu');
                const isOpen = menu.data('isopen');

                if (isOpen) {
                                      menu.hide(
                                        'slide',
                                        { direction: 'left' },
                                        500
                                      );

                                      $('#lastHr').removeClass('!w-full'); 

                } else {
                                  menu.show(
                                    'slide',
                                    { direction: 'left' },
                                    500
                                  );

                                    $('#lastHr').addClass('!w-full'); // Rozszerzenie ostatniego hr

                }

                menu.data('isopen', !isOpen);
              });

           // Opcjonalnie: Zamknięcie menu po kliknięciu w link
           $('#menu-menu-glowne a').on('click', function () {
             $('#slideMenu').hide('slide', { direction: 'left' }, 500);
              $('#slideMenu').data('isopen', false);
             $('#burger #lastHr').removeClass('!w-full');
           });

     const showAnim = gsap
       .from('#navbar', {
         yPercent: -100,
         paused: true,
         delay: 10,
         duration: 0.2,
       })
       .progress(1);

     ScrollTrigger.create({
       trigger: '#main',
       start: 'top -150',
       end: 'max',
       onUpdate: (self) => {
         self.direction === -1 ? showAnim.play() : showAnim.reverse();
       },
     });

}