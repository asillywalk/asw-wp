import whenDomReady from 'when-dom-ready';
import { LightboxFactory } from '@gebruederheitz/wp-block-video-overlay/dist/frontend.js';

function safeExec(name, callback, ...args) {
    try {
        callback(...args);
    } catch (e) {
        console.error(`Failed to load module ${name}: `, e);
    }
}

console.log('blargo');

whenDomReady().then(() => {
    safeExec('Lightboxes', () => {
        const lf = new LightboxFactory();
        lf.images();
    });
});
