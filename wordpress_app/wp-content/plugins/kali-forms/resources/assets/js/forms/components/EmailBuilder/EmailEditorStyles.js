import { makeStyles } from '@material-ui/core/styles';
import { red } from '@material-ui/core/colors';
const emailEditorStyles = makeStyles(theme => {
	return {
		paper: { padding: theme.spacing(3), marginTop: theme.spacing(2) },
		buttonDanger: {
			color: theme.palette.getContrastText(red[500]),
			backgroundColor: red[500],
			'&:hover': {
				backgroundColor: red[700],
			},
		},
		formEmailsPlaceholder: {
			padding: theme.spacing(3), marginTop: theme.spacing(2),
			textAlign: 'center'
		}
	}
});

export default emailEditorStyles;
