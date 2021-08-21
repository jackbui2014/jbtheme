import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

import * as jbsliders from './gutenberg/jbsliders';
import * as newjbsliders from './gutenberg/newjbsliders';
import * as service from './gutenberg/services';
import * as aboutus from './gutenberg/aboutus';
import * as testimonial from './gutenberg/testimonial';
import * as jbpostslist from './gutenberg/jbpostslist';
import * as jbprojects from './gutenberg/jbprojects';
import * as jbteam from './gutenberg/jbteam';


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
	jbsliders,
	service,
	aboutus,
	testimonial,
	jbpostslist,
	jbprojects,
	jbteam,
	newjbsliders
	].forEach( registerBlock );
}
registerJBBlocks();