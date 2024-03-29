import { __ } from '@wordpress/i18n';
import { RichText} from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
const Aboutus = (props)=>{
	const cl = "jb-section jb-abouts-wrapper "+props.className;
	return (
		<Fragment>
			<div className={cl} id={props.section_id} style={{backgroundColor: props.background_color}}>
				<div className="inner jb-aboutus-inner container">
					<div className="jb-about-left animate__animated fadeInLeft" data-scroll>
						<div className="inner">
							{props.title && (
							<RichText.Content tagName="h3" className="section-title aboutus-title section-title-left" value={props.title} />
							)}
							{ props.subtitle && (
							<RichText.Content tagName="p" className="section-subtitle aboutus-subtitle" value={props.subtitle} />
							)}
							{ props.content && (
							<RichText.Content tagName="p" className="aboutus-content" value={props.content} />
							)}
							</div>
					</div>
					<div className="jb-about-right ">
						<div className="inner">
							{props.image && (
							<img src={props.image} className="aboutus-image animate_animated fadeInRight" data-scroll alt={props.title} />
							)}
							</div>
					</div>
				</div>
			</div>
		</Fragment>
		);
}
export default Aboutus;