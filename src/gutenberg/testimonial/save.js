import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
const TestimonialSave = (props)=>{
	let { id, testimonials} = props.attributes;
	const testimonialsList = testimonials.map(function(testimonial, i) {
		let keyVal = 'testimonial-item-'+i;
		return (
			<Fragment>
			<div className="jb-testimonial-item" key={keyVal}>
				<span className="testimonial-index" style={{ display: "none" }}>
                    {testimonial.index}
                </span>
				{testimonial.image && (
				<p className="testimonial-image-wrapper"><img src={testimonial.image} className="testimonial-image" alt={__('Testimonial image', 'jbapp')} /></p>
				)}
				{testimonial.content.trim() != "" && (
				<RichText.Content tagName="q" className="testimonial-item-content" value={testimonial.content} />
				)}
				{ testimonial.name && (
				<RichText.Content tagName="p" className="testimonial-item-name" value={testimonial.name} />
				)}
				{ testimonial.job_title && (
					<p className="testimonial-job-title">{testimonial.job_title}</p>
				)}
				
			</div>
			</Fragment>
				
		);

	});
	const cl = "jb-testimonial-wrapper jb-section "+props.attributes.className;
	return (
		<Fragment>
			<div className={cl} id={id} style={{backgroundColor: props.attributes.background_color,  backgroundImage: `url(${props.attributes.background_image})`}} >
				<div className="inner jb-testimonial-inner container">
					<div className="jb-testimonial-list-wrapper animate__animated fadeInUp" data-scroll>
						{testimonialsList}
					</div>
				</div>
			</div>
		</Fragment>
		);
} 
export default TestimonialSave;