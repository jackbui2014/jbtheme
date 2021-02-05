import { __ } from '@wordpress/i18n';
import { registerBlocType } from '@wordpress/blocks';
import { RichText, MediaUpload, PlainText,  InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { Fragment, Component } from '@wordpress/element';
import config from './config.json';

const HomeBannerEdit = (props) => {
		return (
			<Fragment>
				<MediaUpload
					onSelect={media => {
						const image = media.sizes.full
						? media.sizes.full.url
						: media.url;
						props.setAttributes({
							background_url: image
						});
					}}
					type="image"
					value={props.attributes.background_url}
					render={({ open })=>
					!! props.attributes.background_url ? (
						<div>
						<img className="image" src={props.attributes.background_url} onClick={open} />
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
					<RichText
						label={ __('Banner title', 'jbtheme')}
						placeholder={ __('Banner title', 'jbtheme')}
						tagName="h1"
						value={ props.attributes.banner_title }
						onChange={ (banner_title) => props.setAttributes({banner_title}) }
						/>	
					<RichText
						label={ __('Banner Subtitle', 'jbtheme')}
						placeholder={ __('Banner Subtitle', 'jbtheme')}
						tagName="p"
						value={ props.attributes.banner_subtitle }
						onChange={ (banner_subtitle) => props.setAttributes({banner_subtitle}) }
						/>	
						<TextControl
						label={ __('Banner button text', 'jbtheme')}
						type="text"
						value={ props.attributes.button_text }
						onChange={ (button_text) => props.setAttributes({button_text}) }
						/>
						<TextControl
						label={ __('Banner button link', 'jbtheme')}
						type="text"
						value={ props.attributes.button_link }
						onChange={ (button_link) => props.setAttributes({button_link}) }
						/>
			</Fragment>
			);
}
export default HomeBannerEdit;