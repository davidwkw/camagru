/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './static/*.{js,ts,php,html}',
    './public/*.{js,ts,php,html}',
    './view/templates/*',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
