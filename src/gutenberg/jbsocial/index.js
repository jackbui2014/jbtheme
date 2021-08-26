import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload, PlainText,  InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import config from './config.json';
import edit from './edit';

const {name, category, attributes} = config;

const settings = {
	title: __('JB Social icons', 'jbtheme'),
	icon: 'format-gallery',
	category: category,
	attributes,
	edit,
	save: function(){
		return null;
	}
}
export {name, category, settings};