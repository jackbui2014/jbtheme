import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload, InnerBlocks } from '@wordpress/block-editor';
import { Tooltip } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

const JBContainerEdit = (props) =>{
	return ([   
			<Tooltip text={ __("This is JB Container", 'jbtheme') }>
				<div className="jb-block-title">
					{__('JB Container', 'jbtheme')}
				</div>
			</Tooltip>, 
		<Fragment>
			 <div { ...props }>
                <InnerBlocks />
            </div>
		</Fragment>
	]);
}
export default JBContainerEdit;