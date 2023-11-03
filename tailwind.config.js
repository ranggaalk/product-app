/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      'node_modules/preline/dist/*.js',
    ],
    theme: {
      extend: {
        colors: {
            'primary': '#4253F0',
            'secondary': '#DCDDE1',
            'danger': '#F05742',
            'warning': '#F0BF42',
            'text-color': '#475774',
            'bg-color': '#F2F9FF',
            'light-color': '#BDD2E0'
        }
      },
    },
    plugins: [
        require('preline/plugin'),
    ],
  }
