import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import { InnerBlocks } from '@wordpress/block-editor';
const JBContainerSave = (props)=>{
	const cl = "container "+props.attributes.className;
	return (
		<Fragment>
			<div className={cl} id={props.attributes.section_id}>
				<div { ...props }>
					<InnerBlocks.Content />
				</div>
			</div>
		</Fragment>
		);
} 
export default JBContainerSave;