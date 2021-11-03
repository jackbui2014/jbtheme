import { __ } from '@wordpress/i18n';
import config from './config.json';
import edit from './edit';
import save from './save';

const {name, category, attributes} = config;

const settings = {
	title: __('JB Team', 'jbapp'),
	icon: 'admin-users',
	category: category,
	attributes,
	edit,
	save
}
export {name, category, settings};