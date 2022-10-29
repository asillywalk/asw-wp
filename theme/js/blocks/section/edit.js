import { blockEditor } from 'wp';

import { DiscreetInput } from '@gebruederheitz/wp-editor-components';

const { InnerBlocks } = blockEditor;

const Edit = (props) => {
    return (
        <section className={'section'}>
            <div id={''} className={'section__content'}>
                <h1>
                    <DiscreetInput
                        labelText={'Sektions-Überschrift'}
                        valueKey={'title'}
                        {...props}
                    />
                </h1>
                <div className={'section__body'}>
                    <InnerBlocks
                        renderAppender={InnerBlocks.ButtonBlockAppender}
                        templateLock={false}
                    />
                </div>
            </div>
        </section>
    );
};

export const edit = Edit;
