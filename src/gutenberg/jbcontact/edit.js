import { __ } from '@wordpress/i18n';
import { RichText,  InspectorControls, InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, Tooltip, ColorPicker, TextControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

const JBContactEdit = (props) =>{
	const { title, subtitle, content, image } = props.attributes;
	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={__('JB Contact settings', 'jbtheme')} >
			<h4>{ __('Section background color', 'jbtheme')}</h4>
			<ColorPicker
			color={ props.attributes.background_color }
            onChangeComplete={ ( value ) => props.setAttributes({background_color: value.hex}) }
            disableAlpha
			/>
			</PanelBody>
		</InspectorControls>
	);
	const blockProps = useBlockProps();
	return ([
		inspectorControls,	   
			<Tooltip text={ __("This is JB  Contactt section", 'jbtheme') }>
				<div className="jb-block-title">
					{__('JB Contactt', 'jbtheme')}
				</div>
			</Tooltip>, 
		<Fragment>
			<RichText
				label={ __('Section title', 'jbtheme')}
				placeholder={ __('Section title', 'jbtheme')}
				tagName="h2"
				value={ props.attributes.title }
				onChange={ (title) => props.setAttributes({title})}
				/>	
			<RichText
				label={ __('Section Subtitle', 'jbtheme')}
				placeholder={ __('Section Subtitle', 'jbtheme')}
				tagName="p"
				value={ props.attributes.subtitle }
				onChange={ (subtitle) => props.setAttributes({subtitle})}
				/>	
			<TextControl
				placeholder={ __('Address', 'jbtheme')}
				tagName="p"
				value={ props.attributes.address }
				onChange={ (address) => props.setAttributes({address})}
				/>	
			<TextControl
				placeholder={ __('Email', 'jbtheme')}
				tagName="p"
				value={ props.attributes.email }
				onChange={ (email) => props.setAttributes({email})}
				/>	
			<TextControl
				placeholder={ __('Phone', 'jbtheme')}
				tagName="p"
				value={ props.attributes.phone }
				onChange={ (phone) => props.setAttributes({phone})}
				/>		
			<RichText
				label={ __('Content', 'jbtheme')}
				placeholder={ __('Content', 'jbtheme')}
				tagName="p"
				value={ props.attributes.content }
				onChange={ (content) => props.setAttributes({content})}
				/>	
			 <div { ...blockProps }>
                <InnerBlocks />
            </div>
		</Fragment>
	]);
}
export default JBContactEdit;