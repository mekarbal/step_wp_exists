import { makeStyles } from '@material-ui/core/styles';
const conditionalLogicStyles = makeStyles(theme => {
	return {
		checkboxLabel: {
			fontWeight: 400,
			transform: 'scale(0.75)',
			color: 'rgba(0, 0, 0, 0.54)',
			position: 'relative',
			top: 10,
		}
	}
});

export default conditionalLogicStyles;
