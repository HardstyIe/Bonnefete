/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}"],
  theme: {
    extend: {
      backgroundColor: {
        primary: "#38413d",
        secondary: "#d9d9d9",
        bg: "#62796f",
      },
    },
  },
  plugins: [require("daisyui")],
};
