import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function elAnimationInit() {

  const images = gsap.utils.toArray('.animate-image');
  const p = gsap.utils.toArray('.animate-text');


  p.forEach((text, i) => {
    gsap.from(text, {
      y: 50, // Przesunięcie w osi Y
      duration: 1, // Czas trwania animacji
      scrollTrigger: {
        trigger: text, // Element, który wyzwala animację
        start: 'top 80%', // Animacja zaczyna się, gdy element jest w 80% widoku
        end: 'top 20%', // Animacja kończy się, gdy element dotrze do 20% widoku
        scrub: true, // Synchronizacja z przewijaniem
      },
    });
  });

   images.forEach((text, i) => {
     // Animacja dla obrazów
     gsap.from(text, {
       y: 50, // Przesunięcie w osi Y
       duration: 1.5,
       scrollTrigger: {
         trigger: text,
         start: 'top 90%',
         end: 'top 50%',
         scrub: true,
       },
     });
   });

 
   

}

