import { __ } from '@wordpress/i18n';
import config from './config.json';
import edit from './edit';


const {name, category, attributes} = config;

const settings = {
	title: __('JB Latest posts', 'jbtheme'),
	icon: 'format-gallery',
	category: category,
	attributes,
	edit
}
export {name, category, settings};