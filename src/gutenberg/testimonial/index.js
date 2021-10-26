import { __ } from '@wordpress/i18n';
import config from './config.json';
import edit from './edit';
import save from './save';
import { testimonialIcon } from '../../components/icons';

const { name, category, attributes } = config;

const settings = {
	title: __('JB Testimonial', 'jbprovider'),
	icon: testimonialIcon,
	category: category,
	attributes,
	edit,
	save
}
export { name, category, settings };