import { makeStyles } from '@material-ui/core/styles';
const emailWizardStyles = makeStyles(theme => ({
	button: {
		marginTop: theme.spacing(1),
		marginRight: theme.spacing(1),
	},
	actionsContainer: {
		marginBottom: theme.spacing(2),
	},
	resetContainer: {
		padding: theme.spacing(3),
	},
}));

export default emailWizardStyles;
