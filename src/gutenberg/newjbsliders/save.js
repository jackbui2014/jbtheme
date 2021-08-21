import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload, PlainText, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import {Fragment, useEffect} from '@wordpress/element';
import "slick-carousel/slick/slick.css"; 
import "slick-carousel/slick/slick-theme.css";

const JBSlidersSave = (props) =>{  
  const renderPosition = (param) =>{
    let cl = '';
    switch(param.position_x) {
        case 'left':
          cl += 'caption-item text-left justify-content-left';
          break;
        case 'right':
          cl += 'caption-item text-right justify-content-right';
          break;
        default:
          cl += 'caption-item text-center justify-content-center';
          break;
      }
      return cl;
  }
    const fullScreenHeight = (param) =>{
      if( param ){
        return 'jb-slider-inner full-screen-height';
      }
      return 'jb-slider-inner';
    }
    const { id, slideritem, showoverlay } = props.attributes;
    const target_id = "#" + id;
    let classes_position = renderPosition(props.attributes);
    let fh = fullScreenHeight(props.attributes.fullscreenheight);
    if( slideritem.length == 1 ){
      fh += " jb-page-banner";
    }
    const sliderList = slideritem.map(function(slide, i) {
        return (  
            <div className="jb-slide-item" data-index={i}>
               <InnerBlocks.Content />
            </div>
        );
    });
    if (slideritem.length > 0) {   
      let {
        slider_items,
        arrowcontrol,
        slidestoscroll,
        slider_speed
      } = props.attributes;
    return (
        <Fragment>
        <div class="jb-sliders-wrapper">
            <div id={id} class={fh} data-slidetoshow={slider_items} data-arrowcontrol={arrowcontrol} data-slidestoscroll={slidestoscroll} data-sliderspeed={slider_speed} >
                {sliderList}
            </div>
        </div>                    
        </Fragment>
    );
    } else return (<Fragment></Fragment>);  

}
export default JBSlidersSave;
