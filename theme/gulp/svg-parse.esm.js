import gulp from 'gulp';
import del from 'del';
// import run from 'gulp-run';
import svgo from 'gulp-svgo';
import rename from 'gulp-rename';

function clearSvg(cb) {
    del('../public/wp-content/themes/asillywalk/templates/svg/', {
        force: true,
    })
        .catch()
        .then(() => cb());
}

// export function svgToCss(cb) {
//     run('node js/tools/svg-to-scss/svg-to-scss.js').exec('', cb);
// }

export function svgToTemplatePartial(cb) {
    gulp.src('svg/**/*.svg')
        .pipe(svgo())
        .pipe(
            rename((path) => {
                path.extname = '.html.twig';
            })
        )
        .pipe(
            gulp.dest('../public/wp-content/themes/asillywalk/templates/svg/')
        );

    cb();
}

export function watchSvg() {
    gulp.watch('svg/**/*.svg', { ignoreInitial: false }, buildSvg);
}
// export const buildSvg = gulp.series(clearSvg, svgToCss, svgToTemplatePartial);
export const buildSvg = gulp.series(clearSvg, svgToTemplatePartial);
