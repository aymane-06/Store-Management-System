/** @type {import('tailwindcss').Config} */
module.exports = {
  content:[
    './public/**/*.{html,php,js}', // Include all HTML files
    './app/views/**/*.{html,php,js}', // Include all PHP files in the views folder
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f2f6ff',   // lightest shade
          100: '#e0ebff',  // lighter shade
          200: '#b3ccff',  // light
          300: '#80aaff',  // base light
          400: '#4d8cff',  // slightly lighter
          500: '#1a66ff',  // base (primary color)
          600: '#0055cc',  // darker
          700: '#0044aa',  // darker
          800: '#003388',  // darkest
          900: '#002266',  // very dark
        },
      },
    },
  },
  plugins: [],
}