import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload, InspectorControls } from '@wordpress/block-editor';
import { TextControl, ColorPicker, Tooltip, PanelBody } from '@wordpress/components';
import {
	faTrashAlt
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon} from '@fortawesome/react-fontawesome';


const ServiceEdit = (props) =>{
	const { services } = props.attributes;

	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={__('Services settings', 'jbtheme')} >
			<h4>{ __('Section background color', 'jbtheme')}</h4>
			<ColorPicker
			color={ props.attributes.background_color }
            onChangeComplete={ ( value ) => props.setAttributes({background_color: value.hex}) }
            disableAlpha
			/>
			</PanelBody>
		</InspectorControls>
	);
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
								let image = media.sizes.full
								? media.sizes.full.url
								: media.url;
								let newObject = Object.assign({}, service, {
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
									console.log(services);
									console.log(service);
									console.log(newObject);
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
								value={ service.subtitle }
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
								placeholder={ __('Service link', 'jbtheme')}
								type="text"
								value={ service.link }
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
	return ([
			inspectorControls,	   
			<Tooltip text={__("This is services section",'jbtheme')}>
				<div className="jb-block-title">
					{__('JB Service', 'jbtheme')}
				</div>
			</Tooltip>, 
			<div>
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
				<div className="services-wrapper">
				{servicesList}
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
									link: ""
								}
							]
						})
					}
					>
					+
					</button>
				</div>
				
					</div>
		]
		);
}
export default ServiceEdit;