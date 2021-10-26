import { __ } from '@wordpress/i18n';
import { RichText} from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
const Testimonial = (props)=>{
	return (
		<Fragment>
			<div className="jb-testimonial-item">
				{props.image && (
				<img src={props.image} className="jb-testimonial-image" alt={__('Testimonial image', 'jbprovider')} />
				)}
				{props.title && (
				<RichText.Content tagName="p" className="jb-testimonial-content" value={props.title} />
				)}
				{ props.subtitle && (
				<RichText.Content tagName="p" className="jb-testimonial-name" value={props.subtitle} />
				)}
			</div>
		</Fragment>
		);
}
export default Service;