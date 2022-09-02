import resolve from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import babel from 'rollup-plugin-babel';
import { terser } from 'rollup-plugin-terser';

const production = !process.env.ROLLUP_WATCH;
export default {
    input: 'js/main.js',
    external: ['jquery'],
    output: {
        file: '../public/wp-content/themes/asillywalk/js/main.js',
        format: 'iife',
        sourcemap: true,
        // globals: {
        //     jquery: 'window.jQuery',
        // },
    },
    plugins: [
        resolve(),
        commonjs(),
        babel({
            babelrc: false,
            exclude: [/\/core-js\//],
            presets: [
                [
                    '@babel/preset-env',
                    {
                        useBuiltIns: 'usage',
                        corejs: 3,
                    },
                ],
            ],
            plugins: ['@babel/plugin-transform-template-literals'],
        }),
        production && terser(),
    ],
};
