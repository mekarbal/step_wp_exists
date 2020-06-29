import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemText from '@material-ui/core/ListItemText';
import AddIcon from '@material-ui/icons/Add';
import { observer } from "mobx-react-lite";
import React from 'react';
import { store } from "./../../store/store";
import emailBuilderSidebarStyles from './EmailBuilderSidebarStyles';

const EmailBuilderSidebar = observer((props) => {
	const classes = emailBuilderSidebarStyles(props);

	return (
		<List>
			{
				store._EMAILS_.emails.map((e, idx) => (
					<ListItem
						key={idx}
						button
						selected={store._UI_.activeEmailInSidebar === idx}
						onClick={event => store._UI_.setActiveEmailInSidebar(idx)}
					>
						<ListItemText primary={'#' + (idx + 1) + ' ' + store._EMAILS_.emails[idx].emailSubject} />
					</ListItem>
				))
			}
			<ListItem button onClick={event => store._EMAILS_.emailWizardVisibility = true}>
				<ListItemText
					primary={<React.Fragment>
						<AddIcon /> {KaliFormsObject.translations.formEmails.addEmail}
					</React.Fragment>}
					className={classes.addEmailButton}
				/>
			</ListItem>
		</List>
	)
})

export default EmailBuilderSidebar;
