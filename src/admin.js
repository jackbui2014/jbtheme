import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

import * as jbsliders from './gutenberg/jbsliders';
import * as service from './gutenberg/services';
import * as aboutus from './gutenberg/aboutus';

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
	aboutus
	].forEach( registerBlock );
}
registerJBBlocks();