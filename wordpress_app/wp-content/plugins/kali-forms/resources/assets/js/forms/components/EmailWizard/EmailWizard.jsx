import React, { useState, useEffect } from 'react';
import Stepper from '@material-ui/core/Stepper';
import Step from '@material-ui/core/Step';
import StepLabel from '@material-ui/core/StepLabel';
import StepContent from '@material-ui/core/StepContent';
import Typography from '@material-ui/core/Typography';
import Button from '@material-ui/core/Button';
import TextField from '@material-ui/core/TextField'
import PlaceholderDialogOpener from './../PlaceholderDialog/PlaceholderDialogOpener'
import Grid from '@material-ui/core/Grid'
import MUIRichTextEditor from 'mui-rte'
import Dialog from '@material-ui/core/Dialog';
import DialogContent from '@material-ui/core/DialogContent';
import { observer } from "mobx-react-lite";
import { store } from "./../../store/store";
import emailWizardStyles from './EmailWizardStyles'
import { convertToRaw } from 'draft-js'
import draftToHtml from 'draftjs-to-html'

/**
 * Email wizard components
 *
 * @param {*} props
 */
const EmailWizard = observer((props) => {
	const classes = emailWizardStyles();
	const [activeStep, setActiveStep] = useState(0);
	const [emailSubject, setEmailSubject] = useState('');
	const [fromEmail, setFromEmail] = useState('');
	const [fromName, setFromName] = useState('');
	const [toEmail, setToEmail] = useState('');
	const [emailBody, setEmailBody] = useState('');
	const [emailBodyToSave, setEmailBodyToSave] = useState('')
	const [errors, setErrors] = useState([]);
	const setEmailBodyToString = (val) => {
		debouncedSaveToStore(val);
	}

	const saveToStore = (value) => {
		let currentContent = value.getCurrentContent();
		let state = draftToHtml(convertToRaw(currentContent));
		setEmailBodyToSave(state);
	}
	const debouncedSaveToStore = _.debounce(saveToStore, 200);

	/**
	 * Handles the next button
	 */
	const handleNext = () => {
		let currentErrors = [...errors];
		switch (activeStep) {
			case 0:
				if (emailSubject === '') {
					currentErrors.push('emailSubject');
				}
				break;
			case 1:
				if (fromEmail === '') {
					currentErrors.push('fromEmail')
				}
				if (fromName === '') {
					currentErrors.push('fromName');
				}
				break;
			case 2:
				if (toEmail === '') {
					currentErrors.push('toEmail')
				}
				break;
		}
		setErrors(currentErrors);
		let errorMap = {
			0: ['emailSubject'],
			1: ['fromEmail', 'fromName'],
			2: ['toEmail']
		}

		let currentStepHasError = false;
		errorMap[activeStep].map(e => {
			if (currentStepHasError) {
				return;
			}

			currentStepHasError = currentErrors.includes(e);
		})

		currentStepHasError ? false : setActiveStep(prevActiveStep => prevActiveStep + 1);
	};

	useEffect(() => {
		let currentErrors = [...errors];

		if (currentErrors.includes('emailSubject') && emailSubject !== '') {
			currentErrors = currentErrors.filter(e => e !== 'emailSubject')
		}
		if (currentErrors.includes('fromEmail') && fromEmail !== '') {
			currentErrors = currentErrors.filter(e => e !== 'fromEmail')
		}
		if (currentErrors.includes('fromName') && fromName !== '') {
			currentErrors = currentErrors.filter(e => e !== 'fromName')
		}
		if (currentErrors.includes('toEmail') && toEmail !== '') {
			currentErrors = currentErrors.filter(e => e !== 'toEmail')
		}
		if (currentErrors.includes('emailBody') && emailBody !== '') {
			currentErrors = currentErrors.filter(e => e !== 'emailBody')
		}

		setErrors([...currentErrors]);
	}, [emailSubject, fromEmail, fromName, toEmail, emailBody])

	/**
	 * Handle the back button
	 */
	const handleBack = () => {
		let currentErrors = [...errors];
		switch (activeStep) {
			case 1:
				currentErrors = currentErrors.filter(e => e !== 'fromName' || e !== 'fromEmail')
				break;
			case 2:
				currentErrors = currentErrors.filter(e => e !== 'toEmail')
				break;
			case 3:
				currentErrors = currentErrors.filter(e => e !== 'emailBody')
				break;
		}
		setErrors(currentErrors);
		setActiveStep(prevActiveStep => prevActiveStep - 1);
	};
	/**
	 * Handles closing
	 */
	const handleClose = () => {
		store._EMAILS_.emailWizardVisibility = false;
	};
	/**
	 * Handle step wizard finish
	 */
	const handleFinish = () => {
		store._EMAILS_.addEmail({
			fromName: fromName,
			fromEmail: fromEmail,
			toEmail: toEmail,
			replyTo: '',
			ccEmail: '',
			bccEmail: '',
			emailSubject: emailSubject,
			emailAttachmentFilePaths: '',
			emailAttachment: '',
			emailAttachmentMediaIds: '',
			emailBody: emailBodyToSave
		})
		store._UI_.setActiveEmailInSidebar(false)
		/**
		 * Close the dialog
		 */
		store._EMAILS_.emailWizardVisibility = false;
		store._UI_.setActiveEmailInSidebar(store._EMAILS_.emails.length - 1)
	};

	/**
	 * When dialog exists, we need to reset the wizard
	 */
	const onExit = () => {
		setActiveStep(0);
		setFromEmail('');
		setToEmail('');
		setEmailSubject('');
		setFromName('');
		setEmailBody('');
		setEmailBodyToSave('');
		setErrors([]);
		store._EMAILS_.emailWizardVisibility = false;
	}

	return (
		<Dialog
			open={store._EMAILS_.emailWizardVisibility}
			aria-labelledby="alert-dialog-title"
			aria-describedby="alert-dialog-description"
			fullWidth={true}
			onClose={handleClose}
			onExited={onExit}
			maxWidth="md"
		>
			<DialogContent>
				<Stepper activeStep={activeStep} orientation="vertical">
					<Step>
						<If condition={activeStep === 0}>
							<StepLabel>
								{KaliFormsObject.translations.emailWizard.stepOne}
							</StepLabel>
						</If>
						<If condition={activeStep > 0}>
							<StepLabel>
								{KaliFormsObject.translations.emailWizard.stepOneCompleted}
								<br />
								<small>{emailSubject}</small>
							</StepLabel>
						</If>
						<StepContent>
							<Typography>
								<span dangerouslySetInnerHTML={{ __html: KaliFormsObject.translations.emailWizard.stepOneContent }}></span>
							</Typography>
							<Grid container direction="row" spacing={8}>
								<Grid item xs={6}>
									<TextField type="text"
										label={KaliFormsObject.translations.formEmails.subject}
										id="emailSubject"
										value={emailSubject}
										placeholder={KaliFormsObject.translations.formEmails.subjectPlaceholder}
										fullWidth={true}
										error={errors.includes('emailSubject')}
										variant="filled"
										InputProps={{
											endAdornment: (
												<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
											),
										}}
										onChange={(e) => setEmailSubject(e.target.value)}
									/>

								</Grid>
							</Grid>
							<div className={classes.actionsContainer}>
								<div>
									<Button
										variant="contained"
										color="primary"
										onClick={handleNext}
										className={classes.button}
									>
										{KaliFormsObject.translations.general.next}
									</Button>
								</div>
							</div>
						</StepContent>
					</Step>
					<Step>
						<If condition={activeStep <= 1}>
							<StepLabel>
								{KaliFormsObject.translations.emailWizard.stepTwo}
							</StepLabel>
						</If>
						<If condition={activeStep > 1}>
							<StepLabel>
								{KaliFormsObject.translations.emailWizard.stepTwoCompleted}
								<br />
								<small>{fromName} - {fromEmail}</small>
							</StepLabel>
						</If>
						<StepContent>
							<Typography>
								<span dangerouslySetInnerHTML={{ __html: KaliFormsObject.translations.emailWizard.stepTwoContent }}></span>
							</Typography>
							<Grid container direction="row" spacing={8}>
								<Grid item xs={6}>
									<TextField type="text"
										id="fromName"
										label={KaliFormsObject.translations.formEmails.fromName}
										value={fromName}
										placeholder="John Doe..."
										fullWidth={true}
										variant="filled"
										error={errors.includes('fromName')}
										InputProps={{
											endAdornment: (
												<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
											),
										}}
										onChange={(e) => setFromName(e.target.value)}
									/>
								</Grid>
								<Grid item xs={6}>
									<TextField type="text"
										label={KaliFormsObject.translations.formEmails.fromEmail}
										id="fromEmail"
										value={fromEmail}
										placeholder="johndoe@wordpress.site"
										error={errors.includes('fromEmail')}
										fullWidth={true}
										variant="filled"
										InputProps={{
											endAdornment: (
												<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
											),
										}}
										onChange={(e) => setFromEmail(e.target.value)}
									/>
								</Grid>
							</Grid>
							<div className={classes.actionsContainer}>
								<div>
									<Button
										onClick={handleBack}
										className={classes.button}
										variant="contained"
										color="secondary"
									>
										{KaliFormsObject.translations.general.back}
									</Button>
									<Button
										variant="contained"
										color="primary"
										onClick={handleNext}
										className={classes.button}
									>
										{KaliFormsObject.translations.general.next}
									</Button>
								</div>
							</div>
						</StepContent>
					</Step>
					<Step>
						<If condition={activeStep <= 2}>
							<StepLabel>
								{KaliFormsObject.translations.emailWizard.stepThree}
							</StepLabel>
						</If>
						<If condition={activeStep > 2}>
							<StepLabel>
								{KaliFormsObject.translations.emailWizard.stepThreeCompleted}
								<br />
								<small>{toEmail}</small>
							</StepLabel>
						</If>
						<StepContent>
							<Typography>
								<span dangerouslySetInnerHTML={{ __html: KaliFormsObject.translations.emailWizard.stepThreeContent }}></span>
							</Typography>
							<Grid container direction="row" spacing={8}>
								<Grid item xs={6}>
									<TextField type="text"
										label={KaliFormsObject.translations.formEmails.toEmail}
										id="toEmail"
										value={toEmail}
										placeholder="janedoe@wordpress.site"
										fullWidth={true}
										variant="filled"
										error={errors.includes('toEmail')}
										InputProps={{
											endAdornment: (
												<PlaceholderDialogOpener adornment={true}></PlaceholderDialogOpener>
											),
										}}
										onChange={(e) => setToEmail(e.target.value)} />
								</Grid>
							</Grid>
							<div className={classes.actionsContainer}>
								<div>
									<Button
										onClick={handleBack}
										className={classes.button}
										variant="contained"
										color="secondary"
									>
										{KaliFormsObject.translations.general.back}
									</Button>
									<Button
										variant="contained"
										color="primary"
										onClick={handleNext}
										className={classes.button}
									>
										{KaliFormsObject.translations.general.next}
									</Button>
								</div>
							</div>
						</StepContent>
					</Step>
					<Step>
						<StepLabel>
							{KaliFormsObject.translations.emailWizard.stepFour}
						</StepLabel>
						<StepContent>
							<Typography>
								<span dangerouslySetInnerHTML={{ __html: KaliFormsObject.translations.emailWizard.stepFourContent }}></span>
							</Typography>
							<Grid container direction="row" spacing={8}>
								<Grid item xs={10}>
									<MUIRichTextEditor
										label={KaliFormsObject.translations.formEmails.emailBody}
										value={emailBody}
										error={errors.includes('emailBody')}
										controls={["title", "bold", "italic", "underline", "strikethrough", "highlight", "undo", "redo", "link", "numberList", "bulletList", "quote", "code"]}
										onChange={e => setEmailBodyToString(e)}
									/>
								</Grid>
							</Grid>
							<div className={classes.actionsContainer}>
								<div>
									<Button
										onClick={handleBack}
										className={classes.button}
										variant="contained"
										color="secondary"
									>
										{KaliFormsObject.translations.general.back}
									</Button>
									<Button
										variant="contained"
										color="primary"
										onClick={handleFinish}
										className={classes.button}
									>
										{KaliFormsObject.translations.general.finish}
									</Button>
								</div>
							</div>
						</StepContent>
					</Step>
				</Stepper >
			</DialogContent>
		</Dialog>
	);
})

export default EmailWizard;
