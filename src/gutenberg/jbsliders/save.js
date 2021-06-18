import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { RichText, MediaUpload, PlainText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import {Fragment, Component} from '@wordpress/element';

const JBSlidersSave = (props) =>{  
 
  const renderPosition = (param) =>{
    let cl = '';
    switch(param.position) {
      case 'top':
        cl += 'align-items-top';
        break;
      case 'bottom':
          console.log('entered');
        cl += 'align-items-bottom';
        break;
      default:
        cl += 'align-items-center';
        break;
    }
    switch(param.position_x) {
        case 'left':
          cl += ' justify-content-left';
          break;
        case 'right':
          cl += ' justify-content-right';
          break;
        default:
          cl += ' justify-content-center';
          break;
      }
      return cl;
  }
    const { id, slideritem } = props.attributes;
    const target_id = "#" + id;
    let classes_position = "col-12 text-center " + renderPosition(props.attributes);
    const sliderList = slideritem.map(function(slide, i) {
        return (  
            <div className={i === 0 ? "carousel-item active" : "carousel-item"} data-index={i}>
                {slide.image && ( <img src={slide.image} className="d-block w-100" alt={slide.title} /> )}
                <div className={classes_position}>
                    <div className="caption-inner">
                    <span className="slide-index" style={{ display: "none" }}>
                    {slide.index}
                    </span>
                    {slide.title && ( <h2>{slide.title}</h2> )}
                    {slide.description && ( <RichText.Content tagName="h3" value={slide.description} />)}
                    {slide.link && ( 
                        <div className="scc-button text-center">
                        <button type="button" className="watch-video-btn btn btn-colour text-white btn-style" data-video={slide.link} data-toggle="modal" data-target={"#carousel-video" + id + i}>Watch the video<span className="fa fa-plus text-white"></span></button>
                        <button type="button" className="watch-video-btn btn-play-icon btn btn-primary" data-video={slide.link} data-toggle="modal" data-target={"#carousel-video" + id + i}><span className="px-2"><i className="fa fa-play" aria-hidden="true"></i></span></button>
                        </div>
                        )}
                    </div>
                </div>
                {slide.link && (
                <div className="modal fade" id={"carousel-video" + id + i} tabindex="-1" role="dialog" aria-labelledby={"carousel-video" + id + i} aria-hidden="true">
                    <div className="modal-dialog modal-dialog-centered" role="document">
                    <div className="modal-content">
                        <div className="modal-body">
                        <iframe className="video-iframe" src={slide.link} frameborder="0" allowfullscreen></iframe>
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
                )}
            </div>
        );
    });
    const sliderNav = slideritem.map(function(slide, i) { 
        return (
            <li data-target={target_id} data-slide-to={i} className={i === 0 ? "active" : ""}></li>
        );
    });
    if (slideritem.length > 0) {   
        const settings = {
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1
          };
    return (
        <Fragment>
        <div class="sliders-wrapper">
            <div id={id} class="carousel slide carousel-fade" data-ride="carousel" data-interval={props.attributes.slider_speed}>
                {props.attributes.hidecontrol == "yes" && (
                <ol class="carousel-indicators">
                    {sliderNav}
                </ol>
                )}
                <div class="carousel-inner position-relative">
                {sliderList}
                </div>
                {props.attributes.arrowcontrol == "yes" && (
                <div><a class="carousel-control-prev" href={target_id} role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
                <a class="carousel-control-next" href={target_id}  role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>
                )}
            </div>
        </div>                    
        </Fragment>
    );
    } else return (<Fragment></Fragment>);  

}
export default JBSlidersSave;