const {extendDefaultPlugins} = require('svgo/lib/svgo-node');

module.exports = {
    multipass: true, // boolean. false by default
    datauri: false, // 'base64', 'enc' or 'unenc'. 'base64' by default
    plugins: extendDefaultPlugins([
        {
            name: 'removeScriptElement',
            active: true
        }
    ])
}
