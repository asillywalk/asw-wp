import resolve from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import babel from '@rollup/plugin-babel';
import { terser } from 'rollup-plugin-terser';

const production = !process.env.ROLLUP_WATCH;

export default {
    external: ['wp'],
    input: 'js/editor.js',
    output: {
        file: '../public/wp-content/themes/asillywalk/js/editor.js',
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
            babelHelpers: 'bundled',
        }),
        commonjs(),
        production && terser(),
    ],
};
