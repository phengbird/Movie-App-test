module.exports = {
  purge: [
    './resources/**/*.blade.php',
     './resources/**/*.js',
     './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      '96' : '24rem'
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
