import { __ } from '@wordpress/i18n';
import { registerBlocType } from '@wordpress/blocks';
import { RichText, MediaUpload, PlainText,  InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { Fragment, Component } from '@wordpress/element';
const Service = (props)=>{
	return (
		<Fragment>
			<div className="jb-service-wrapper">
				<div className="inner jb-service-inner">
				{ props.link && (
					<a href={props.link} >
					{props.icon && (
					<img src={props.icon} className="service-icon" alt={props.title} />
					)}
					{props.title && (
					<RichText.Content tagName="h3" className="title" value={props.title} />
					)}
					{ props.subtitle && (
					<RichText.Content tagName="p" className="subtitle" value={props.subtitle} />
					)}
					</a>
					)}

					{ !props.link && (
					<div>	
					{props.icon && (
					<img src={props.icon} className="service-icon" alt={props.title} />
					)}
					{props.title && (
					<RichText.Content tagName="h3" className="title" value={props.title} />
					)}
					{ props.subtitle && (
					<RichText.Content tagName="p" className="subtitle" value={props.subtitle} />
					)}
					</div>
					)}
					
				</div>
			</div>
		</Fragment>
		);
}
export default Service;