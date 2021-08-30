import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
const JBTeamSave = (props)=>{
	let { id, teams} = props.attributes;
	const teamsList = teams.map(function(team, i) {
		let keyVal = 'team-item-'+i;
		return (
			<Fragment>
			<div className="jb-team-item col-md-3 col-sm-12" key={keyVal}>
				<div className="jb-team-item-inner">
					<span className="jb-team-item-index" style={{ display: "none" }}>
						{team.index}
					</span>
					{team.image && (
					<p className="jb-team-image-wrapper"><img src={team.image} className="jb-team-item-image" alt={__('Team image', 'jbtheme')} /></p>
					)}
					{ team.name && (
					<RichText.Content tagName="p" className="jb-team-item-name" value={team.name} />
					)}
					{ team.job_title && (
						<p className="jb-team-item-job-title">{team.job_title}</p>
					)}	
					<ul className="jb-team-social-list">
					{ team.facebook != '' && (
						<li>
							<a className="jb-team-item-facebook" href={team.facebook}><i class="fab fa-facebook-square"></i></a>
						</li>
					)}				
					{ team.twitter != '' && (
						<li>
							<a className="jb-team-item-twitter" href={team.twitter}><i class="fab fa-twitter-square"></i></a>
						</li>
					)}	
					{ team.linkedin != '' && (
						<li>
							<a className="jb-team-item-linkedin" href={team.linkedin}><i class="fab fa-linkedin"></i></a>
						</li>
					)}				
					{ team.google && (
						<li>
							<a className="jb-team-item-google" href={team.google}><i class="fab fa-google-plus-square"></i></a>
						</li>
					)}
					</ul>
				</div>
			</div>
			</Fragment>
				
		);

	});
	return (
		<Fragment>
			<div className="jb-team-wrapper jb-section" id={id} style={{backgroundColor: props.attributes.background_color}} >
				<div className="inner jb-team-inner container">
					<h3 className="jb-team-title section-title">{props.attributes.title}</h3>
					<p className="jb-team-subtitle section-subtitle">{props.attributes.subtitle}</p>
					<div className="jb-team-list-wrapper row animate__animated fadeInUp" data-scroll>
						{teamsList}
					</div>
				</div>
			</div>
		</Fragment>
		);
} 
export default JBTeamSave;