import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import { InnerBlocks, useBlockProps, RichText } from '@wordpress/block-editor';
const JBContactSave = (props)=>{
	const blockProps = useBlockProps.save();
	const cl = "jb-section jb-contact-wrapper "+ props.attributes.className;
	return (
		<Fragment>
			<div className={cl} id={props.attributes.section_id} style={{backgroundColor: props.attributes.background_color}}>
				<div className="inner jb-contact-inner container">
					<div className="jb-contact-left animate__animated fadeInLeft" data-scroll>
						<div className="inner">
							{props.attributes.title && (
							<RichText.Content tagName="h3" className="section-title contact-title section-title-left" value={props.attributes.title} />
							)}
							{ props.attributes.subtitle && (
							<RichText.Content tagName="p" className="section-subtitle contact-subtitle" value={props.attributes.subtitle} />
							)}
							{ props.attributes.phone && (
							<p><i class="fas fa-phone-square"></i><span className="jb-contact-label">{__('Phone:', 'jbprovider') } </span><a href={"tel:"+props.attributes.phone} className="jb-contact-content">{props.attributes.phone}</a> </p>
							)}
							{ props.attributes.email && (
							<p><i class="fas fa-envelope"></i><span className="jb-contact-label">{__('Email:', 'jbprovider') } </span><a href={"mailto:"+props.attributes.email} className="jb-contact-content">{props.attributes.email}</a></p>
							)}
							{ props.attributes.address && (
							<p><i class="fas fa-map-marker-alt"></i><span className="jb-contact-label">{__('Address:', 'jbprovider') } </span><span className="jb-contact-content">{props.attributes.address} </span></p>
							)}
							{ props.attributes.google_map_link && (
							<iframe src={props.attributes.google_map_link} 
							className="jb-contact-map"
							style="border:0"
							loading="lazy"
							>
							</iframe>
							)}
							</div>
					</div>
					<div className="jb-contact-right animate__animated fadeInRight" data-scroll>
						<div className="inner">
						<div { ...blockProps }>
							<InnerBlocks.Content />
						</div>
						</div>
					</div>
				</div>
			</div>
		</Fragment>
		);
} 
export default JBContactSave;