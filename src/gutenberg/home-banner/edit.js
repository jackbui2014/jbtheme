import { __ } from '@wordpress/i18n';
import { registerBlocType } from '@wordpress/blocks';
import { RichText, MediaUpload, PlainText,  InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { Fragment, Component } from '@wordpress/element';
import config from './config.json';

class HomeBannerEdit extends Component{
	constructor(props){
		super(props);
	}
	render(){
		return (
			<Fragment>
				<MediaUpload
					onSelect={media => {
						const image = media.sizes.full
						? media.sizes.full.url
						: media.url;
						this.props.setAttributes({
							background_url: image
						});
					}}
					type="image"
					value={this.props.attributes.background_url}
					render={({ open })=>
					!! this.props.attributes.background_url ? (
						<div>
						<img className="image" src={this.props.attributes.background_url} onClick={open} />
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
					<TextControl
						label={ __('Video url', 'jbtheme')}
						type="text"
						value={ this.props.attributes.video_url }
						onChange={ (video_url) => this.props.setAttributes({video_url}) }
						/>
						<TextControl
						label={ __('Banner title', 'jbtheme')}
						type="text"
						value={ this.props.attributes.banner_title }
						onChange={ (banner_title) => this.props.setAttributes({banner_title}) }
						/>
					<RichText
						label={ __('Banner Subtitle', 'jbtheme')}
						placeholder={ __('Banner Subtitle', 'jbtheme')}
						tagName="p"
						value={ this.props.attributes.banner_subtitle }
						onChange={ (banner_subtitle) => this.props.setAttributes({banner_subtitle}) }
						/>	
						<TextControl
						label={ __('Banner button text', 'jbtheme')}
						type="text"
						value={ this.props.attributes.button_text }
						onChange={ (button_text) => this.props.setAttributes({button_text}) }
						/>
						<TextControl
						label={ __('Banner button link', 'jbtheme')}
						type="text"
						value={ this.props.attributes.button_link }
						onChange={ (button_link) => this.props.setAttributes({button_link}) }
						/>
			</Fragment>
			);
	}
}
export default HomeBannerEdit;