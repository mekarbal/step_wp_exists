import Badge from '@material-ui/core/Badge';
import Button from '@material-ui/core/Button';
import Grid from '@material-ui/core/Grid';
import Paper from '@material-ui/core/Paper';
import Typography from '@material-ui/core/Typography';
import axios from 'axios';
import Qs from 'qs';
import React, { useState } from 'react';
import { observer } from "mobx-react-lite";
import { store } from "./../store/store";
import { withStyles, makeStyles } from '@material-ui/core/styles';
import Card from '@material-ui/core/Card';
import CardHeader from '@material-ui/core/CardHeader';
import CardActions from '@material-ui/core/CardActions';
import CardContent from '@material-ui/core/CardContent';
import Container from '@material-ui/core/Container';
import CircularProgress from '@material-ui/core/CircularProgress';
import FormLabel from '@material-ui/core/FormLabel';
import FormControl from '@material-ui/core/FormControl';
import FormGroup from '@material-ui/core/FormGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormHelperText from '@material-ui/core/FormHelperText';
import Checkbox from '@material-ui/core/Checkbox';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import ArrowBackIcon from '@material-ui/icons/ArrowBack';
import IconButton from '@material-ui/core/IconButton';
const templateSelectorStyles = makeStyles(theme => {
	return {
		button: {
			margin: theme.spacing(),
			color: '#fff'
		},
		paper: {
			marginTop: theme.spacing(2),
			padding: theme.spacing(3),
		},
		cardTitle: {
			minHeight: 55,
		},
		cardBody: {
			minHeight: 75,
		},
		importLoader: {
			display: 'block',
			width: '100%',
			textAlign: 'center',
			padding: theme.spacing(3),
		},
		formControl: {
			margin: theme.spacing(2),
		},
		radio: {
			marginBottom: theme.spacing(2),
			minWidth: 240,
		},
		styleThumb: {
			maxWidth: 240,
			display: 'block',
			margin: '0 auto'
		},
		styleCaption: {
			display: 'block',
			textAlign: 'center',
		},
		radioContainer: {
			marginTop: theme.spacing(2)
		}
	}
});

const StyledBadge = withStyles(theme => ({
	badge: {
		right: 5,
		color: '#fff',
	},
}))(Badge);


