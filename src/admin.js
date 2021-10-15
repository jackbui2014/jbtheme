import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

import * as jbsliders from './gutenberg/jbsliders';
import * as service from './gutenberg/services';
import * as aboutus from './gutenberg/aboutus';
import * as testimonial from './gutenberg/testimonial';
import * as jbprojects from './gutenberg/jbprojects';
import * as jbteam from './gutenberg/jbteam';
import * as jbcontact from './gutenberg/jbcontact';
import * as jbcontainer from './gutenberg/jbcontainer';


const registerBlock = ( block ) => {
	if ( !block ){
		return;
	}

	let { category } = block;
	const { name, settings } = block;

	registerBlockType (name, {
		category,
		...settings,
	});
}
export const registerJBBlocks = () => {
	[
	jbcontainer,
	jbsliders,
	service,
	aboutus,
	testimonial,
	jbprojects,
	jbteam,
	jbcontact
	].forEach( registerBlock );
}
registerJBBlocks();