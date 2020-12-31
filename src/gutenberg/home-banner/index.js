import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload, PlainText,  InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import config from './config.json';
import edit from './edit';

const {name, category, attributes} = config;

const settings = {
	title: __('JB Home banner', 'jbtheme'),
	icon: 'format-gallery',
	category: category,
	attributes,
	edit,
	save(){
		return null;
	}
}
export {name, category, settings};