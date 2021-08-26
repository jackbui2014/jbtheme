import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import { InnerBlocks, useBlockProps, RichText } from '@wordpress/block-editor';
const JBContactSave = (props)=>{
	const blockProps = useBlockProps.save();
	return (
		<Fragment>
			<div className="jb-section jb-contact-wrapper" style={{backgroundColor: props.background_color}}>
				<div className="inner jb-contact-inner container">
					<div className="jb-contact-left">
						<div className="inner">
							{props.attributes.title && (
							<RichText.Content tagName="h3" className="section-title contact-title section-title-left" value={props.attributes.title} />
							)}
							{ props.attributes.subtitle && (
							<RichText.Content tagName="p" className="section-subtitle contact-subtitle" value={props.attributes.subtitle} />
							)}
							{ props.attributes.phone && (
							<p><i class="fas fa-phone-square"></i><span className="jb-contact-label">{__('Phone:', 'jbtheme') } </span><a href="tel:{props.attributes.phone}" className="jb-contact-content">{props.attributes.phone}</a> </p>
							)}
							{ props.attributes.email && (
							<p><i class="fas fa-envelope"></i><span className="jb-contact-label">{__('Email:', 'jbtheme') } </span><a href="mailto:{props.attributes.email}" className="jb-contact-content">{props.attributes.email}</a></p>
							)}
							{ props.attributes.address && (
							<p><i class="fas fa-map-marker-alt"></i><span className="jb-contact-label">{__('Address:', 'jbtheme') } </span><span className="jb-contact-content">{props.attributes.address} </span></p>
							)}
							{ props.attributes.content && (
							<RichText.Content tagName="p" className="contact-content" value={props.attributes.content} />
							)}
							</div>
					</div>
					<div className="jb-contact-right">
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