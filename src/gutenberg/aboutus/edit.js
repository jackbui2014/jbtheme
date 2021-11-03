import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload,  InspectorControls } from '@wordpress/block-editor';
import { PanelBody, Tooltip, ColorPicker, TextControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

const AboutusEdit = (props) =>{
	const { title, subtitle, content, image } = props.attributes;
	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={__('About us settings', 'jbapp')} >
			<h4>{ __('Section background color', 'jbapp')}</h4>
			<ColorPicker
			color={ props.attributes.background_color }
            onChangeComplete={ ( value ) => props.setAttributes({background_color: value.hex}) }
            disableAlpha
			/>
			</PanelBody>
			<TextControl
				label={__('Section id', 'jbapp')}
				placeholder={ __('Section id', 'jbapp')}
				value={ props.attributes.section_id }
				onChange={ (section_id) => props.setAttributes({section_id})}
				/>	
		</InspectorControls>
	);
	return ([
		inspectorControls,	   
			<Tooltip text={ __("This is about us section", 'jbapp') }>
				<div className="jb-block-title">
					{__('JB About us', 'jbapp')}
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

			<RichText
				label={ __('Content', 'jbapp')}
				placeholder={ __('Content', 'jbapp')}
				tagName="p"
				value={ props.attributes.content }
				onChange={ (content) => props.setAttributes({content})}
				/>	
			<MediaUpload
				onSelect={media => {
					const image_url = media.sizes.full
					? media.sizes.full.url
					: media.url;
					props.setAttributes({image:image_url});
				}}
				type="image"
				value={props.attributes.image}
				render={({ open })=>
				!! image ? (
					<div>
					<img className="image" src={image} onClick={open} />
					</div>
					): (
					<a href="#"
						className="banner_image_select"
						onClick={open}
						>
						Select image
						</a>
					)
				}
				/>
		</Fragment>
	]);
}
export default AboutusEdit;