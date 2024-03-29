import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload, InspectorControls } from '@wordpress/block-editor';
import { TextControl, ColorPicker, Tooltip, PanelBody } from '@wordpress/components';
import {
	faTrashAlt
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon} from '@fortawesome/react-fontawesome';


const JBProjectsEdit = (props) =>{
	const { projects } = props.attributes;

	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={__('JB Projects settings', 'jbapp')} >
			<h4>{ __('Section background color', 'jbapp')}</h4>
			<ColorPicker
			color={ props.attributes.background_color }
            onChangeComplete={ ( value ) => props.setAttributes({background_color: value.hex}) }
            disableAlpha
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
	if( !props.attributes.id ){
		const id = 'jb_projects';
		props.setAttributes({
			id
		});
	}
	const projectsList = projects
		.sort( (a,b)=> a.index - b.index )
		.map(project=>{
			return (
				<div className="jbprojects-item">
					<div className="inner">
						<a href="#"
							className="remove_image"
							onClick={() => {
								const newProject = projects
								 .filter(item => item.index != project.index)
								 .map(t => {
								 	if( t.index < project.index ){
								 		t.index -= 1;
								 	}
								 	return t;
								 });
								props.setAttributes({
									projects: newProject
								});

							}}
							>
							<FontAwesomeIcon icon={faTrashAlt} />
							</a>

							<MediaUpload
							onSelect={media => {
								let image = media.sizes.full
								? media.sizes.full.url
								: media.url;
								let newObject = Object.assign({}, project, {
									image: image
								});
								props.setAttributes({
									projects: [
										...projects.filter(
											item => item.index != project.index
										),
										newObject
									]
								});
							}}
							type="image"
							value={project.image}
							render={({ open })=>
							!! project.image ? (
								<div>
								<img className="image" src={project.image} onClick={open} />
								</div>
								): (
								<a href="#"
									className="banner_image_select"
									onClick={open}
									>
									Select image
									</a>
								)
							}
							/>
							<RichText
								label={ __('Project title', 'jbapp')}
								placeholder={ __('Project title', 'jbapp')}
								tagName="h3"
								value={ project.title }
								onChange={ (title) => {
									const newObject = Object.assign({}, project, {
										title: title
									});
									props.setAttributes({
										projects: [
										...projects.filter(
											item => item.index != project.index
											),
											newObject
										]
									});
								}}
								/>	
							<RichText
								label={ __('Project Subtitle', 'jbapp')}
								placeholder={ __('Project Subtitle', 'jbapp')}
								tagName="p"
								value={ project.subtitle }
								onChange={ (subtitle) => {
									const newObject = Object.assign({}, project, {
										subtitle: subtitle
									});
									props.setAttributes({
										projects: [
										...projects.filter(
											item => item.index != project.index
											),
											newObject
										]
									});
								}}
								/>	
								<TextControl
								label={ __('Project link', 'jbapp')}
								type="text"
								value={ project.link }
								onChange={ (link) => {
									const newObject = Object.assign({}, project, {
										link: link
									});
									props.setAttributes({
										projects: [
										...projects.filter(
											item => item.index != project.index
											),
											newObject
										]
									});
								}}
								/>
					</div>
				</div>
			);
		});
	return ([
			inspectorControls,	   
			<Tooltip text={__("This is projects section",'jbapp')}>
				<div className="jb-block-title">
					{__('JB Projects', 'jbapp')}
				</div>
			</Tooltip>, 
			<div>
				<RichText
					label={ __('Section title', 'jbapp')}
					placeholder={ __('Section title', 'jbapp')}
					tagName="h2"
					value={ props.attributes.title }
					onChange={ (title) => props.setAttributes({title})}
					/>	
				<RichText
					label={ __('Section Subtitle', 'jbapp')}
					placeholder={ __('Section Subtitle', 'jbapp')}
					tagName="p"
					value={ props.attributes.subtitle }
					onChange={ (subtitle) => props.setAttributes({subtitle})}
					/>	
				<div className="jbprojects-wrapper">
				{projectsList}
				<button
					className="add-more-projects jb-add-more-btn"
					onClick={content => 
						props.setAttributes({
							projects: [
								...props.attributes.projects,
								{
									index: props.attributes.projects.length,
									title: "",
									subtitle: "",
									link: ""
								}
							]
						})
					}
					>
					+
					</button>
				</div>
				
					</div>
		]
		);
}
export default JBProjectsEdit;