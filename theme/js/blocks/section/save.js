import { blockEditor } from 'wp';

const { InnerBlocks } = blockEditor;

const Save = ({ attributes: { title }}) => {
    return (
        <section className={'section'}>
            <div id={''} className={'section__content'}>
                <h1>{title}</h1>
                <div className={'section__body'}>
                    <InnerBlocks.Content />
                </div>
            </div>
        </section>
    )
};

export const save = Save;
