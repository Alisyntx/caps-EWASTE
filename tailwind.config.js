/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./views/**/*.{html,js,php}",
        "./src/**/**/*.{html,js,php}",
        "./src/**/**/**/*.{html,js,php}",
        "./views/*.{html,js,php}",
    ],
    theme: {
        extend: {},
        fontFamily: {
            popin: ["Poppins", "sans-serif"],
        },
        colors: {
            transparent: "transparent",
            current: "currentColor",
            bgbox: "#E8DFCA",
            bgtext: "#023106",
            bgdevider: "#0dac13",
            mainbg: "#F5EFE6",
            sidenavbg: "#46E84B",
            bgoutline: "#0e8713",
            bgcard: "#F2FFFC",
            bgborder: "#4F6F52",
            bgred: "#740938",
        },
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: false,
        darkTheme: "light",
    },
};
