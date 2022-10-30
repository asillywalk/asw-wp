import { blocks, i18n } from 'wp';

import { attributes } from './attributes.js';
import { edit } from './edit.js';
import { save } from './save.js';

const { registerBlockType } = blocks;
const { __ } = i18n;

const styles = [
    {
        name: 'default',
        label: 'Default',
        isDefault: true,
    },
    {
        name: 'moving-caption',
        label: 'Moving Caption',
    },
    {
        name: 'flying-caption',
        label: 'Flying Caption',
    },
];

registerBlockType('sillynet/icon', {
    title: __('Icon', 'sillynet'),
    icon: 'admin-customizer',
    description: __('Ein Icon, als Button, Kachel o.ä.', 'sillynet'),
    category: 'widgets',
    attributes,
    styles,
    edit,
    save,
});
