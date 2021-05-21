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
    spinner:(theme) => ({
      defualt : {
        color : '#dae1e7',
        size : '1em',
        border : '2px',
        speed : '500ms',
      },
    })
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('tailwindcss-spinner')(),
  ],
}
