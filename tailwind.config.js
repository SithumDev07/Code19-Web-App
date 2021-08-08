module.exports = {
  // mode: 'jit',
  // purge: ['./*.html',],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
    backgroundColor: theme => ({
      ...theme('colors'),
      'primary': '#343DFF',
     })
  },
  variants: {
    extend: {
      opacity: ['disabled'],
      scale: ['active'],
    },
    animation: ['responsive', 'motion-safe', 'motion-reduce']
  },
  plugins: [
    require('@tailwindcss/forms'),
    require("tailwindcss-selection-variant")
  ],
}
