import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function animateLines2() {

     $('.court-line line').each(function (index) {
       const $line = $(this);
       const x1 = parseFloat($line.attr('x1'));
       const y1 = parseFloat($line.attr('y1'));
       const x2 = parseFloat($line.attr('x2'));
       const y2 = parseFloat($line.attr('y2'));

       // Ustaw początkowe wartości linii (niewidoczna)
       $line.attr({ x2: x1, y2: y1 });

       // Animacja GSAP
       gsap.to($line[0], {
         attr: { x2: x2, y2: y2 }, // Docelowe wartości
         duration: 1.5, // Czas trwania animacji
         ease: 'power1.out',
         scrollTrigger: {
           trigger: $line.closest('section'), // Sekcja jako element wyzwalający animację
           start: 'top bottom',
           end: 'center center',
           scrub: true, // Synchronizacja z przewijaniem
         },
       });
     });


    $('.diagonal-line line').each(function () {

      const $line = $(this);
        // Zastosuj animację GSAP
        gsap.to($line[0], {
          attr: { x2: 100, y2: 0 },
          duration: 1,
          ease: 'power1.out',
          scrollTrigger: {
            trigger: $line.closest('section'), // Element wrappera wyzwalający animację
            start: 'top center',
            end: 'center center',
            scrub: true, // Synchronizacja z przewijaniem
          },
        });
      
    });

  // Animacja poziomej linii
  $('.horizontal-line line').each(function () {
    const $line = $(this);
    gsap.fromTo(
      $line[0],
      { strokeDasharray: '100 100', strokeDashoffset: 100 }, // Linia początkowo ukryta
      {
        strokeDashoffset: 0, // Linia narysowana
        duration: 1,
        ease: 'power1.out',
        scrollTrigger: {
          trigger: $line.closest('section'), // Element wyzwalający animację
          start: 'top center',
          end: 'center center',
          scrub: true, // Synchronizacja z przewijaniem
        },
      }
    );
  });

  // Animacja pionowej linii
  $('.vertical-line line').each(function () {
    const $line = $(this);

    gsap.fromTo(
      $line[0],
      { strokeDasharray: '100 100', strokeDashoffset: 100 },
      {
        strokeDashoffset: 0,
        duration: 1,
        ease: 'power1.out',
        scrollTrigger: {
          trigger: $line.closest('section'),
          start: 'top center',
          end: 'center center',
          scrub: true,
        },
      }
    );
  });
}
