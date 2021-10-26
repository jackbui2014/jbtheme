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
			 { value: 'yes', label: __( 'Yes', 'jbprovider' ) },
			 { value: 'no', label: __( 'No', 'jbprovider' ) },
		 ];	
		 const arrow_control = [
			 { value: true, label: __( 'Yes', 'jbprovider' ) },
			 { value: false, label: __( 'No', 'jbprovider' ) },
		 ];		
		 const showoverlay = [
			{ value: true, label: __( 'Yes', 'jbprovider' ) },
			{ value: false, label: __( 'No', 'jbprovider' ) },
		];	
		const fullscreenheight = [
			{ value: true, label: __( 'Yes', 'jbprovider' ) },
			{ value: false, label: __( 'No', 'jbprovider' ) },
		];		
		 const position = [
			 { value: 'top', label: __( 'Top', 'jbprovider' ) },
			 { value: 'center', label: __( 'Center', 'jbprovider' ) },
			 { value: 'bottom', label: __( 'Bottom', 'jbprovider' ) },
		 ];

		 const position_x = [
			{ value: 'center', label: __( 'Center', 'jbprovider' ) },
			{ value: 'left', label: __( 'Left', 'jbprovider' ) },			
			{ value: 'right', label: __( 'Right', 'jbprovider' ) },
		];
		 const inspectorControls = (
			 <InspectorControls>
				 <PanelBody title={ __( 'Slider Setting', 'jbprovider' ) }>
					 {/* <SelectControl
						 label={ __( 'Show Controls', 'jbprovider' ) }
						 options={ hide_control }
						 value={ props.attributes.hidecontrol }
						 onChange={ ( hidecontrol ) => props.setAttributes( { hidecontrol } ) }
					 /> */}
					 <SelectControl
						 label={ __( 'Arrow Controls', 'jbprovider' ) }
						 options={ arrow_control }
						 value={ props.attributes.arrowcontrol }
						 onChange={ ( arrowcontrol ) => props.setAttributes( { arrowcontrol } ) }
					 />
					 {/* <SelectControl
						 label={ __( 'Caption position Y', 'jbprovider' ) }
						 options={ position }
						 value={ props.attributes.position }
						 onChange={ ( position ) => props.setAttributes( { position } ) }
					 /> */}
					 <SelectControl
						 label={ __( 'Caption position X', 'jbprovider' ) }
						 options={ position_x }
						 value={ props.attributes.position_x }
						 onChange={ ( position_x ) => props.setAttributes( { position_x } ) }
					 />
					  <SelectControl
						 label={ __( 'Show overlay layer', 'jbprovider' ) }
						 options={ showoverlay }
						 value={ props.attributes.showoverlay }
						 onChange={ ( showoverlay ) => props.setAttributes( { showoverlay } ) }
					 />
					 <SelectControl
						 label={ __( 'Show full screen height', 'jbprovider' ) }
						 options={ fullscreenheight }
						 value={ props.attributes.fullscreenheight }
						 onChange={ ( fullscreenheight ) => props.setAttributes( { fullscreenheight } ) }
					 />
					 <TextControl
						 label={ __( 'Speed', 'jbprovider' ) }
						 type="text"
						 value={ props.attributes.slider_speed }
						 onChange={ ( slider_speed ) => props.setAttributes( { slider_speed } ) }
					 />
					 <TextControl
						 label={ __( 'Slide item on a screen', 'jbprovider' ) }
						 type="text"
						 value={ props.attributes.slider_items }
						 onChange={ ( slider_items ) => props.setAttributes( { slider_items} ) }
					 />
					 <TextControl
						 label={ __( 'Slide items to scroll', 'jbprovider' ) }
						 type="text"
						 value={ props.attributes.slidestoscroll }
						 onChange={ ( slidestoscroll ) => props.setAttributes( { slidestoscroll} ) }
					 />
					 <TextControl
						label={ __('Section id', 'jbprovider')}
						placeholder={ __('Section id', 'jbprovider')}
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
					 label={ __( 'Title','jbprovider' ) }
					 placeholder={ __( 'Slider title', 'jbprovider' ) }
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
					 label={ __( 'Description','jbprovider' ) }
					 placeholder={ __( 'Slider description', 'jbprovider' ) }
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
					 placeholder={ __( 'Button Link', 'jbprovider' ) }
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
					 placeholder={ __( 'Button text', 'jbprovider' ) }
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
			<Tooltip text={__('This is JB Slider', 'jbprovider')}>
				 <div className="jb-block-title">
					 {__('JB Slider', 'jbprovider')}
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