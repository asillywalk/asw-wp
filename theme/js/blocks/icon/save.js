import classnames from 'classnames';
import { IconType } from './edit.js';
import { FontAwesomeIcon } from '@gebruederheitz/wp-editor-components';

const InnerWrapper = ({ linkUrl, children }) => {
    return linkUrl ? (
        <a
            className="wp-block-button__link"
            href={linkUrl}
            rel="noreferrer noopener"
            target="_blank"
        >
            {children}
        </a>
    ) : (
        <>{children}</>
    );
};

export const save = ({
    attributes: { iconSize, iconType, linkUrl, faIcon, caption, hasCaption },
}) => {
    let className;
    if (iconType !== IconType.THEME) {
        className = classnames('sn-icon', {
            'wp-block-button': !!linkUrl,
        });
    }

    return iconType === IconType.THEME ? null : (
        <figure className={className} style={`--sn-icon-size: ${iconSize}em;`}>
            <InnerWrapper linkUrl={linkUrl}>
                <>
                    {iconType === IconType.FONTAWESOME && faIcon && (
                        <FontAwesomeIcon icon={faIcon} />
                    )}
                    {iconType === IconType.FILE && (
                        <span>Not implemented.</span>
                    )}
                    {hasCaption && <figcaption>{caption}</figcaption>}
                </>
            </InnerWrapper>
        </figure>
    );
};
