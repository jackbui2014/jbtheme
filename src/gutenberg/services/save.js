import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
const ServiceSave = (props)=>{
	let { id, services} = props.attributes;
	const servicesList = services.map(function(service, i) {
		let keyVal = 'service-item-'+i;
		return (
			<Fragment>
			<div className="jb-service-item col-md-4 col-sm-6 animate__animated fadeInUp" key={keyVal} data-scroll>
				<span className="service-index" style={{ display: "none" }}>
                    {service.index}
                </span>
				{service.icon && (
				<img src={service.icon} className="service-icon" alt={__('Service image', 'jbapp')} />
				)}
				{service.title && (
				<RichText.Content tagName="h3" className="service-item-title" value={service.title} />
				)}
				{ service.subtitle && (
				<RichText.Content tagName="p" className="service-item-subtitle" value={service.subtitle} />
				)}
				{ service.link && (
					<a href={service.link} target="_blank" className="service-button btn jb-btn-primary" rel="noopener" ><span>See more</span></a>
				)}
				
			</div>
			</Fragment>
				
		);

	});
	const cl = "jb-service-wrapper jb-section "+props.attributes.className;
	return (
		<Fragment>
			<div className={cl} id={id} style={{backgroundColor: props.attributes.background_color}} >
				<div className="inner jb-service-inner container">
				<h3 className="service-title section-title">{props.attributes.title}</h3>
				<p className="service-subtitle section-subtitle">{props.attributes.subtitle}</p>
					<div className="row">
						{servicesList}
					</div>
				</div>
			</div>
		</Fragment>
		);
} 
export default ServiceSave;