import Grid from '@material-ui/core/Grid';
import React, { useEffect, useState } from 'react';
import PlaceholderDialogOpener from './../../components/PlaceholderDialog/PlaceholderDialogOpener'
import TextField from '@material-ui/core/TextField'
import Checkbox from '@material-ui/core/Checkbox'
import FormControlLabel from '@material-ui/core/FormControlLabel'
import InputAdornment from '@material-ui/core/InputAdornment';
import { Typography } from '@material-ui/core';
import Button from '@material-ui/core/Button';
import TrashIcon from '@material-ui/icons/Delete'
import CopyIcon from '@material-ui/icons/FileCopy'
import Paper from '@material-ui/core/Paper';
import emailEditorStyles from './EmailEditorStyles';
import { observer } from "mobx-react-lite";
import { store } from "./../../store/store";
import MUIRichTextEditor from 'mui-rte'
import { ContentState, convertToRaw } from 'draft-js'
import draftToHtml from 'draftjs-to-html'
import htmlToDraft from 'html-to-draftjs'
import CodeIcon from '@material-ui/icons/Code'

const EmailEditor = observer(props => {
	const classes = emailEditorStyles();
	let currentIndex = store._UI_.activeEmailInSidebar;
	const getFileFields = () => {
		let fieldComponents = [];

		store._FIELD_COMPONENTS_.fieldComponents.map(e => {
			if (e.id === 'fileUpload') {
				fieldComponents.push({
					type: e.id,
					name: e.properties.caption !== '' ? e.properties.caption : e.properties.id,
					value: e.properties.name,
					checked: false,
				})
			}
		});
		return fieldComponents;
	}
	const fileFields = getFileFields();

	const getInitialValue = (idx) => {
		if (typeof idx === 'undefined') {
			idx = store._UI_.activeEmailInSidebar;
		}
		let valFromStore = store._EMAILS_.emails[store._UI_.activeEmailInSidebar].emailBody;
		let initialValue = htmlToDraft(valFromStore);
		let state = convertToRaw(ContentState.createFromBlockArray(
			initialValue.contentBlocks,
			initialValue.entityMap
		));
		return state;
	}

	const [emailBody, setEmailBody] = useState('')

	useEffect(() => {
		if (!store._EMAILS_.emails.length && !isNaN(store._UI_.activeEmailInSidebar)) {
			return;
		}

		let state = getInitialValue(currentIndex);
		setEmailBody(JSON.stringify(state));
		return () => setEmailBody('');
	}, [currentIndex])

	const setEmailBodyToString = (val) => {
		debouncedSaveToStore(val, currentIndex);
	}

	const saveToStore = (value, currentIndex) => {
		let currentContent = value.getCurrentContent();
		let state = draftToHtml(convertToRaw(currentContent));
		store._EMAILS_.setEmailProp(currentIndex, 'emailBody', state)
	}
	const debouncedSaveToStore = _.debounce(saveToStore, 500);

	const changeEmailAttachmentCheckbox = (e, val) => {
		let currentState = store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'emailAttachment');
		let arr = currentState === '' ? [] : currentState.split(',');
		e.target.checked ? arr.push(val) : arr = arr.filter(e => e !== val)
		store._EMAILS_.setEmailProp(store._UI_.activeEmailInSidebar, 'emailAttachment', arr.join(','))
	}

	/**
	 * Remove email ( happens after dialog )
	 */
	const _removeEmail = () => {
		// let proposedIdx = store._UI_.activeEmailInSidebar === 0 ? 0 : store._UI_.activeEmailInSidebar - 1;
		let idx = store._UI_.activeEmailInSidebar;
		store._UI_.setActiveEmailInSidebar(false);
		store._EMAILS_.removeEmail(idx);
	}
	/**
	 * Duplicate email ( happens after dialog )
	 */
	const _duplicateEmail = () => {
		store._EMAILS_.duplicateEmail(store._UI_.activeEmailInSidebar);
	}

	/**
	 * Duplicates an email
	 */
	const duplicateEmail = () => {
		store._CONFIRMATION_DIALOG_.setTitle(KaliFormsObject.translations.alerts.duplicateEmailTitle);
		store._CONFIRMATION_DIALOG_.setMessage(KaliFormsObject.translations.alerts.duplicateEmailMessage);
		store._CONFIRMATION_DIALOG_.setAction(_duplicateEmail)
		store._CONFIRMATION_DIALOG_.setState(true);
	}
	/**
	 * Removes an email from the list
	 */
	const removeEmail = () => {
		store._CONFIRMATION_DIALOG_.setTitle(KaliFormsObject.translations.alerts.removeEmailTitle);
		store._CONFIRMATION_DIALOG_.setMessage(KaliFormsObject.translations.alerts.removeEmailMessage);
		store._CONFIRMATION_DIALOG_.setAction(_removeEmail)
		store._CONFIRMATION_DIALOG_.setState(true);
	}

	return (
		<React.Fragment>
			<Paper className={classes.paper}>
				<Grid container direction="row" spacing={6}>
					<Grid item xs={6}>
						<TextField type="text"
							label={KaliFormsObject.translations.formEmails.subject}
							id="emailSubject"
							value={store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'emailSubject')}
							placeholder={KaliFormsObject.translations.formEmails.subjectPlaceholder}
							fullWidth={true}
							variant="filled"
							InputProps={{
								endAdornment: (
									<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
								),
							}}
							onChange={e => store._EMAILS_.setEmailProp(store._UI_.activeEmailInSidebar, 'emailSubject', e.target.value)} />
					</Grid>
					<Grid item xs={6}>
						<TextField type="text"
							id="fromName"
							label={KaliFormsObject.translations.formEmails.fromName}
							value={store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'fromName')}
							placeholder="John Doe..."
							fullWidth={true}
							variant="filled"
							InputProps={{
								endAdornment: (
									<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
								),
							}}
							onChange={e => store._EMAILS_.setEmailProp(store._UI_.activeEmailInSidebar, 'fromName', e.target.value)}
						/>
					</Grid>
				</Grid>
				<Grid container direction="row" spacing={6}>
					<Grid item xs={6}>
						<TextField type="text"
							label={KaliFormsObject.translations.formEmails.fromEmail}
							id="fromEmail"
							value={store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'fromEmail')}
							placeholder="johndoe@wordpress.site"
							fullWidth={true}
							variant="filled"
							InputProps={{
								endAdornment: (
									<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
								),
							}}
							onChange={e => store._EMAILS_.setEmailProp(store._UI_.activeEmailInSidebar, 'fromEmail', e.target.value)}
						/>
					</Grid>
					<Grid item xs={6}>
						<TextField type="text"
							label={KaliFormsObject.translations.formEmails.toEmail}
							id="toEmail"
							value={store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'toEmail')}
							placeholder="janedoe@wordpress.site"
							fullWidth={true}
							variant="filled"
							InputProps={{
								endAdornment: (
									<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
								),
							}}
							onChange={e => store._EMAILS_.setEmailProp(store._UI_.activeEmailInSidebar, 'toEmail', e.target.value)} />
					</Grid>
				</Grid>
				<Grid container direction="row" spacing={6}>
					<Grid item xs={4}>
						<TextField type="text"
							label={KaliFormsObject.translations.formEmails.replyTo}
							id="replyTo"
							value={store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'replyTo')}
							placeholder="johndoe@wordpress.site"
							fullWidth={true}
							variant="filled"
							InputProps={{
								endAdornment: (
									<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
								),
							}}
							onChange={e => store._EMAILS_.setEmailProp(store._UI_.activeEmailInSidebar, 'replyTo', e.target.value)}
						/>
					</Grid>
					<Grid item xs={4}>
						<TextField type="text"
							label={KaliFormsObject.translations.formEmails.ccEmail}
							id="ccEmail"
							value={store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'ccEmail')}
							placeholder="johndoe@wordpress.site"
							fullWidth={true}
							variant="filled"
							InputProps={{
								endAdornment: (
									<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
								),
							}}
							onChange={e => store._EMAILS_.setEmailProp(store._UI_.activeEmailInSidebar, 'ccEmail', e.target.value)} />
					</Grid>
					<Grid item xs={4}>
						<TextField type="text"
							label={KaliFormsObject.translations.formEmails.bccEmail}
							id="bccEmail"
							value={store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'bccEmail')}
							placeholder="janedoe@wordpress.site"
							fullWidth={true}
							variant="filled"
							InputProps={{
								endAdornment: (
									<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
								),
							}}
							onChange={e => store._EMAILS_.setEmailProp(store._UI_.activeEmailInSidebar, 'bccEmail', e.target.value)} />
					</Grid>
				</Grid>
				<Grid container direction="row" spacing={6}>
					<Grid item xs={12}>
						<MUIRichTextEditor
							label={KaliFormsObject.translations.formEmails.emailBody}
							value={emailBody}
							customControls={[
								{
									name: "open-placeholder-dialog",
									icon: <CodeIcon />,
									type: "callback",
									onClick: (editorState, name, anchor) => store._UI_.setPlaceholderDialog(true)
								}
							]}
							controls={["title", "bold", "italic", "link", "numberList", "bulletList", "open-placeholder-dialog"]}
							onChange={e => setEmailBodyToString(e)}
						/>
					</Grid>
				</Grid>
				<Grid container direction="row" spacing={6}>
					<Grid item xs={6}>
						<TextField type="text"
							id="emailAttachmentFilePaths"
							label={KaliFormsObject.translations.formEmails.emailAttachmentFilePaths}
							value={store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'emailAttachmentFilePaths')}
							InputProps={{
								startAdornment: <InputAdornment position="start">{KaliFormsObject.ABSPATH}</InputAdornment>,
							}}
							helperText={KaliFormsObject.translations.formEmails.pathToYourWpIs + ' ' + KaliFormsObject.ABSPATH}
							placeholder="path/to/file.zip"
							fullWidth={true}
							variant="filled"
							onChange={e => store._EMAILS_.setEmailProp(store._UI_.activeEmailInSidebar, 'emailAttachmentFilePaths', e.target.value)}
						/>
					</Grid>
					<Grid item xs={6}>
						<TextField type="text"
							id="emailAttachmentMediaIds"
							label={KaliFormsObject.translations.formEmails.emailAttachmentMediaIds}
							value={store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'emailAttachmentMediaIds')}
							helperText={KaliFormsObject.translations.formEmails.mediaAttachmentHelperText}
							fullWidth={true}
							variant="filled"
							onChange={e => store._EMAILS_.setEmailProp(store._UI_.activeEmailInSidebar, 'emailAttachmentMediaIds', e.target.value)}
						/>
					</Grid>
				</Grid>
				<If condition={fileFields.length > 0}>
					<Grid container direction="row" spacing={6}>
						<Grid item xs={12}>
							<Typography variant="body1">
								{KaliFormsObject.translations.formEmails.fileUploadSelection}
								<br />
							</Typography>
							{
								fileFields.map(field => (
									<FormControlLabel
										key={field.value}
										control={
											<Checkbox
												checked={store._EMAILS_.getPropertyValue(store._UI_.activeEmailInSidebar, 'emailAttachment').split(',').includes(field.value)}
												onChange={e => changeEmailAttachmentCheckbox(e, field.value)}
												key={field.value}
												value={field.value} />
										}
										label={field.name}
									/>
								))}
						</Grid>
					</Grid>
				</If>
				<Grid container direction="row" spacing={6}>
					<Grid item>
						<Button variant="contained" className={classes.buttonDanger} onClick={() => removeEmail()}><TrashIcon /> {KaliFormsObject.translations.formEmails.removeEmail}</Button>
					</Grid>
					<Grid item>
						<Button variant="contained" color="primary" onClick={() => duplicateEmail()}><CopyIcon />  {KaliFormsObject.translations.formEmails.duplicateEmail}</Button>
					</Grid>
				</Grid>
			</Paper>
		</React.Fragment>
	);
})

export default EmailEditor;

