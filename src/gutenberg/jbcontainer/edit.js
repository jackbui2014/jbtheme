import { __ } from '@wordpress/i18n';
import { RichText, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, Tooltip, TextControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';


const JBContainerEdit = (props) => {
	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={__('JB Contact settings', 'jbprovider')} >
				<TextControl
					label={__('Section id', 'jbprovider')}
					placeholder={__('Section id', 'jbprovider')}
					value={props.attributes.section_id}
					onChange={(section_id) => props.setAttributes({ section_id })}
				/>
			</PanelBody>
		</InspectorControls>
	);
	return ([
		inspectorControls,
		<Tooltip text={__("This is JB Container", 'jbprovider')}>
			<div className="jb-block-title">
				{__('JB Container', 'jbprovider')}
			</div>
		</Tooltip>,
		<Fragment>
			<div {...props} >
				<InnerBlocks />
			</div>
		</Fragment>
	]);
}
export default JBContainerEdit;