/**
 * WordPress dependencies
 */
 import { __ } from '@wordpress/i18n';
 import { RichText, MediaUpload , InspectorControls } from '@wordpress/block-editor';
 import { PanelBody, TextControl, SelectControl } from '@wordpress/components';

 import { Tooltip } from '@wordpress/components';
 import {   
	 faTrashAlt
 
 } from '@fortawesome/free-solid-svg-icons';
 import {FontAwesomeIcon} from '@fortawesome/react-fontawesome';

 const JBSlidersEdit = (props) => {  
		 const { slideritem } = props.attributes;		
		 const hide_control = [
			 { value: 'yes', label: __( 'Yes', 'jbapp' ) },
			 { value: 'no', label: __( 'No', 'jbapp' ) },
		 ];	
		 const arrow_control = [
			 { value: true, label: __( 'Yes', 'jbapp' ) },
			 { value: false, label: __( 'No', 'jbapp' ) },
		 ];		
		 const showoverlay = [
			{ value: true, label: __( 'Yes', 'jbapp' ) },
			{ value: false, label: __( 'No', 'jbapp' ) },
		];	
		const fullscreenheight = [
			{ value: true, label: __( 'Yes', 'jbapp' ) },
			{ value: false, label: __( 'No', 'jbapp' ) },
		];		
		 const position = [
			 { value: 'top', label: __( 'Top', 'jbapp' ) },
			 { value: 'center', label: __( 'Center', 'jbapp' ) },
			 { value: 'bottom', label: __( 'Bottom', 'jbapp' ) },
		 ];

		 const position_x = [
			{ value: 'center', label: __( 'Center', 'jbapp' ) },
			{ value: 'left', label: __( 'Left', 'jbapp' ) },			
			{ value: 'right', label: __( 'Right', 'jbapp' ) },
		];
		 const inspectorControls = (
			 <InspectorControls>
				 <PanelBody title={ __( 'Slider Setting', 'jbapp' ) }>
					 {/* <SelectControl
						 label={ __( 'Show Controls', 'jbapp' ) }
						 options={ hide_control }
						 value={ props.attributes.hidecontrol }
						 onChange={ ( hidecontrol ) => props.setAttributes( { hidecontrol } ) }
					 /> */}
					 <SelectControl
						 label={ __( 'Arrow Controls', 'jbapp' ) }
						 options={ arrow_control }
						 value={ props.attributes.arrowcontrol }
						 onChange={ ( arrowcontrol ) => props.setAttributes( { arrowcontrol } ) }
					 />
					 {/* <SelectControl
						 label={ __( 'Caption position Y', 'jbapp' ) }
						 options={ position }
						 value={ props.attributes.position }
						 onChange={ ( position ) => props.setAttributes( { position } ) }
					 /> */}
					 <SelectControl
						 label={ __( 'Caption position X', 'jbapp' ) }
						 options={ position_x }
						 value={ props.attributes.position_x }
						 onChange={ ( position_x ) => props.setAttributes( { position_x } ) }
					 />
					  <SelectControl
						 label={ __( 'Show overlay layer', 'jbapp' ) }
						 options={ showoverlay }
						 value={ props.attributes.showoverlay }
						 onChange={ ( showoverlay ) => props.setAttributes( { showoverlay } ) }
					 />
					 <SelectControl
						 label={ __( 'Show full screen height', 'jbapp' ) }
						 options={ fullscreenheight }
						 value={ props.attributes.fullscreenheight }
						 onChange={ ( fullscreenheight ) => props.setAttributes( { fullscreenheight } ) }
					 />
					 <TextControl
						 label={ __( 'Speed', 'jbapp' ) }
						 type="text"
						 value={ props.attributes.slider_speed }
						 onChange={ ( slider_speed ) => props.setAttributes( { slider_speed } ) }
					 />
					 <TextControl
						 label={ __( 'Slide item on a screen', 'jbapp' ) }
						 type="text"
						 value={ props.attributes.slider_items }
						 onChange={ ( slider_items ) => props.setAttributes( { slider_items} ) }
					 />
					 <TextControl
						 label={ __( 'Slide items to scroll', 'jbapp' ) }
						 type="text"
						 value={ props.attributes.slidestoscroll }
						 onChange={ ( slidestoscroll ) => props.setAttributes( { slidestoscroll} ) }
					 />
					 <TextControl
						label={ __('Section id', 'jbapp')}
						placeholder={ __('Section id', 'jbapp')}
						value={ props.attributes.id }
						onChange={ (id) => props.setAttributes({id})}
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
					 <a href="#"
						 className="image_remove"
						 onClick={() => {
						   const newslider = slideritem
							 .filter(item => item.index != slide.index)
							 .map(t => {
							   if (t.index > slide.index) {
								 t.index -= 1;
							   }
							   return t;
							 });
 
						   props.setAttributes({
							slideritem: newslider
						   });
						 }}
					   >
						 <FontAwesomeIcon icon={faTrashAlt}/>
					   </a>
				   <MediaUpload
					 onSelect={media => {
					   const image = media.sizes.full
						 ? media.sizes.full.url
						 : media.url;
					   const newObject = Object.assign({}, slide, {
						 image: image
					   });
					   props.setAttributes({
						slideritem: [
						   ...slideritem.filter(
							 item => item.index != slide.index
						   ),
						   newObject
						 ]
					   });
					 }}
					 type="image"
					 value={slide.image}
					 render={({ open }) =>
					   !!slide.image ? (
						 <div>
						   <img className="image" src={slide.image}  onClick={open} />
						 </div>
					   ) : (
						 <a
						   href="#"
						   className="image_select"
						   onClick={open}
						 >
						   Select Image
						 </a>
					   )
					 }
				   />                  
				 </div>				
				<RichText
					 label={ __( 'Title','jbapp' ) }
					 placeholder={ __( 'Slider title', 'jbapp' ) }
					 value={ slide.title }
					 tagName="h2"
					 onChange={ ( title ) => {
						 const newObject = Object.assign({}, slide, {
							title: title
						   });		                 
						  props.setAttributes({
							slideritem: [
							   ...slideritem.filter(
								 item => item.index != slide.index
							   ),
							   newObject
							 ]
						   });
					 } }
				 />
				 <RichText
					 label={ __( 'Description','jbapp' ) }
					 placeholder={ __( 'Slider description', 'jbapp' ) }
					 value={ slide.description }
					 tagName="div"
					 onChange={ ( description ) => {
						 const newObject = Object.assign({}, slide, {
							 description: description
						   });		                 
						  props.setAttributes({
							slideritem: [
							   ...slideritem.filter(
								 item => item.index != slide.index
							   ),
							   newObject
							 ]
						   });
					 } }
				 />
				 <TextControl
					 placeholder={ __( 'Button Link', 'jbapp' ) }
					 type="text"
					 value={ slide.link }
					 onChange={ ( link ) => {
						 const newObject = Object.assign({}, slide, {
							 link: link
						   });		                 
						  props.setAttributes({
							slideritem: [
							   ...slideritem.filter(
								 item => item.index != slide.index
							   ),
							   newObject
							 ]
						   });
					 } }
				 />
				 <TextControl
					 placeholder={ __( 'Button text', 'jbapp' ) }
					 type="text"
					 value={ slide.link_text }
					 onChange={ ( link_text ) => {
						 const newObject = Object.assign({}, slide, {
							link_text: link_text
						   });		                 
						  props.setAttributes({
							slideritem: [
							   ...slideritem.filter(
								 item => item.index != slide.index
							   ),
							   newObject
							 ]
						   });
					 } }
				 />
			   </div>
			 );
		   });
		 return ([
			 inspectorControls,	   
			<Tooltip text={__('This is JB Slider', 'jbapp')}>
				 <div className="jb-block-title">
					 {__('JB Slider', 'jbapp')}
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