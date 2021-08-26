import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload,  InspectorControls } from '@wordpress/block-editor';
import { PanelBody, Tooltip, ColorPicker, SelectControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

const AboutusEdit = (props) =>{
	const { title, subtitle, posts_per_page } = props.attributes;
	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={__('JB Posts List Settings', 'jbtheme')} >
			<h4>{ __('Section background color', 'jbtheme')}</h4>
			<ColorPicker
			color={ props.attributes.background_color }
            onChangeComplete={ ( value ) => props.setAttributes({background_color: value.hex}) }
            disableAlpha
			/>
			</PanelBody>
		</InspectorControls>
	);
	const posts_per_page_options = [
		{ value: '3', label: '3' },
		{ value: '4', label: '4' },
		{ value: '6', label: '6' },
		{ value: '8', label: '8' },
	];
	return ([
		inspectorControls,	   
			<Tooltip text={ __("This is JB Posts List section", 'jbtheme') }>
				<div className="jb-block-title">
					{__('JB Posts List', 'jbtheme')}
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

			<SelectControl
				label={ __( 'Number of posts', 'jbtheme' ) }
				options={ posts_per_page_options }
				value={ posts_per_page }
				onChange={ ( posts_per_page ) => props.setAttributes( { posts_per_page } ) }
			/>
		</Fragment>
	]);
}
export default AboutusEdit;