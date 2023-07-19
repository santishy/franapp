module.exports = {
    darkMode: false,
    future: {
        // removeDeprecatedGapUtilities: true,
        // purgeLayersByDefault: true,
    },
    content: [
        "./resources/js/components/*.vue",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            transitionProperty: {
                height: "height",
                spacing: " padding",
                display: "display",
            },
            colors: {
                primary: '#0098DA',
                secondary: '#4E4E4E',
            },
        },
        zIndex: {
            0: 0,
            5: 5,
            10: 10,
            20: 20,
            30: 30,
            40: 40,
            50: 50,
            25: 25,
            50: 50,
            75: 75,
            100: 100,
            "-10": -10,
            auto: "auto",
        },

    },
    // variants: {
    //     tableLayout: ["responsive", "hover", "focus"],
    //     borderWidth: ["responsive", "last", "hover", "focus"],
    //     borderColor: ["responsive", "hover", "focus", "active", "group-hover"],
    // },
    plugins: [],
};
