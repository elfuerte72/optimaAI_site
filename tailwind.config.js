/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue"
  ],
  theme: {
    extend: {
      borderRadius: {
        'sm': '0.125rem',
        'md': '0.375rem',
        'lg': '0.5rem',
        'xl': '1rem',
        '2xl': '1.5rem',
      },
      transitionDuration: {
        '300': '300ms',
        '400': '400ms',
      },
      backdropBlur: {
        'none': '0',
        'sm': '4px',
        'DEFAULT': '8px',
        'md': '12px',
        'lg': '16px',
        'xl': '24px',
        '2xl': '40px',
        '3xl': '64px',
      },
      colors: {
        'purple': {
          '50': '#f5f3ff',
          '100': '#ede9fe',
          '200': '#ddd6fe',
          '300': '#c4b5fd',
          '400': '#a78bfa',
          '500': '#8b5cf6',
          '600': '#7c3aed',
          '700': '#6d28d9',
          '800': '#5b21b6',
          '900': '#4c1d95',
        },
      },
      zIndex: {
        '100': '100',
      },
      spacing: {
        '18': '4.5rem',
      },
    },
  },
  plugins: [],
} 