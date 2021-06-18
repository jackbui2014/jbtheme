import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

import * as jbsliders from './gutenberg/jbsliders';
import * as service from './gutenberg/services';


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
	service
	].forEach( registerBlock );
}
registerJBBlocks();