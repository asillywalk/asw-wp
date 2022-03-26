import gulp from 'gulp';

import sass from 'gulp-dart-sass';
import postcss from 'gulp-postcss';

/* PostCSS tasks */
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';
import flexbugsFixes from 'postcss-flexbugs-fixes';
import focusWithin from 'postcss-focus-within';
import pkgVersion from '@gebruederheitz/postcss-pkg-version-to-stylesheet';

const DEFAULT_CONFIG = {
    postcss: {},
    in: './scss/**/*.scss',
    out: './dist',
    watch: null,
};

const WORDPRESS_FRONTEND_DEFAULT_CONFIG = {
    postcss: { flexbugs: true, focusWithin: true, pkgVersion: true },
    in: './style.scss',
    out: '../public/wp-content/themes/ghwp/',
    watch: ['style.scss', '!scss/editor/', 'scss/**/*.scss'],
};

const configFrontend = {
    ...WORDPRESS_FRONTEND_DEFAULT_CONFIG,
};

const WORDPRESS_BACKEND_DEFAULT_CONFIG = {
    in: './style-editor.scss',
    out: '../public/wp-content/themes/ghwp/',
    watch: [
        'style-editor.scss',
        '!scss/editor/editor-controls.scss',
        'scss/**/*.scss',
    ],
};

const configBackend = {
    ...WORDPRESS_BACKEND_DEFAULT_CONFIG,
};

const configControls = {
    in: './scss/editor/editor-controls.scss',
    out: '../public/wp-content/themes/ghwp/',
    watch: ['scss/editor/editor-controls.scss'],
};

let CURRENT_TASK_IS_WATCH = false;

function _buildScss(config) {
    config = {
        ...DEFAULT_CONFIG,
        ...config,
    };

    const postcssTasks = [autoprefixer];

    if (config) {
        if (config.postcss && config.postcss.flexbugs) {
            postcssTasks.push(flexbugsFixes);
        }

        if (config.postcss && config.postcss.focusWithin) {
            postcssTasks.push(focusWithin);
        }

        if (config.postcss && config.postcss.pkgVersion) {
            postcssTasks.push(pkgVersion);
        }

        if (!CURRENT_TASK_IS_WATCH) {
            postcssTasks.push(cssnano);
        }
    }

    return gulp
        .src(config.in, { sourcemaps: true })
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(postcssTasks))
        .pipe(gulp.dest(config.out, { sourcemaps: '.' }));
}

function watchScss(config, callback) {
    config = {
        ...DEFAULT_CONFIG,
        ...config,
    };

    CURRENT_TASK_IS_WATCH = true;
    gulp.watch(config.watch || config.in, { ignoreInitial: false }, callback);
}

function getScssBuildAndWatch(config) {
    const build = (cb) => {
        _buildScss(config);

        cb();
    };

    return {
        build,
        watch: () => {
            watchScss(config, build);
        },
    };
}

const { build: buildFrontend, watch: watchFrontend } =
    getScssBuildAndWatch(configFrontend);
const { build: buildEditor, watch: watchEditor } =
    getScssBuildAndWatch(configBackend);
const { build: buildControls, watch: watchControls } =
    getScssBuildAndWatch(configControls);

const watchScssAll = gulp.parallel(watchFrontend, watchEditor, watchControls);

export const watch = watchScssAll;
export default gulp.parallel(buildFrontend, buildEditor, buildControls);
