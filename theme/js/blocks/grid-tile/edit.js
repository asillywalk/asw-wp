import { blockEditor, components, element } from 'wp';

const { InnerBlocks } = blockEditor;
const { Placeholder, SelectControl } = components;
const { Component } = element;

const ALLOWED_BLOCKS_AND_LABELS = {
    'core/shortcode': 'Shortcode',
    'core/buttons': 'Button',
    'core/paragraph': 'Paragraph',
    'sillynet/icon': 'Icon',
};

class Edit extends Component {
    getAllowedBlocks() {
        return Object.keys(ALLOWED_BLOCKS_AND_LABELS);
    }

    getTemplate() {
        const {
            attributes: { type = null },
        } = this.props;
        return [[type, []]];
    }

    getTypeOptions() {
        const options = [{ label: '-- Block Type --', value: '' }];

        Object.keys(ALLOWED_BLOCKS_AND_LABELS).forEach((value) => {
            options.push({
                label: ALLOWED_BLOCKS_AND_LABELS[value],
                value,
            });
        });

        return options;
    }

    render() {
        const {
            attributes: { type = null },
            setAttributes,
        } = this.props;

        return type !== null ? (
            <div className="sn-grid-tile">
                <InnerBlocks
                    allowedBlocks={this.getAllowedBlocks()}
                    renderAppender={false}
                    templateLock={'all'}
                    template={this.getTemplate()}
                />
            </div>
        ) : (
            <Placeholder
                label={'Grid Item'}
                instructions={'Please select a block type to use'}
            >
                <SelectControl
                    label={'Block type'}
                    value={type}
                    options={this.getTypeOptions()}
                    onChange={(type) => {
                        setAttributes({ type });
                    }}
                />
            </Placeholder>
        );
    }
}

export const edit = Edit;
