/** @type {import('tailwindcss').Config} */
module.exports = {
  content:[
    './public/**/*.{html,php,js}', // Include all HTML files
    './app/views/**/*.{html,php,js}', // Include all PHP files in the views folder
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}