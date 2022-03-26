import resolve from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import babel from 'rollup-plugin-babel';
import { terser } from 'rollup-plugin-terser';

const production = !process.env.ROLLUP_WATCH;

export default {
    external: ['wp'],
    input: 'js/backend.js',
    output: {
        file: '../public/wp-content/themes/ghwp/js/backend.js',
        format: 'iife',
        sourcemap: true,
        globals: {
            wp: 'wp',
        },
    },
    plugins: [
        resolve(),
        babel({
            babelrc: true,
            exclude: 'node_modules/**',
            sourceMaps: true,
            inputSourceMap: true,
        }),
        commonjs(),
        production && terser(),
    ],
};
