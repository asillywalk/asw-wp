import gulp from 'gulp';
import realFavicon from 'gulp-real-favicon';
import fs from 'fs';

// File where the favicon markups are stored
const FAVICON_DATA_FILE = 'faviconData.json';

// Generate the icons. This task takes a few seconds to complete.
// You should run it at least once to create the icons. Then,
// you should run it whenever RealFaviconGenerator updates its
// package (see the check-for-favicon-update task below).
export function generateFavicon(done) {
    realFavicon.generateFavicon(
        {
            masterPicture: './img/asw-tlh_1000-hq.png',
            dest: '../public/wp-content/themes/asillywalk/img/favicon',
            iconsPath: '/img/favicons/',
            design: {
                ios: {
                    pictureAspect: 'backgroundAndMargin',
                    backgroundColor: '#ffffff',
                    margin: '14%',
                    assets: {
                        ios6AndPriorIcons: false,
                        ios7AndLaterIcons: false,
                        precomposedIcons: false,
                        declareOnlyDefaultIcon: true,
                    },
                },
                desktopBrowser: {
                    design: 'raw',
                },
                windows: {
                    pictureAspect: 'whiteSilhouette',
                    backgroundColor: '#00a300',
                    onConflict: 'override',
                    assets: {
                        windows80Ie10Tile: false,
                        windows10Ie11EdgeTiles: {
                            small: false,
                            medium: true,
                            big: false,
                            rectangle: false,
                        },
                    },
                },
                androidChrome: {
                    pictureAspect: 'noChange',
                    themeColor: '#ffffff',
                    manifest: {
                        display: 'standalone',
                        orientation: 'notSet',
                        onConflict: 'override',
                        declared: true,
                    },
                    assets: {
                        legacyIcon: false,
                        lowResolutionIcons: false,
                    },
                },
                safariPinnedTab: {
                    pictureAspect: 'silhouette',
                    themeColor: '#40766d',
                },
            },
            settings: {
                compression: 3,
                scalingAlgorithm: 'Lanczos',
                errorOnImageTooSmall: false,
                readmeFile: false,
                htmlCodeFile: false,
                usePathAsIs: false,
            },
            markupFile: FAVICON_DATA_FILE,
        },
        function () {
            done();
        }
    );
}

// Inject the favicon markups in your HTML pages. You should run
// this task whenever you modify a page. You can keep this task
// as is or refactor your existing HTML pipeline.
export function injectFaviconMarkups() {
    return gulp
        .src(['TODO: List of the HTML files where to inject favicon markups'])
        .pipe(
            realFavicon.injectFaviconMarkups(
                JSON.parse(fs.readFileSync(FAVICON_DATA_FILE)).favicon.html_code
            )
        )
        .pipe(
            gulp.dest(
                'TODO: Path to the directory where to store the HTML files'
            )
        );
}

// Check for updates on RealFaviconGenerator (think: Apple has just
// released a new Touch icon along with the latest version of iOS).
// Run this task from time to time. Ideally, make it part of your
// continuous integration system.
export function checkForFaviconUpdate() {
    const currentVersion = JSON.parse(
        fs.readFileSync(FAVICON_DATA_FILE)
    ).version;
    realFavicon.checkForUpdates(currentVersion, function (err) {
        if (err) {
            throw err;
        }
    });
}
