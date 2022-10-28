import { blocks, i18n } from 'wp';
import { CropFree } from '@gebruederheitz/wp-editor-components/dist/icons';

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
        name: 'pieces',
        label: 'Pieces',
    },
    {
        name: 'media-grid',
        label: 'Media Grid',
    },
];

registerBlockType('sillynet/section', {
    title: __('Section', 'sillynet'),
    icons: <CropFree />,
    description: __(
        'Ein Container zur Unterteilung des Inhaltes in Abschnitte',
        'sillynet'
    ),
    category: 'layout',
    attributes,
    styles,
    edit,
    save,
});
