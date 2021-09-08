import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import { InnerBlocks } from '@wordpress/block-editor';
const JBContainerSave = (props)=>{
	return (
		<Fragment>
			<div className="container">
				<div { ...props }>
					<InnerBlocks.Content />
				</div>
			</div>
		</Fragment>
		);
} 
export default JBContainerSave;