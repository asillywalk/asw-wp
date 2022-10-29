import classnames from 'classnames';
import { blockEditor } from 'wp';

const { InnerBlocks } = blockEditor;

export const save = ({ className }) => {
    return (
        <div className={classnames('sn-grid-tile', className)}>
            <InnerBlocks.Content />
        </div>
    );
};
