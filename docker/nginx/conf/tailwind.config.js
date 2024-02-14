/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/*.{js,ts,php,html}',
    './controller/**/*.{js,ts,php,html}',
    './templates/**/*.{js,ts,php,html}',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
