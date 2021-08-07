import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
const JBProjectsSave = (props)=>{
	let { id, projects} = props.attributes;
	const projectsList = projects.map(function(project, i) {
		let keyVal = 'project-item-'+i;
		return (
			<Fragment>
			<div className="jb-projects-item" key={keyVal}>
				<span className="jb-project-item-index" style={{ display: "none" }}>
                    {project.index}
                </span>
				{project.image && (
				<img src={project.image} className="jb-project-item-image" alt={__('project image', 'jbtheme')} />
				)}
				<div className="jb-project-hover">
					<a href={project.link} target="_blank"  rel="noopener"><i class="fas fa-link"></i></a>
				</div>
				<div className="jb-project-footer-content">
				 <a href={project.link} target="_blank" className="jb-project-item-button" rel="noopener" >
				{project.title && (
				<RichText.Content tagName="h3" className="jb-project-item-title" value={project.title} />
				)}
				{ project.subtitle && (
				<RichText.Content tagName="p" className="jb-project-item-subtitle" value={project.subtitle} />
				)}
				</a>
				</div>
			</div>
			</Fragment>
				
		);

	});
	return (
		<Fragment>
			<div className="jb-projects-wrapper jb-section" id={id} style={{backgroundColor: props.attributes.background_color}} >
				<div className="inner jb-projects-inner">
				<h3 className="jb-projects-title section-title">{props.attributes.title}</h3>
				<p className="jb-projects-subtitle section-subtitle">{props.attributes.subtitle}</p>
				<div className="jb-projects-list">
					{projectsList}
				</div>
				</div>
			</div>
		</Fragment>
		);
} 
export default JBProjectsSave;