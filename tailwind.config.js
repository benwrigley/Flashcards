/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
  safelist: [
	  'shadow-blue-300',
    'shadow-purple-400',
    'shadow-red-400',
    'shadow-green-400',
    'shadow-yellow-400',
    'shadow-gray-600',
    'shadow-pink-400'
   ]
}
