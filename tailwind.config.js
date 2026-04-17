/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Modules/**/Views/**/*.php",
    "./app/Modules/Shared/Views/**/*.php",
    "./app/Views/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        'klinik-primary': '#4154f1',
        'klinik-secondary': '#717ff5',
        'klinik-dark': '#012970',
      },
      fontFamily: {
        'sans': ['Nunito', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
