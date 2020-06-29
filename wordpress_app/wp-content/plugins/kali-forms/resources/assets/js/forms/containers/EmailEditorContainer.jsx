import { observer } from "mobx-react-lite";
import React from 'react';
import EmailEditor from './../components/EmailBuilder/EmailEditor';
import Button from '@material-ui/core/Button';
import { store } from "./../store/store";
import Paper from '@material-ui/core/Paper';
import { makeStyles } from '@material-ui/core/styles';
import EmailWizard from './../components/EmailWizard/EmailWizard';
import Typography from '@material-ui/core/Typography';
const emailContainerStyles = makeStyles(theme => {
	return {
		paper: { padding: theme.spacing(3), marginTop: theme.spacing(2) },
		formEmailsPlaceholder: {
			padding: theme.spacing(3), marginTop: theme.spacing(2),
			textAlign: 'center'
		}
	}
});

const EmailEditorContainer = observer(props => {
	const classes = emailContainerStyles();
	return (
		<React.Fragment>
			<Choose>
				<When condition={!store._EMAILS_.emails.length}>
					<Paper className={classes.formEmailsPlaceholder}>
						<Typography variant="subtitle1">{KaliFormsObject.translations.formEmails.addEmailPlaceholder}</Typography>
						<Button variant="contained" color="primary" onClick={event => store._EMAILS_.emailWizardVisibility = true}>{KaliFormsObject.translations.formEmails.addEmailPlaceholderButton}</Button>
					</Paper>
				</When>
				<When condition={store._EMAILS_.emails.length && store._UI_.activeEmailInSidebar === false}>
					<Paper className={classes.formEmailsPlaceholder}>
						<Typography variant="subtitle1">{KaliFormsObject.translations.formEmails.selectEmail}</Typography>
					</Paper>
				</When>
				<Otherwise>
					<EmailEditor />
				</Otherwise>
			</Choose>
			<EmailWizard />
		</React.Fragment>
	);
})

export default EmailEditorContainer;
