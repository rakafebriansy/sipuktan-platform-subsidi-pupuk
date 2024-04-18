module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      backgroundImage: {
        'hero-image': "url('/images/farmer.png')",
      }
    },
  },
  plugins: [
      require('flowbite/plugin')
  ],
}