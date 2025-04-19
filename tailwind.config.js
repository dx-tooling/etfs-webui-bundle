/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./src/**/templates/**/*.html.twig",
        "./vendor/enterprise-tooling-for-symfony/**/assets/*.js",
        "./vendor/enterprise-tooling-for-symfony/**/templates/**/*.html.twig",
    ],
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#eff6ff',  // blue-50
                    100: '#dbeafe', // blue-100
                    200: '#bfdbfe', // blue-200
                    300: '#93c5fd', // blue-300
                    400: '#60a5fa', // blue-400
                    500: '#3b82f6', // blue-500
                    600: '#2563eb', // blue-600
                    700: '#1d4ed8', // blue-700
                    800: '#1e40af', // blue-800
                    900: '#1e3a8a', // blue-900
                    950: '#172554'  // blue-950
                },
                secondary: {
                    50: '#f9fafb',  // gray-50
                    100: '#f3f4f6', // gray-100
                    200: '#e5e7eb', // gray-200
                    300: '#d1d5db', // gray-300
                    400: '#9ca3af', // gray-400
                    500: '#6b7280', // gray-500
                    600: '#4b5563', // gray-600
                    700: '#374151', // gray-700
                    800: '#1f2937', // gray-800
                    900: '#111827', // gray-900
                    950: '#030712', // gray-950
                },
                danger: {
                    50: '#fef2f2', // red-50
                    100: '#fee2e2', // red-100
                    200: '#fecaca', // red-200
                    300: '#fca5a5', // red-300
                    400: '#f87171', // red-400
                    500: '#ef4444', // red-500
                    600: '#dc2626', // red-600
                    700: '#b91c1c', // red-700
                    800: '#991b1b', // red-800
                    900: '#7f1d1d', // red-900
                    950: '#450a0a'  // red-950
                },
                warning: {
                    50: '#fffbeb',  // yellow-50
                    100: '#fef3c7', // yellow-100
                    200: '#fde68a', // yellow-200
                    300: '#fcd34d', // yellow-300
                    400: '#fbbf24', // yellow-400
                    500: '#f59e0b', // yellow-500
                    600: '#d97706', // yellow-600
                    700: '#b45309', // yellow-700
                    800: '#92400e', // yellow-800
                    900: '#78350f', // yellow-900
                    950: '#451a03'  // yellow-950
                },
                success: {
                    50: '#f0fdf4',  // green-50
                    100: '#dcfce7', // green-100
                    200: '#bbf7d0', // green-200
                    300: '#86efac', // green-300
                    400: '#4ade80', // green-400
                    500: '#22c55e', // green-500
                    600: '#16a34a', // green-600
                    700: '#15803d', // green-700
                    800: '#166534', // green-800
                    900: '#14532d', // green-900
                    950: '#052e16'  // green-950
                },
                info: {
                    50: '#eff6ff',  // blue-50 (reusing primary)
                    100: '#dbeafe', // blue-100
                    200: '#bfdbfe', // blue-200
                    300: '#93c5fd', // blue-300
                    400: '#60a5fa', // blue-400
                    500: '#3b82f6', // blue-500
                    600: '#2563eb', // blue-600
                    700: '#1d4ed8', // blue-700
                    800: '#1e40af', // blue-800
                    900: '#1e3a8a', // blue-900
                    950: '#172554'  // blue-950
                },
                dark: { // Renaming to gray to match Tailwind convention
                    50: '#f9fafb',  // gray-50
                    100: '#f3f4f6', // gray-100
                    200: '#e5e7eb', // gray-200
                    300: '#d1d5db', // gray-300
                    400: '#9ca3af', // gray-400
                    500: '#6b7280', // gray-500
                    600: '#4b5563', // gray-600
                    700: '#374151', // gray-700
                    800: '#1f2937', // gray-800
                    900: '#111827', // gray-900
                    950: '#030712'  // gray-950
                },
                purple: {
                    50: '#faf5ff', 100: '#f3e8ff', 200: '#e9d5ff', 300: '#d8b4fe',
                    400: '#c084fc', 500: '#a855f7', 600: '#9333ea', 700: '#7e22ce',
                    800: '#6b21a8', 900: '#581c87', 950: '#3b0764'
                },
                indigo: {
                    50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc',
                    400: '#818cf8', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca',
                    800: '#3730a3', 900: '#312e81', 950: '#1e1b4b'
                }
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
    prefix: "",
};
