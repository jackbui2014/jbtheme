import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload, PlainText,  InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import config from './config.json';
import edit from './edit';
import save from './save';

const {name, category, attributes} = config;

const settings = {
	title: __('JB Projects', 'jbprovider'),
	icon: 'list-view',
	category: category,
	attributes,
	edit,
	save
}
export {name, category, settings};