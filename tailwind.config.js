/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        // 🔥 CORE BRAND COLORS
        'brand-black': '#0A0A0A',
        'brand-dark-gray': '#1A1A1A',
        'brand-mid-gray': '#2A2A2A',

        // 🔴 PRIMARY
        'brand-red': '#CC0000',
        'brand-red-light': '#FF2E2E',

        // ⚪ TEXT & NEUTRAL
        'brand-white': '#FFFFFF', // ✅ FIX ERROR KAMU
        'brand-silver': '#C0C0C0',
        'brand-text-gray': '#9CA3AF',

        // 🟢 WHATSAPP
        'brand-wa-green': '#25D366',
      },

      fontFamily: {
        heading: ['Montserrat', 'sans-serif'],
        body: ['Inter', 'sans-serif'],
      },

      // 🔥 OPTIONAL (BIAR LEBIH HALUS UI)
      boxShadow: {
        'red-glow': '0 10px 25px rgba(204, 0, 0, 0.25)',
      },
    },
  },
  plugins: [],
}