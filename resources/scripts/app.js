import domReady from '@roots/sage/client/dom-ready';
import { navbarInit } from './navbar.js';
import { parallaxInit } from './parallax.js';
import { elAnimationInit } from './el-animations.js';
import { animateLines } from './lines';
import { animateLines2 } from './lines2';
import { accordionInit } from './accordion.js'

/**
 * Application entrypoint
 */
domReady(async () => {

  elAnimationInit();
  parallaxInit();
  navbarInit();
  accordionInit();
  animateLines2();
  animateLines({
    canvasSelector: '#backgroundCanvas', // Canvas dla sekcji 1
    triggerSelector: '.bg-main', // Wyzwalacz dla sekcji 1
    lines: [
      { x1: 500, y1: 0, x2: 500, y2: 400 },
      { x1: 500, y1: 400, x2: 1000, y2: 400 },
      { x1: 0, y1: 700, x2: 1000, y2: 700 },
      { x1: 1000, y1: 0, x2: 1000, y2: 1343 },
    ],
    color: '#FFFFFF',
    lineWidth: 1,
  });

  animateLines({
    canvasSelector: '#detailsCanvas', // ID canvasu dla tej sekcji
    triggerSelector: '.details', // Wyzwalacz dla tej sekcji
    lines: calculateResponsiveLineCoordinates(), // Oblicz współrzędne dynamicznie
    color: '#FFFFFF', // Kolor linii
    lineWidth: 1, // Grubość linii
  });
  
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);


/**
 * Custom functions and helpers
 */

function calculateResponsiveLineCoordinates() {
    const width = window.innerWidth; 
    const height = 337; 
    return [
        { x1: -50, y1: height, x2: width + 50, y2: height * 0.2 },
    ];
}