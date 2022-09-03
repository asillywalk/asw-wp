module.exports = {
    extends: ['stylelint-config-standard-scss', 'stylelint-config-prettier'],
    rules: {
        'selector-class-pattern': null,
        'no-descending-specificity': null,
        'color-function-notation': 'legacy',
        'alpha-value-notation': 'number',
        'scss/dollar-variable-empty-line-before': null,
        'scss/operator-no-unspaced': null,
        'property-no-vendor-prefix': [
            true,
            {
                ignoreProperties: ['appearance', 'text-size-adjust'],
            },
        ],
        // up for debate
        'scss/at-extend-no-missing-placeholder': null,
        'declaration-block-no-redundant-longhand-properties': null,
    },
    ignoreFiles: [
        'scss/vendor/*'
    ]
};
