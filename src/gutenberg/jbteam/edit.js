import { __ } from '@wordpress/i18n';
import { RichText, MediaUpload, InspectorControls } from '@wordpress/block-editor';
import { TextControl, ColorPicker, Tooltip, PanelBody } from '@wordpress/components';
import {
	faTrashAlt
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon} from '@fortawesome/react-fontawesome';


const JBTeamEdit = (props) =>{
	const { teams } = props.attributes;

	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={__('Teams settings', 'jbtheme')} >
			<h4>{ __('Section background color', 'jbtheme')}</h4>
			<ColorPicker
			color={ props.attributes.background_color }
            onChangeComplete={ ( value ) => props.setAttributes({background_color: value.hex}) }
            disableAlpha
			/>
			</PanelBody>
		</InspectorControls>
	);
	if( !props.attributes.id ){
		const id = `team${Math.floor(Math.random() * 100)}`;
		props.setAttributes({
			id
		});
	}
	const teamsList = teams
		.sort( (a,b)=> a.index - b.index )
		.map(team=>{
			return (
				<div className="team-item">
					<div className="inner">
						<a href="#"
							className="remove_image"
							onClick={() => {
								const newTeam = teams
								 .filter(item => item.index != team.index)
								 .map(t => {
								 	if( t.index < team.index ){
								 		t.index -= 1;
								 	}
								 	return t;
								 });
								props.setAttributes({
									teams: newTeam
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
								let newObject = Object.assign({}, team, {
									image: image
								});
								props.setAttributes({
									teams: [
										...teams.filter(
											item => item.index != team.index
										),
										newObject
									]
								});
							}}
							type="image"
							value={team.image}
							render={({ open })=>
							!! team.image ? (
								<div>
								<img className="image" src={team.image} onClick={open} />
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
								placeholder={ __('Name', 'jbtheme')}
								tagName="p"
								value={ team.name }
								onChange={ (name) => {
									const newObject = Object.assign({}, team, {
										name: name
									});
									props.setAttributes({
										teams: [
										...teams.filter(
											item => item.index != team.index
											),
											newObject
										]
									});
								}}
								/>	
								<TextControl
								placeholder={ __('Job title', 'jbtheme')}
								type="text"
								value={ team.job_title }
								onChange={ (job_title) => {
									const newObject = Object.assign({}, team, {
										job_title: job_title
									});
									props.setAttributes({
										teams: [
										...teams.filter(
											item => item.index != team.index
											),
											newObject
										]
									});
								}}
								/>
								<TextControl
								placeholder={ __('Facebook URL', 'jbtheme')}
								type="text"
								value={ team.facebook }
								onChange={ (facebook) => {
									const newObject = Object.assign({}, team, {
										facebook: facebook
									});
									props.setAttributes({
										teams: [
										...teams.filter(
											item => item.index != team.index
											),
											newObject
										]
									});
								}}
								/>
								<TextControl
								placeholder={ __('Twitter URL', 'jbtheme')}
								type="text"
								value={ team.twitter }
								onChange={ (twitter) => {
									const newObject = Object.assign({}, team, {
										twitter: twitter
									});
									props.setAttributes({
										teams: [
										...teams.filter(
											item => item.index != team.index
											),
											newObject
										]
									});
								}}
								/>
								<TextControl
								placeholder={ __('Linkedin URL', 'jbtheme')}
								type="text"
								value={ team.linkedin }
								onChange={ (linkedin) => {
									const newObject = Object.assign({}, team, {
										linkedin: linkedin
									});
									props.setAttributes({
										teams: [
										...teams.filter(
											item => item.index != team.index
											),
											newObject
										]
									});
								}}
								/>
								<TextControl
								placeholder={ __('Google + URL', 'jbtheme')}
								type="text"
								value={ team.google }
								onChange={ (google) => {
									const newObject = Object.assign({}, team, {
										google: google
									});
									props.setAttributes({
										teams: [
										...teams.filter(
											item => item.index != team.index
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
			<Tooltip text={__("This is JB Team section",'jbtheme')}>
				<div className="jb-block-title">
					{__('JB Team', 'jbtheme')}
				</div>
			</Tooltip>, 
			<div>
				<RichText
					label={ __('Section title', 'jbtheme')}
					placeholder={ __('Section title', 'jbtheme')}
					tagName="h2"
					value={ props.attributes.title }
					onChange={ (title) => props.setAttributes({title})}
					/>	
				<RichText
					label={ __('Section Subtitle', 'jbtheme')}
					placeholder={ __('Section Subtitle', 'jbtheme')}
					tagName="p"
					value={ props.attributes.subtitle }
					onChange={ (subtitle) => props.setAttributes({subtitle})}
					/>	
				<div className="jb-teams-wrapper">
				{teamsList}
				<button
					className="add-more-team jb-add-more-btn"
					onClick={content => 
						props.setAttributes({
							teams: [
								...props.attributes.teams,
								{
									index: props.attributes.teams.length,
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
export default JBTeamEdit;