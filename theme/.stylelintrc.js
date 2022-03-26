module.exports = {
    extends: ['stylelint-config-standard-scss', 'stylelint-config-prettier'],
    rules: {
        indentation: 4,
        'selector-class-pattern': null,
        'no-descending-specificity': null,
        'color-function-notation': 'legacy',
        'alpha-value-notation': 'number',
        'property-no-vendor-prefix': [
            true,
            {
                ignoreProperties: ['appearance', 'text-size-adjust'],
            },
        ],
    },
};
