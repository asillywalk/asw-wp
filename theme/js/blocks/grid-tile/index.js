import { blocks, i18n } from 'wp';

import { attributes } from './attributes.js';
import { edit } from './edit.js';
import { save } from './save.js';

const { registerBlockType } = blocks;
const { __ } = i18n;

const styles = [
    {
        name: 'default',
        label: 'Small',
        isDefault: true,
    },
    {
        name: 'wider',
        label: 'Wider',
    },
    {
        name: 'wide',
        label: 'Wide',
    },
    {
        name: 'larger',
        label: 'Larger',
    },
    {
        name: 'large',
        label: 'Large',
    },
    {
        name: 'high',
        label: 'High',
    },
];

registerBlockType('sillynet/grid-tile', {
    title: __('Grid Tile', 'sillynet'),
    icon: 'editor-table',
    description: __('Eine Kachel für Media-Grid-Sektionen', 'sillynet'),
    category: 'layout',
    parent: ['sillynet/section'],
    attributes,
    styles,
    edit,
    save,
});