const TemplateSelector = observer((props) => {
	const [selectedCard, setSelectedCard] = useState(false);
	const [predefinedForms] = useState(KaliFormsObject.predefinedForms);
	const [selectedCardKey, setSelectedCardKey] = useState(null);
	const [dataLoaded, setDataLoaded] = useState(false);
	const [data, setData] = useState(null);
	const [dataToImport, setDataToImport] = useState([]);
	const [styleToApply, setStyleToApply] = useState('theme')
	const handleImportData = (key, value) => {
		let currentState = [...dataToImport];
		if (value && !currentState.includes(key)) {
			currentState.push(key);
		}

		if (!value && currentState.includes(key)) {
			currentState = currentState.filter(e => e !== key);
		}

		setDataToImport([...currentState]);
	}

	/**
	 * Redirect to pro
	 */
	const redirectToPro = () => {
		window.open('https://www.kaliforms.com/pricing?utm_source=formBuilder&utm_campaign=userInterests&utm_medium=proBadge', '_blank');
	}

	/**
	 * Form selection
	 *
	 * @param {*} key
	 * @memberof TemplateSelector
	 */
	const selectForm = (key) => {
		setSelectedCard(true);
		setSelectedCardKey(key);
		setDataLoaded(false);
		const data = { action: 'kaliforms_get_form_data', args: { id: key, nonce: KaliFormsObject.ajax_nonce } };

		axios.post(KaliFormsObject.ajaxurl, Qs.stringify(data))
			.then(r => {
				setDataLoaded(true);
				setDataToImport(['emails', 'conditionalLogic', 'layout', 'settings']);
				setData(r.data);
			})
			.catch(e => {
				console.log(e);
			});
	}

	const goBackToCards = () => {
		setDataLoaded(false);
		setDataToImport([]);
		setData(null);
		setSelectedCard(false);
		setSelectedCardKey(null);
	}

	/**
	 * Import data
	 *
	 * @param {*} data
	 * @memberof TemplateSelector
	 */
	const importData = () => {
		dataToImport.map(e => {
			if (e === 'layout') {
				store._GRID_.setGrid(data.grid);
				store._FIELD_COMPONENTS_.addMultipleComponents(data.field_components);
			}

			if (e === 'emails' && data.hasOwnProperty('emails')) {
				store._EMAILS_.setEmails(data.emails);
			}

			if (e === 'settings') {
				document.querySelector('#title').value = data.name;
				store._FORM_INFO_.formName = data.name
				store._FORM_INFO_.setFormInfo(data.form_info);
			}

			if (e === 'conditionalLogic' && data.hasOwnProperty('conditional_logic') && data.conditional_logic !== null) {
				store._FORM_INFO_.setConditionalLogic(data.conditional_logic)
			}
		})

		store._FORM_STYLES_.setSelectedStyle(styleToApply);
		store._UI_.setTemplateSelecting(false);
	}

	const classes = templateSelectorStyles(props);

	return (
		<React.Fragment>
			<Container className={classes.paper}>
				<Grid container direction="row" spacing={2}>
					<Grid item>
						<Typography variant="h5">{KaliFormsObject.translations.templateSelector.title}</Typography>
					</Grid>
				</Grid>
				<Grid container direction="row" spacing={2}>
					<If condition={selectedCard}>
						<Grid item xs={12}>
							<Card variant="outlined">
								<If condition={!selectedCard || selectedCardKey === null || !dataLoaded || data === null}>
									<div className={classes.importLoader}>
										<CircularProgress />
									</div>
								</If>
								<If condition={selectedCard && selectedCardKey !== null && dataLoaded && data !== null}>
									<CardContent>
										<CardHeader
											action={
												<IconButton aria-label="settings" onClick={() => goBackToCards()}>
													<ArrowBackIcon />
												</IconButton>
											}
											title={data.name}
											subheader={predefinedForms[selectedCardKey].description}
										/>

										{/* <hr /> */}
										<FormControl component="fieldset" className={classes.formControl}>
											<FormLabel component="legend">
												{KaliFormsObject.translations.templateSelector.import}
											</FormLabel>
											<FormGroup row>
												<FormControlLabel
													control={<Checkbox checked={dataToImport.includes('layout')} onChange={(e) => handleImportData('layout', e.target.checked)} value="layout" />}
													label={KaliFormsObject.translations.templateSelector.layout}
												/>
												<FormControlLabel
													control={<Checkbox checked={dataToImport.includes('emails')} onChange={(e) => handleImportData('emails', e.target.checked)} value="emails" />}
													label={KaliFormsObject.translations.templateSelector.emails}
												/>
												<FormControlLabel
													control={<Checkbox checked={dataToImport.includes('settings')} onChange={(e) => handleImportData('settings', e.target.checked)} value="settings" />}
													label={KaliFormsObject.translations.templateSelector.settings}
												/>
												<FormControlLabel
													control={<Checkbox checked={dataToImport.includes('conditionalLogic')} onChange={(e) => handleImportData('conditionalLogic', e.target.checked)} value="conditionalLogic" />}
													label={KaliFormsObject.translations.templateSelector.conditionalLogic}
												/>
											</FormGroup>
										</FormControl>
										<hr />
										<FormControl component="fieldset" className={classes.formControl}>
											<FormLabel component="legend">
												{KaliFormsObject.translations.templateSelector.style}
											</FormLabel>
											<RadioGroup value={styleToApply} row className={classes.radioContainer}>
												{store._FORM_STYLES_.styles.map(e => (
													<FormControlLabel key={e.id}
														control={
															<Radio color="primary" onChange={() => setStyleToApply(e.id)} value={e.id} />
														}
														className={classes.radio}
														labelPlacement="top"
														label={
															<React.Fragment>
																<img className={classes.styleThumb} src={e.thumb} />
																<small className={classes.styleCaption}>{e.label}</small>
															</React.Fragment>
														}
													/>

												))}
											</RadioGroup>
										</FormControl>
									</CardContent>
									<CardActions>
										<Button size="small" variant="contained" color="primary" className={classes.button} onClick={() => importData()}>
											{KaliFormsObject.translations.general.import}
										</Button>
									</CardActions>
								</If>
							</Card>
						</Grid>
					</If>
					<If condition={!selectedCard}>
						<Grid item xs={3}>
							<Card variant="outlined">
								<CardContent>
									<Typography color="textSecondary" className={classes.cardTitle} gutterBottom>
										{KaliFormsObject.translations.templateSelector.blank}
									</Typography>
									<Typography variant="body2" component="p" className={classes.cardBody}>
										{KaliFormsObject.translations.templateSelector.blankDescription}
									</Typography>
								</CardContent>
								<CardActions>
									<Button size="small" variant="contained" color="primary" className={classes.button} onClick={() => store._UI_.setTemplateSelecting(false)}>
										{KaliFormsObject.translations.general.import}
									</Button>
								</CardActions>
							</Card>
						</Grid>
						{
							Object.keys(predefinedForms).map((key, index) => (
								<Grid item xs={3} key={key + index}>
									<Card variant="outlined">
										<CardContent>
											<Typography color="textSecondary" className={classes.cardTitle} gutterBottom>
												{predefinedForms[key].name}
											</Typography>
											<Typography variant="body2" component="p" className={classes.cardBody}>
												{predefinedForms[key].description}
											</Typography>
										</CardContent>
										<CardActions>
											<If condition={predefinedForms[key].pro}>
												<Button size="small" variant="contained" color="secondary" className={classes.button} onClick={() => redirectToPro()}>
													{KaliFormsObject.translations.general.upgradeToPro}
												</Button>
											</If>
											<If condition={!predefinedForms[key].pro}>
												<Button size="small" variant="contained" color="primary" className={classes.button} onClick={() => selectForm(key)}>
													{KaliFormsObject.translations.general.import}
												</Button>
											</If>
										</CardActions>
									</Card>
								</Grid>
							))
						}
					</If>
				</Grid>
			</Container>
		</React.Fragment>
	)
})

export default TemplateSelector
