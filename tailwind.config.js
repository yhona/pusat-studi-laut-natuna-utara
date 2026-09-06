/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./app/Controllers/**/*.php"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
      },
      colors: {
        navy: {
          800: '#0A2540',
          900: '#071A2E',
          950: '#04101D',
        },
        maritime: {
          50: '#F0F7FF',
          100: '#E0EFFE',
          500: '#0284C7',
          600: '#0369A1',
          700: '#075985',
          800: '#0C4A6E',
          900: '#083344',
        },
        gold: {
          400: '#FBBF24',
          500: '#F59E0B',
          600: '#D97706',
        },
        sand: '#F8FAFC'
      }
    },
  },
  plugins: [],
}
