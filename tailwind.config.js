module.exports = {
  // mode: 'jit',
  // purge: { enabled: true, content: ['./index.php', './checkout.php', './customizeFoodMenu.php', './dashboard.php', './foodMain.php', './login.php', './signup.php', './page_not_found.php'], },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontSize: {
        'es': '0.0125rem',
      },
      fontFamily: {
        'Aventra': ['Aventra']
      },
    },
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
