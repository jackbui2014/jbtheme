import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload, PlainText, InspectorControls } from '@wordpress/block-editor';
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
                {showoverlay && (<div className="slide-overlay"></div>) }
                {slide.image && ( <img  data-lazy={slide.image}  className="d-block w-100" alt={slide.title} /> )}
                <div className={classes_position}>
                    <div className="caption-inner">
                    <span className="slide-index" style={{ display: "none" }}>
                    {slide.index}
                    </span>
                    {slide.title && ( <h2 className="slide-title">{slide.title}</h2> )}
                    {slide.description && ( <RichText.Content tagName="p" className="slide-description" value={slide.description} />)}
                    {slide.link && ( 
                        <div className="jb-slide-button">
                        <a href={slide.link} target="_blank" className="slide-button btn jb-btn-secondary" rel="noopener"><span>{slide.link_text}</span></a>
                        </div>
                        )}
                    </div>
                </div>
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
