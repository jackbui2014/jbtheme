import { __ } from '@wordpress/i18n';
import { RichText} from '@wordpress/block-editor';
import { ExternalLink } from '@wordpress/components';
import { Fragment } from '@wordpress/element';
const Service = (props)=>{
	return (
		<Fragment>
			<div className="jb-service-item">
				{props.icon && (
				<img src={props.icon} className="service-icon" alt={__('Service image', 'jbtheme')} />
				)}
				{props.title && (
				<RichText.Content tagName="h3" className="title" value={props.title} />
				)}
				{ props.subtitle && (
				<RichText.Content tagName="p" className="subtitle" value={props.subtitle} />
				)}
				{ props.link && (
					<a href={props.link} target="_blank" className="service-button btn jb-btn-primary" rel="noopener" ><span>See more</span></a>
				)}
				
			</div>
		</Fragment>
		);
}
export default Service;