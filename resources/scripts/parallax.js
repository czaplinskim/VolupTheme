import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function parallaxInit() {
  gsap.to('#parallaxHeader', {
    backgroundPositionY: '10%',
    ease: 'none',
    scrollTrigger: {
      trigger: '#parallaxHeader',
      start: 'top top',
      end: 'bottom top',
      scrub: true,
    },
  });
}
