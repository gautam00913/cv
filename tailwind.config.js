import defaultTheme from 'tailwindcss/defaultTheme';
import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                primary: 'teal',
                primaryBase: '#009688',
                primaryDark: '#00796b',
                primaryLight: '#e0f2f1',
                secondary: '#888888',
                secondaryLight: '#eeeeee',
            }
        },
    },
}
