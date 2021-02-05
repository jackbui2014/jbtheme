import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

import * as homebanner from './gutenberg/home-banner';
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
	homebanner,
	service
	].forEach( registerBlock );
}
registerJBBlocks();