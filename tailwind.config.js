module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {
      opacity: ['disabled'],
      scale: ['active']
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require("tailwindcss-selection-variant")
  ],
}
