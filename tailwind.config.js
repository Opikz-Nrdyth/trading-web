import withMT from "@material-tailwind/html/utils/withMT";

/** @type {import('tailwindcss').Config} */
export default withMT({
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#00A8E8", // warna biru cerah (misalnya dari header atau tombol)
                secondary: "#03ba00", // warna oranye cerah
                base: "#2f2f2f", // warna gelap untuk latar belakang dashboard
                "base-text": "#8A8A8F", // warna abu-abu teks
                "base-card": "#1f1f1f", // warna latar belakang kartu
                "base-side": "#242a33",
                "base-button": "#20262e",
                "base-input": "#252525",
                "base-input-disabled": "#111111",
                accent: "#00FF7F", // warna hijau terang untuk elemen interaktif
            },
            animation: {
                rotate: "rotate 2s linear infinite", // Nama animasi 'rotate', durasi 2 detik, rotasi terus menerus
            },
            keyframes: {
                rotate: {
                    "0%": { transform: "rotate(0deg)" }, // Mulai dari 0 derajat
                    "100%": { transform: "rotate(360deg)" }, // Akhirnya 360 derajat
                },
            },
        },
    },
    plugins: [],
});
