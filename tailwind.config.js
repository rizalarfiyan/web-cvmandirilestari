/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "node_modules/preline/dist/*.js",
  ],
  darkMode: "classes",
  theme: {
    extend: {
      colors: {
        primary: {
          "50": "#fefce8",
          "100": "#fef9c3",
          "200": "#fef08a",
          "300": "#fde047",
          "400": "#facc15",
          "500": "#eab308",
          "600": "#ca8a04",
          "700": "#a16207",
          "800": "#854d0e",
          "900": "#713f12",
          "950": "#422006"
        }
      },
      boxShadow: {
        'smooth': 'rgba(149, 157, 165, 0.08) 0px 8px 24px',
      }
    },
  },
  plugins: [
      require('preline/plugin'),
  ],
}
