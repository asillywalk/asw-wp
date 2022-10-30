/* global editorData */
import { blockEditor, components } from 'wp';
import {
    DiscreetInput,
    FontAwesomeIcon,
    FontAwesomePicker,
} from '@gebruederheitz/wp-editor-components';
import {
    PhotoResizeSelectLarge,
    Stars,
    SwapHoriz,
    TextFields,
} from '@gebruederheitz/wp-editor-components/dist/icons.js';

const { BlockControls, URLInputButton } = blockEditor;
const { SelectControl, Placeholder, ToggleControl, RangeControl, Toolbar } =
    components;

export const IconType = {
    THEME: 'theme',
    FONTAWESOME: 'fontawesome',
    FILE: 'file',
};

const svgIconStyles = {
    width: '32px',
    height: '32px',
};

const IconComponent = ({ icon: Icon }) => {
    return (
        <div className="sn-icon-setting__icon">
            <Icon style={svgIconStyles} />
        </div>
    );
};

const TypeSelect = (props) => {
    const {
        attributes: { iconType = null },
        setAttributes,
    } = props;

    return (
        <SelectControl
            label={'Icon Source'}
            options={[
                {
                    label: '-- Select type / source --',
                    value: '',
                },
                {
                    label: 'Theme Icons',
                    value: IconType.THEME,
                },
                {
                    label: 'FontAwesome',
                    value: IconType.FONTAWESOME,
                },
                {
                    label: 'File / Media Library',
                    value: IconType.FILE,
                },
            ]}
            value={iconType}
            onChange={(iconType) => {
                setAttributes({ iconType });
            }}
        />
    );
};

const IconSelect = (props) => {
    const {
        attributes: { iconType, themeIcon, faIcon },
        setAttributes,
    } = props;
    return (
        <>
            {iconType === IconType.THEME && (
                <SelectControl
                    value={themeIcon}
                    label={'Theme Icon'}
                    options={[
                        { label: '-- Select icon --', value: '' },
                        ...editorData.themeIcons.map((iconName) => ({
                            label: iconName,
                            value: iconName,
                        })),
                    ]}
                    onChange={(themeIcon) => {
                        setAttributes({ themeIcon });
                    }}
                />
            )}
            {iconType === IconType.FONTAWESOME && (
                <div className="components-base-control sn-editor-fa-input">
                    <label>FontAwesome Icon Selector</label>
                    <FontAwesomePicker
                        icon={faIcon}
                        onChange={(faIcon) => {
                            setAttributes({ faIcon });
                        }}
                    />
                </div>
            )}
            {iconType === IconType.FILE && <p>To be implemented</p>}
        </>
    );
};

const Edit = (props) => {
    const {
        attributes: {
            // caption,
            hasCaption,
            iconSize,
            iconType = null,
            linkUrl,
            themeIcon,
            faIcon,
        },
        isSelected,
        setAttributes,
    } = props;

    return iconType == null ? (
        <Placeholder label={'Icon Block'}>
            <TypeSelect {...props} />
        </Placeholder>
    ) : (
        <>
            <BlockControls>
                <Toolbar>
                    <URLInputButton
                        url={linkUrl}
                        onChange={(linkUrl) => {
                            setAttributes({ linkUrl });
                        }}
                    />
                </Toolbar>
            </BlockControls>
            {isSelected && (
                <div className="sn-icon-settings">
                    <div className="sn-icon-setting">
                        <IconComponent icon={SwapHoriz} />
                        <TypeSelect {...props} />
                    </div>
                    <div className="sn-icon-setting">
                        <IconComponent icon={Stars} />
                        <IconSelect {...props} />
                    </div>
                    <div className="sn-icon-setting">
                        <IconComponent icon={TextFields} />
                        <ToggleControl
                            label={'Caption'}
                            checked={hasCaption}
                            onChange={(hasCaption) => {
                                setAttributes({ hasCaption });
                            }}
                        />
                    </div>
                    <div className="sn-icon-setting">
                        <IconComponent icon={PhotoResizeSelectLarge} />
                        <RangeControl
                            label={'Icon size'}
                            value={iconSize}
                            allowReset={true}
                            initialPosition={3}
                            min={0.5}
                            max={12}
                            step={0.5}
                            withInputField={true}
                            onChange={(iconSize) => {
                                setAttributes({ iconSize });
                            }}
                        />
                    </div>
                </div>
            )}

            <figure className="sn-icon">
                {iconType === IconType.THEME && (
                    <span className="sn-icon__preview">Icon {themeIcon}</span>
                )}
                {iconType === IconType.FONTAWESOME && faIcon && (
                    <FontAwesomeIcon icon={faIcon} />
                )}
                {iconType === IconType.FILE && <p>To be implemented</p>}
                {hasCaption && (
                    <figcaption>
                        <DiscreetInput
                            labelText={'Caption'}
                            valueKey={'caption'}
                            {...props}
                        />
                    </figcaption>
                )}
            </figure>
        </>
    );
};

export const edit = Edit;
