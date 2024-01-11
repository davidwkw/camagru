/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './controller/*.{js,ts,php,html}',
    './view/pages/**/*.{js,ts,php,html}',
    './view/js/**/*.{js,ts,php,html}',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
