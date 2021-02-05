import { __ } from '@wordpress/i18n';
import { registerBlocType } from '@wordpress/blocks';
import { RichText, MediaUpload, PlainText,  InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { Fragment, Component } from '@wordpress/element';
import {
	faTrashAlt
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon} from '@fortawesome/react-fontawesome';
import config from './config.json';

const ServiceEdit = (props) =>{
	const { services } = props.attributes;
	if( !props.attributes.id ){
		const id = `service${Math.floor(Math.random() * 100)}`;
		props.setAttributes({
			id
		});
	}
	const servicesList = services
		.sort( (a,b)=> a.index - b.index )
		.map(service=>{
			return (
				<div className="service-item">
					<div className="inner">
						<a href="#"
							className="remove_image"
							onClick={() => {
								const newService = services
								 .filter(item => item.index != service.index)
								 .map(t => {
								 	if( t.index < service.index ){
								 		t.index -= 1;
								 	}
								 	return t;
								 });
								props.setAttributes({
									services: newService
								});

							}}
							>
							<FontAwesomeIcon icon={faTrashAlt} />
							</a>

							<MediaUpload
							onSelect={media => {
								const image = media.sizes.full
								? media.sizes.full.url
								: media.url;
								const newObject = Object.assign({}, service, {
									icon: image
								});
								props.setAttributes({
									services: [
										...services.filter(
											item => item.index != service.index
										),
										newObject
									]
								});
							}}
							type="image"
							value={service.icon}
							render={({ open })=>
							!! service.icon ? (
								<div>
								<img className="image" src={service.icon} onClick={open} />
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
								label={ __('Service title', 'jbtheme')}
								placeholder={ __('Service title', 'jbtheme')}
								tagName="h3"
								value={ service.title }
								onChange={ (title) => {
									const newObject = Object.assign({}, service, {
										title: title
									});
									props.setAttributes({
										services: [
										...services.filter(
											item => item.index != service.index
											),
											newObject
										]
									});
								}}
								/>	
							<RichText
								label={ __('Service Subtitle', 'jbtheme')}
								placeholder={ __('Service Subtitle', 'jbtheme')}
								tagName="p"
								value={ props.attributes.subtitle }
								onChange={ (subtitle) => {
									const newObject = Object.assign({}, service, {
										subtitle: subtitle
									});
									props.setAttributes({
										services: [
										...services.filter(
											item => item.index != service.index
											),
											newObject
										]
									});
								}}
								/>	
								<TextControl
								label={ __('Service link', 'jbtheme')}
								type="text"
								value={ props.attributes.link }
								onChange={ (link) => {
									const newObject = Object.assign({}, service, {
										link: link
									});
									props.setAttributes({
										services: [
										...services.filter(
											item => item.index != service.index
											),
											newObject
										]
									});
								}}
								/>
					</div>
				</div>
			);
		});
	return (
		<Fragment>
			<RichText
				label={ __('Section title', 'jbtheme')}
				placeholder={ __('Section title', 'jbtheme')}
				tagName="h2"
				value={ props.attributes.section_title }
				onChange={ (section_title) => props.setAttributes({section_title})}
				/>	
			<RichText
				label={ __('Section Subtitle', 'jbtheme')}
				placeholder={ __('Section Subtitle', 'jbtheme')}
				tagName="p"
				value={ props.attributes.section_subtitle }
				onChange={ (section_subtitle) => props.setAttributes({section_subtitle})}
				/>	
			<div className="services-wrapper">
			{servicesList}
			</div>
			<button
				className="add-more-service"
				onClick={content => 
					props.setAttributes({
						services: [
							...props.attributes.services,
							{
								index: props.attributes.services.length,
								title: "",
								subtitle: "",
								linke: ""
							}
						]
					})
				}
				>
				+
				</button>
		</Fragment>
		);
}
export default ServiceEdit;