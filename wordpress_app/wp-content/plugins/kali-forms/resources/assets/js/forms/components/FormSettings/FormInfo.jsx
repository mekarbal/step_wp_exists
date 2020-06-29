import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormGroup from '@material-ui/core/FormGroup';
import Grid from '@material-ui/core/Grid';
import Switch from '@material-ui/core/Switch';
import TextField from '@material-ui/core/TextField';
import Typography from '@material-ui/core/Typography';
import React, { useEffect, useState } from 'react';
import PlaceholderDialogOpener from './../PlaceholderDialog/PlaceholderDialogOpener'
import { observer } from "mobx-react-lite";
import { store } from "./../../store/store";

const FormInfo = observer((props) => {
	/**
	 * Returns a boolean, if we have the plugin installed it should be true
	 */
	const saveFormSubmissionsInstalled = () => KaliFormsObject.hasOwnProperty('submissionViewPage');
	return (
		<React.Fragment>
			<Grid container direction="row" spacing={6}>
				<Grid item>
					<Typography variant="h5">{KaliFormsObject.translations.formInfo.generalSettings}</Typography>
				</Grid>
			</Grid>

			<Grid container direction="row" spacing={6}>
				<Grid item xs={6}>
					<TextField
						label={KaliFormsObject.translations.formInfo.requiredFieldMark}
						value={store._FORM_INFO_.requiredFieldMark}
						onChange={e => store._FORM_INFO_.requiredFieldMark = e.target.value}
						fullWidth={true}
						variant="filled"
						placeholder="(*)"
						inputProps={
							{ maxLength: 5 }
						}
					/>
				</Grid>
				<Grid item xs={6}>
					<TextField
						label={KaliFormsObject.translations.formInfo.multipleSelectionSeparator}
						value={store._FORM_INFO_.multipleSelectionsSeparator}
						onChange={e => store._FORM_INFO_.multipleSelectionsSeparator = e.target.value}
						fullWidth={true}
						variant="filled"
						placeholder=", or . or - or whatyouneed"
						inputProps={
							{ maxLength: 5 }
						}
					/>
				</Grid>
			</Grid>
			<Grid container direction="row" spacing={6}>
				<Grid item>
					<FormGroup row>
						<FormControlLabel
							control={
								<Switch
									checked={store._FORM_INFO_.removeCaptchaForLoggedUsers === '1'}
									onChange={e => store._FORM_INFO_.removeCaptchaForLoggedUsers = e.target.checked ? '1' : '0'}
								/>
							}
							label={KaliFormsObject.translations.formInfo.removeCaptcha}
						/>
					</FormGroup>
				</Grid>
				<Grid item>
					<FormGroup row>
						<FormControlLabel
							control={
								<Switch
									checked={store._FORM_INFO_.hideFormName === '1'}
									onChange={e => store._FORM_INFO_.hideFormName = e.target.checked ? '1' : '0'}
								/>
							}
							label={KaliFormsObject.translations.formInfo.hideFormName}
						/>
					</FormGroup>
				</Grid>
			</Grid>
			<Grid container direction="row" spacing={6}>
				<Grid item xs={12}>
					<TextField
						label={KaliFormsObject.translations.formInfo.globalErrorMessage}
						value={store._FORM_INFO_.globalErrorMessage}
						onChange={e => store._FORM_INFO_.globalErrorMessage = e.target.value}
						fullWidth={true}
						variant="filled"
						placeholder="Something went wrong..."
					/>
				</Grid>
			</Grid>

			<Grid container direction="row" spacing={6}>
				<Grid item>
					<Typography variant="h5">{KaliFormsObject.translations.formInfo.afterFormSubmit}</Typography>
				</Grid>
			</Grid>
			<Grid container direction="row" spacing={6}>
				<Grid item>
					<FormGroup row>
						<FormControlLabel
							control={
								<Switch
									checked={store._FORM_INFO_.showThankYouMessage === '1'}
									onChange={e => store._FORM_INFO_.showThankYouMessage = e.target.checked ? '1' : '0'}
								/>
							}
							label={KaliFormsObject.translations.formInfo.showThankYou}
						/>
					</FormGroup>
				</Grid>

				<Grid item>
					<FormGroup row>
						<FormControlLabel
							control={
								<Switch
									checked={store._FORM_INFO_.saveFormSubmissions === '1'}
									onChange={e => store._FORM_INFO_.saveFormSubmissions = e.target.checked ? '1' : '0'}
								/>
							}
							label={KaliFormsObject.translations.formInfo.saveFormSubmissions}
						/>
					</FormGroup>
				</Grid>
			</Grid>
			<If condition={saveFormSubmissionsInstalled()}>
				<Grid container direction="row" spacing={6}>
					<Grid item xs={12}>
						<TextField
							label={KaliFormsObject.translations.formInfo.submissionViewPage}
							value={store._FORM_INFO_.submissionViewPage}
							type="url"
							onChange={e => store._FORM_INFO_.submissionViewPage = e.target.value}
							fullWidth={true}
							variant="filled"
						/>
					</Grid>
				</Grid>
			</If>
			<Grid container direction="row" spacing={6}>
				<Grid item xs={12}>
					<TextField
						label={KaliFormsObject.translations.formInfo.thankYouMessage}
						value={store._FORM_INFO_.thankYouMessage}
						onChange={e => store._FORM_INFO_.thankYouMessage = e.target.value}
						// multiline={true}
						variant="filled"
						fullWidth={true}
						InputProps={{
							endAdornment: (
								<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
							),
						}}
						style={{ whiteSpace: 'pre' }}
					/>
				</Grid>
			</Grid>

			<Grid container direction="row" spacing={6}>
				<Grid item xs={12}>
					<TextField
						label={KaliFormsObject.translations.formInfo.redirectUrl}
						value={store._FORM_INFO_.redirectUrl}
						type="url"
						onChange={e => store._FORM_INFO_.redirectUrl = e.target.value}
						fullWidth={true}
						variant="filled"
						placeholder="www.google.com"
					/>
				</Grid>
			</Grid>

			<Grid container direction="row" spacing={6}>
				<Grid item>
					<Typography variant="h5">{KaliFormsObject.translations.formInfo.formClassAndId}</Typography>
				</Grid>
			</Grid>

			<Grid container direction="row" spacing={6}>
				<Grid item xs={6}>
					<TextField
						label={KaliFormsObject.translations.formInfo.cssId}
						value={store._FORM_INFO_.cssId}
						onChange={e => store._FORM_INFO_.cssId = e.target.value}
						fullWidth={true}
						variant="filled"
					/>
				</Grid>
				<Grid item xs={6}>
					<TextField
						label={KaliFormsObject.translations.formInfo.cssClass}
						value={store._FORM_INFO_.cssClass}
						onChange={e => store._FORM_INFO_.cssClass = e.target.value}
						fullWidth={true}
						variant="filled"
					/>
				</Grid>
			</Grid>
		</React.Fragment>
	);
})
export default FormInfo;
