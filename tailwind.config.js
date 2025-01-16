/** @type {import('tailwindcss').Config} config */
const config = {
  content: ['./app/**/*.php', './resources/**/*.{php,vue,js}'],
  theme: {
    extend: {
      spacing: {
        px: '1px', // Dodaje dokładną wysokość/szerokość 1px
      },
      textStroke: {
        DEFAULT: '1px white', // Domyślny obrys
      },
      fontFamily: {
        sans: 'Barlow Condensed',
      },
      fontSize: {
        xl: '22px',
      },
      height: {
        0.5: '1.5px',
      },
      colors: {
        main: '#141858',
        pink: '#EE7C72',
      }, // Extend Tailwind's default colors
      maxWidth: {
        'xl': '1020px',
        '2xl': '1210px',
        '3xl': '1440px',
        monitor: '1920px',
      },
    },
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
    function ({ addUtilities }) {
      addUtilities({
        '.text-stroke': {
          color: 'transparent',
          '-webkit-text-stroke': '1px white',
        },
      });
    },
  ],
};

export default config;
