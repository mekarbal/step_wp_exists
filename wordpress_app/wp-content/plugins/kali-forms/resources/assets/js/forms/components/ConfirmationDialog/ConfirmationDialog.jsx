import React from 'react';
import Button from '@material-ui/core/Button';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';
import { observer } from "mobx-react-lite";
import { store } from "./../../store/store";
import InfoIcon from '@material-ui/icons/InfoTwoTone';

const ConfirmationDialog = observer((props) => {
	const handleClose = (e) => {
		store._CONFIRMATION_DIALOG_.resetState()
	}
	const handleAccept = () => {
		if (typeof store._CONFIRMATION_DIALOG_.action === 'function') {
			store._CONFIRMATION_DIALOG_.action.call(this, store._CONFIRMATION_DIALOG_.actionProps);
			store._CONFIRMATION_DIALOG_.resetState();
		}
	}
	return (
		<React.Fragment>
			<Dialog
				open={store._CONFIRMATION_DIALOG_.state}
				onClose={handleClose}
				aria-labelledby="alert-dialog-title"
				aria-describedby="alert-dialog-description"
			>
				<DialogTitle id="alert-dialog-title">{store._CONFIRMATION_DIALOG_.title}</DialogTitle>
				<DialogContent>
					<DialogContentText id="alert-dialog-description" >
						{store._CONFIRMATION_DIALOG_.message}
					</DialogContentText>
				</DialogContent>
				<DialogActions>
					<Button onClick={handleClose} variant="contained" color="secondary">
						{KaliFormsObject.translations.general.cancel}
					</Button>
					<Button onClick={handleAccept} variant="contained" color="primary" autoFocus>
						{KaliFormsObject.translations.general.ok}
					</Button>
				</DialogActions>
			</Dialog>
		</React.Fragment>
	);
});

export default ConfirmationDialog;
