import { __ } from '@wordpress/i18n';
import { RichText,  InspectorControls, InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, Tooltip, ColorPicker, TextControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

const JBContactEdit = (props) =>{
	const { title, subtitle, content, image } = props.attributes;
	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={__('JB Contact settings', 'jbapp')} >
			<h4>{ __('Section background color', 'jbapp')}</h4>
			<ColorPicker
			color={ props.attributes.background_color }
            onChangeComplete={ ( value ) => props.setAttributes({background_color: value.hex}) }
            disableAlpha
			/>
			<TextControl
			 label={__('Section id', 'jbapp')}
				placeholder={ __('Section id', 'jbapp')}
				value={ props.attributes.section_id }
				onChange={ (section_id) => props.setAttributes({section_id})}
				/>	
			</PanelBody>
		</InspectorControls>
	);
	const blockProps = useBlockProps();
	return ([
		inspectorControls,	   
			<Tooltip text={ __("This is JB  Contactt section", 'jbapp') }>
				<div className="jb-block-title">
					{__('JB Contactt', 'jbapp')}
				</div>
			</Tooltip>, 
		<Fragment>
			<RichText
				label={ __('Section title', 'jbapp')}
				placeholder={ __('Section title', 'jbapp')}
				tagName="h2"
				value={ props.attributes.title }
				onChange={ (title) => props.setAttributes({title})}
				/>	
			<RichText
				label={ __('Section Subtitle', 'jbapp')}
				placeholder={ __('Section Subtitle', 'jbapp')}
				tagName="p"
				value={ props.attributes.subtitle }
				onChange={ (subtitle) => props.setAttributes({subtitle})}
				/>	
			<TextControl
				placeholder={ __('Address', 'jbapp')}
				tagName="p"
				value={ props.attributes.address }
				onChange={ (address) => props.setAttributes({address})}
				/>	
			<TextControl
				placeholder={ __('Email', 'jbapp')}
				tagName="p"
				value={ props.attributes.email }
				onChange={ (email) => props.setAttributes({email})}
				/>	
			<TextControl
				placeholder={ __('Phone', 'jbapp')}
				tagName="p"
				value={ props.attributes.phone }
				onChange={ (phone) => props.setAttributes({phone})}
				/>		
			<TextControl
				placeholder={ __('Google Map link', 'jbapp')}
				tagName="p"
				value={ props.attributes.google_map_link }
				onChange={ (google_map_link) => props.setAttributes({google_map_link})}
				/>		
			 <div { ...blockProps }>
                <InnerBlocks />
            </div>
		</Fragment>
	]);
}
export default JBContactEdit;