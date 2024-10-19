/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {
      colors: {
        darkblue: {
          100: '#1a1f36',
          200: '#151935',
          300: '#10122e',
          400: '#0a0c29',
          500: '#050922',
          600: '#04081d',
          700: '#030617',
          800: '#020512',
          900: '#01030c',
        },
        whiteblue: {
          100: '#E6F9FD',
          200: '#C2F1FB',
          300: '#9DE8F9',
          400: '#78E0F7',
          500: '#0CAEEE',
          600: '#099FC7',
          700: '#07819F',
          800: '#055376',
          900: '#03334D',
        },
      },
    },
  },
  plugins: [
      require('flowbite/plugin')
  ],
}