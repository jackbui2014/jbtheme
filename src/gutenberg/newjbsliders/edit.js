/**
 * WordPress dependencies
 */
 import { __ } from '@wordpress/i18n';
 import { RichText, MediaUpload , InspectorControls, InnerBlocks } from '@wordpress/block-editor';
 import { PanelBody, TextControl, SelectControl } from '@wordpress/components';

 import { Tooltip } from '@wordpress/components';
 import {   
	 faTrashAlt
 
 } from '@fortawesome/free-solid-svg-icons';
 import {FontAwesomeIcon} from '@fortawesome/react-fontawesome';

 const JBSlidersEdit = (props) => {  
		 const { slideritem } = props.attributes;		
		 const hide_control = [
			 { value: 'yes', label: __( 'Yes', 'jbtheme' ) },
			 { value: 'no', label: __( 'No', 'jbtheme' ) },
		 ];	
		 const arrow_control = [
			 { value: true, label: __( 'Yes', 'jbtheme' ) },
			 { value: false, label: __( 'No', 'jbtheme' ) },
		 ];		
		 const showoverlay = [
			{ value: true, label: __( 'Yes', 'jbtheme' ) },
			{ value: false, label: __( 'No', 'jbtheme' ) },
		];	
		const fullscreenheight = [
			{ value: true, label: __( 'Yes', 'jbtheme' ) },
			{ value: false, label: __( 'No', 'jbtheme' ) },
		];		
		 const position = [
			 { value: 'top', label: __( 'Top', 'jbtheme' ) },
			 { value: 'center', label: __( 'Center', 'jbtheme' ) },
			 { value: 'bottom', label: __( 'Bottom', 'jbtheme' ) },
		 ];

		 const position_x = [
			{ value: 'center', label: __( 'Center', 'jbtheme' ) },
			{ value: 'left', label: __( 'Left', 'jbtheme' ) },			
			{ value: 'right', label: __( 'Right', 'jbtheme' ) },
		];
		const MY_TEMPLATE = [
			[ 'core/image', {} ],
			[ 'core/heading', { placeholder: 'Title' } ],
			[ 'core/paragraph', { placeholder: 'Description' } ],
			[ 'core/button', { placeholder: 'Button' } ],
		];
		 const inspectorControls = (
			 <InspectorControls>
				 <PanelBody title={ __( 'Slider Setting', 'jbtheme' ) }>
					 {/* <SelectControl
						 label={ __( 'Show Controls', 'jbtheme' ) }
						 options={ hide_control }
						 value={ props.attributes.hidecontrol }
						 onChange={ ( hidecontrol ) => props.setAttributes( { hidecontrol } ) }
					 /> */}
					 <SelectControl
						 label={ __( 'Arrow Controls', 'jbtheme' ) }
						 options={ arrow_control }
						 value={ props.attributes.arrowcontrol }
						 onChange={ ( arrowcontrol ) => props.setAttributes( { arrowcontrol } ) }
					 />
					 {/* <SelectControl
						 label={ __( 'Caption position Y', 'jbtheme' ) }
						 options={ position }
						 value={ props.attributes.position }
						 onChange={ ( position ) => props.setAttributes( { position } ) }
					 /> */}
					 <SelectControl
						 label={ __( 'Caption position X', 'jbtheme' ) }
						 options={ position_x }
						 value={ props.attributes.position_x }
						 onChange={ ( position_x ) => props.setAttributes( { position_x } ) }
					 />
					  <SelectControl
						 label={ __( 'Show overlay layer', 'jbtheme' ) }
						 options={ showoverlay }
						 value={ props.attributes.showoverlay }
						 onChange={ ( showoverlay ) => props.setAttributes( { showoverlay } ) }
					 />
					 <SelectControl
						 label={ __( 'Show full screen height', 'jbtheme' ) }
						 options={ fullscreenheight }
						 value={ props.attributes.fullscreenheight }
						 onChange={ ( fullscreenheight ) => props.setAttributes( { fullscreenheight } ) }
					 />
					 <TextControl
						 label={ __( 'Speed', 'jbtheme' ) }
						 type="text"
						 value={ props.attributes.slider_speed }
						 onChange={ ( slider_speed ) => props.setAttributes( { slider_speed } ) }
					 />
					 <TextControl
						 label={ __( 'Slide item on a screen', 'jbtheme' ) }
						 type="text"
						 value={ props.attributes.slider_items }
						 onChange={ ( slider_items ) => props.setAttributes( { slider_items} ) }
					 />
					 <TextControl
						 label={ __( 'Slide items to scroll', 'jbtheme' ) }
						 type="text"
						 value={ props.attributes.slidestoscroll }
						 onChange={ ( slidestoscroll ) => props.setAttributes( { slidestoscroll} ) }
					 />
					
				 </PanelBody>
			 </InspectorControls>
		 );
		 if (!props.attributes.id) {
		   const id = `slide${Math.floor(Math.random() * 100)}`;
		   props.setAttributes({
			 id
		   });
		 }	    
		 const sliderList = slideritem
		   .sort((a, b) => a.index - b.index)
		   .map(slide => {
			 return (
			   <div className="slide-block">
				 <div className="image_slide_container">
				 <InnerBlocks 
				 	template={MY_TEMPLATE}
					 templateLock="all"
				  />
				</div>
				</div>
			 )
		   });
		 return ([
			 inspectorControls,	   
			<Tooltip text="This is a slider">
				 <div>
					 {__('JB Slider', 'jbtheme')}
				 </div>
			</Tooltip>, 	
		   <div className={props.className}>
			 {sliderList}  
			 <button
			   className="add-more-slide"
			   onClick={content =>
				 props.setAttributes({
					slideritem: [
					 ...props.attributes.slideritem,
					 {
					   index: props.attributes.slideritem.length,
					   content: "",
					   title: "",
					   description: "",
					   link: ""
					 }
				   ]
				 })
			   }
			 >
			   +
			 </button>	        
		   </div>
		 ]);
 };
 export default JBSlidersEdit;