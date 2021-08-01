import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import Aboutus from '../../components/aboutus';
const AboutusSave = (props)=>{
	return (
		<Fragment>
			<Aboutus 
				image={props.attributes.image}
				content={props.attributes.content}
				title={props.attributes.title}
				subtitle={props.attributes.subtitle}
				background_color={props.attributes.background_color}
				 />
		</Fragment>
		);
} 
export default AboutusSave;