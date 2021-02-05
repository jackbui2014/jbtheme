import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { RichText, MediaUpload, PlainText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { Fragment, Component } from '@wordpress/element';
import Service from '../../components/service.js';
const ServiceSave = (props)=>{
	return (
		<Fragment>
			<Service 
				icon={props.attributes.icon}
				link={props.attributes.link}
				title={props.attributes.title}
				subtitle={props.attributes.subtitle}
				 />
		</Fragment>
		);
} 
export default ServiceSave;