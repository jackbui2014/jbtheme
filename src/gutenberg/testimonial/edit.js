import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload, InspectorControls } from '@wordpress/block-editor';
import { TextControl, ColorPicker, Tooltip, PanelBody } from '@wordpress/components';
import {
	faTrashAlt
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon} from '@fortawesome/react-fontawesome';


const TestimonialEdit = (props) =>{
	const { testimonials } = props.attributes;

	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={__('Testimonial settings', 'jbapp')} >
			<h4>{ __('Section background color', 'jbapp')}</h4>
			<ColorPicker
			color={ props.attributes.background_color }
            onChangeComplete={ ( value ) => props.setAttributes({background_color: value.hex}) }
            disableAlpha
			/>

		<h4>{ __('Section background image', 'jbapp')}</h4>
			<MediaUpload
				onSelect={media => {
					let image = media.sizes.full
					? media.sizes.full.url
					: media.url;
					props.setAttributes({background_image: image});
				}}
				type="image"
				value={props.attributes.background_image}
				render={({ open })=>
				!! props.attributes.background_image ? (
					<div>
					<img className="image" src={props.attributes.background_image} onClick={open} />
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
				label={ __('Section id', 'jbapp')}
				placeholder={ __('Section id', 'jbapp')}
				value={ props.attributes.id }
				onChange={ (id) => props.setAttributes({id})}
				/>	
			</PanelBody>
		</InspectorControls>
	);
	if( !props.attributes.id ){
		const id = 'jb_testimonial';
		props.setAttributes({
			id
		});
	}
	const testimonialsList = testimonials
		.sort( (a,b)=> a.index - b.index )
		.map(testimonial=>{
			return (
				<div className="testimonial-item">
					<div className="inner">
						<a href="#"
							className="remove_image"
							onClick={() => {
								const newTestimonial = testimonials
								 .filter(item => item.index != testimonial.index)
								 .map(t => {
								 	if( t.index < testimonial.index ){
								 		t.index -= 1;
								 	}
								 	return t;
								 });
								props.setAttributes({
									testimonials: newTestimonial
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
								let newObject = Object.assign({}, testimonial, {
									image: image
								});
								props.setAttributes({
									testimonials: [
										...testimonials.filter(
											item => item.index != testimonial.index
										),
										newObject
									]
								});
							}}
							type="image"
							value={testimonial.image}
							render={({ open })=>
							!! testimonial.image ? (
								<div>
								<img className="image" src={testimonial.image} onClick={open} />
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
								label={ __('Testimonial content', 'jbapp')}
								placeholder={ __('Testimonial content', 'jbapp')}
								tagName="p"
								value={ testimonial.content }
								onChange={ (content) => {
									let newObject = Object.assign({}, testimonial, {
										content: content
									});
									props.setAttributes({
										testimonials: [
										...testimonials.filter(
											item => item.index != testimonial.index
											),
											newObject
										]
									});
								}}
								/>	
							<RichText
								label={ __('Customer name', 'jbapp')}
								placeholder={ __('Customer name', 'jbapp')}
								tagName="p"
								value={ testimonial.name }
								onChange={ (name) => {
									const newObject = Object.assign({}, testimonial, {
										name: name
									});
									props.setAttributes({
										testimonials: [
										...testimonials.filter(
											item => item.index != testimonial.index
											),
											newObject
										]
									});
								}}
								/>	
								<TextControl
								placeholder={ __('Customer job title', 'jbapp')}
								type="text"
								value={ testimonial.job_title }
								onChange={ (job_title) => {
									const newObject = Object.assign({}, testimonial, {
										job_title: job_title
									});
									props.setAttributes({
										testimonials: [
										...testimonials.filter(
											item => item.index != testimonial.index
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
			<Tooltip text={__("This is testimonials section",'jbapp')}>
				<div className="jb-block-title">
					{__('JB Testimonial', 'jbapp')}
				</div>
			</Tooltip>, 
			<div>
				<div className="testimonials-wrapper">
				{testimonialsList}
				<button
					className="add-more-testimonial jb-add-more-btn"
					onClick={content => 
						props.setAttributes({
							testimonials: [
								...props.attributes.testimonials,
								{
									index: props.attributes.testimonials.length,
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
export default TestimonialEdit;