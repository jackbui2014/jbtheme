import { __ } from '@wordpress/i18n';
import { RichText,  InspectorControls } from '@wordpress/block-editor';
import { PanelBody, Tooltip, ColorPicker } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

const JBSoialEdit = (props) =>{
	const { title, subtitle } = props.attributes;
	return ([
			<Tooltip text={ __("This is social icons", 'jbtheme') }>
				<div className="jb-block-title">
					{__('JB Social icons', 'jbtheme')}
				</div>
			</Tooltip>, 
		<Fragment>
			<RichText
				label={ __('Section title', 'jbtheme')}
				placeholder={ __('Section title', 'jbtheme')}
				tagName="h2"
				value={ props.attributes.title }
				onChange={ (title) => props.setAttributes({title})}
				/>	
			<RichText
				label={ __('Section Subtitle', 'jbtheme')}
				placeholder={ __('Section Subtitle', 'jbtheme')}
				tagName="p"
				value={ props.attributes.subtitle }
				onChange={ (subtitle) => props.setAttributes({subtitle})}
				/>	

		</Fragment>
	]);
}
export default JBSoialEdit;