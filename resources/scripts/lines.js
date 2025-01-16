import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function animateLines({
  canvasSelector,
  triggerSelector,
  lines,
  color = '#FFFFFF',
  lineWidth = 1,
}) {
  // Pobierz element canvas
  const canvas = document.querySelector(canvasSelector);
  if (!canvas) {
    console.warn(`Canvas element not found for selector: ${canvasSelector}`);
    return;
  }
  const ctx = canvas.getContext('2d');

  // Ustaw wymiary canvas
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  // Funkcja rysująca linie
  function drawLines(progress = 0) {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Czyść canvas
    ctx.strokeStyle = color; // Ustaw kolor linii
    ctx.lineWidth = lineWidth; // Ustaw grubość linii

    lines.forEach((line) => {
      const totalLength = Math.sqrt(
        Math.pow(line.x2 - line.x1, 2) + Math.pow(line.y2 - line.y1, 2)
      ); // Długość linii

      const currentLength = totalLength * progress; // Aktualna długość do rysowania

      // Oblicz współrzędne punktu końcowego aktualnej długości
      const xCurrent =
        line.x1 + (line.x2 - line.x1) * (currentLength / totalLength);
      const yCurrent =
        line.y1 + (line.y2 - line.y1) * (currentLength / totalLength);

      ctx.beginPath();
      ctx.moveTo(line.x1, line.y1); // Start linii
      ctx.lineTo(xCurrent, yCurrent); // Aktualny koniec linii
      ctx.stroke();
    });
  }

  // Inicjalizacja animacji GSAP
  gsap.to(
    {},
    {
      duration: 6,
      scrollTrigger: {
        trigger: triggerSelector, // Element wyzwalający animację
        start: 'top center', // Start animacji
        end: 'bottom bottom', // Koniec animacji
        scrub: true, // Synchronizacja z przewijaniem
        onUpdate: (self) => {
          drawLines(self.progress); // Rysuj linie w oparciu o aktualny postęp scrollowania
        },
      },
    }
  );

  // Aktualizacja canvas podczas zmiany rozmiaru okna
  window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    drawLines(0); // Zresetuj rysowanie
  });
}
