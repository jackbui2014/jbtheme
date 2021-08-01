/**
 * WordPress dependencies
 */
 import { __ } from '@wordpress/i18n';
 import { registerBlockType } from '@wordpress/blocks';
 import { RichText, MediaUpload, PlainText, InspectorControls } from '@wordpress/block-editor';
 import { PanelBody, TextControl, SelectControl, TextareaControl } from '@wordpress/components';
 import {Fragment, Component} from '@wordpress/element';
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
				   <TextControl
					 label={ __( 'Title', 'jbtheme' ) }
					 placeholder={ __( 'Slider title', 'jbtheme' ) }
					 type="text"
					 value={ slide.title }
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
					 label={ __( 'Description','jbtheme' ) }
					 placeholder={ __( 'Slider description', 'jbtheme' ) }
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
					 label={ __( 'Button Link', 'jbtheme' ) }
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
					 label={ __( 'Button text', 'jbtheme' ) }
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