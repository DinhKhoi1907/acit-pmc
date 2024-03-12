/** @type {import('tailwindcss').Config} */

module.exports = {
    content: [
        // "./resources/views/*.blade.php",
        "./resources/views/components/*.blade.php",
        "./resources/views/desktop/*.blade.php",
        "./resources/views/desktop/**/*.blade.php",
        "./resources/views/desktop/**/**/*.blade.php",
        "./plugins/tw-elements/dist/js/**/*.js",
    ],
    theme: {
        extend: {
            screens: {
                "3xl": "1600px",
                "2xl": "1441px",
                xl: "1367px",
                sm: "500px",
                md: "640px",
                lg: "1025px",
            },
            lineClamp: {
                7: "7",
                8: "8",
                9: "9",
                10: "10",
            },
            colors: {
                primary: "#12A14A",
                secondary: "#101010",
            },
            backgroundImage: {
                danhmuc: "url('../../img/bgproduct.png')",
                bui: "url('../../img/bg_bui.jpg')",
                footer: "url('../../img/bg_footer2.jpg')",
            },
            fontFamily: {
                display: ["SVN-Gilroy", "sans-serif"],
                body: ["Roboto", "sans-serif"],
                Mulish: ["Roboto", "sans-serif"],
                Montserrat: ["Montserrat", "sans-serif"],
                Fasthand: ["Fasthand", "sans-serif"],
                Gilroy: ["SVN-Gilroy", "sans-serif"],
                Dancing: ["Dancing Script", "cursive"],
                Bona: ["Bona Nova", "sans-serif"],
                Poppins: ["Poppins", "sans-serif"],
                Roboto: ["Roboto", "sans-serif"],
            },
            container: {
                center: true,
                padding: "15px",
            },
            boxShadow: {
                shadow1: "0px 12px 22px rgba(0, 0, 0, 0.03)",
                shadow2: "10px 18px 26px rgba(0, 0, 0, 0.05)",
                shadow3: "0px 0px 30px rgba(0,0,0,8%)",
                shadow4: "0px 9px 23px rgba(60, 58, 0, 0.21)",
            },
            dropShadow: {
                drop1: "0px 4px 4px rgba(0, 0, 0, 0.25)",
            },
            colors: {
                cmain: "#39B54A",
                cmain1: "#D93832",
                cmain2: "#2D2D2D",
                cmain3: "#F8F7F1",
                cmain4: "#668945",

                cmain5: "#101010",
                cmain6: "#EB5757",
                cmain7: "#535353",
                cmain8: "#076C40",
            },
        },
    },
    corePlugins: {
        aspectRatio: false,
        preflight: false,
    },
    plugins: [
        require("@tailwindcss/line-clamp"),
        require("@tailwindcss/aspect-ratio"),
        require("@tailwindcss/forms"),
        require("tailwindcss-debug-screens"),
        require("flowbite/plugin"),
        require("tw-elements/dist/plugin"),
    ],
};
