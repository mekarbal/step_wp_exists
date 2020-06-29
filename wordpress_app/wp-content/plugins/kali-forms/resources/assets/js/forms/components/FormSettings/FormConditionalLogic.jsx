import Chip from '@material-ui/core/Chip';
import Grid from '@material-ui/core/Grid';
import Menu from '@material-ui/core/Menu';
import MenuItem from '@material-ui/core/MenuItem';
import PlusIcon from '@material-ui/icons/Add';
import { observer } from "mobx-react-lite";
import React, { useState } from 'react';
import { store } from "./../../store/store";
import Typography from '@material-ui/core/Typography';
const FormConditionalLogic = observer((props) => {
	const labels = {
		states: {
			hide: KaliFormsObject.translations.conditionalLogic.hide,
			show: KaliFormsObject.translations.conditionalLogic.show,
		},
		operator: {
			equal: KaliFormsObject.translations.conditionalLogic.equalTo,
			different: KaliFormsObject.translations.conditionalLogic.differentThan,
			or: KaliFormsObject.translations.conditionalLogic.canBe
		},
	};

	const [currentField, setCurrentField] = useState(null)
	const [action, setAction] = useState(null)
	const [conditionalValue, setConditionalValue] = useState(null);
	const [conditionedByField, setConditionedByField] = useState(null);
	const [operator, setOperator] = useState(null);

	const [errors, setErrors] = useState([])

	const [anchorElCurrent, setAnchorElCurrent] = useState(null);
	const [anchorElState, setAnchorElState] = useState(null);
	const [anchorElConditioner, setAnchorElConditioner] = useState(null);
	const [anchorElOperator, setAnchorElOperator] = useState(null);
	const [anchorElValue, setAnchorElValue] = useState(null);

	const openCurrent = Boolean(anchorElCurrent)
	const openState = Boolean(anchorElState);
	const openConditioner = Boolean(anchorElConditioner);
	const openOperator = Boolean(anchorElOperator);
	const openValue = Boolean(anchorElValue)

	const isError = (key) => {
		if (errors.length === 0) {
			return false;
		}

		return errors.indexOf(key) !== -1;
	}

	const handleClick = (event, opener) => {
		switch (opener) {
			case 'current':
				setAnchorElCurrent(event.currentTarget);
				break
			case 'state':
				setAnchorElState(event.currentTarget);
				break;
			case 'conditioner':
				setAnchorElConditioner(event.currentTarget);
				break;
			case 'operator':
				setAnchorElOperator(event.currentTarget)
				break;
			case 'value':
				setAnchorElValue(event.currentTarget)
				break;
		}

	};

	const handleClose = (action, value) => {
		let currentErrors = [];
		switch (action) {
			case 'current':
				setCurrentField(value);
				setAnchorElCurrent(null);
				currentErrors = errors.filter(e => e !== 'current');
				setErrors([...currentErrors])
				break;
			case 'state':
				setAction(value);
				setAnchorElState(null);
				currentErrors = errors.filter(e => e !== 'state');
				setErrors([...currentErrors])
				break;
			case 'conditioner':
				setConditionedByField(value)
				setAnchorElConditioner(null)
				currentErrors = errors.filter(e => e !== 'conditioner');
				setErrors([...currentErrors])
				break;
			case 'operator':
				setOperator(value);
				setAnchorElOperator(null)
				currentErrors = errors.filter(e => e !== 'operator');
				setErrors([...currentErrors])
				break;
			case 'value':
				setConditionalValue(value);
				setAnchorElValue(null)
				currentErrors = errors.filter(e => e !== 'value');
				setErrors([...currentErrors])
				break;
		}
	};

	const addCondition = () => {
		let errors = [];
		currentField === null ? errors.push('current') : false;
		action === null ? errors.push('state') : false;
		conditionedByField === null ? errors.push('conditioner') : false;
		operator === null ? errors.push('operator') : false;
		conditionalValue === null ? errors.push('value') : false;

		if (errors.length) {
			setErrors(errors);
			return;
		}
		setErrors([]);
		let newCondition = {
			field: currentField,
			state: action,
			conditioner: conditionedByField,
			operator: operator,
			value: conditionalValue,
		}

		store._FORM_INFO_.addConditional(newCondition);
	}

	const composeLabel = (condition) => {
		let field = store._FIELD_COMPONENTS_.getFieldByInternalId(condition.field);
		let caption = typeof field.properties.caption !== 'undefined' && field.properties.caption !== '' ? field.properties.caption : field.properties.id

		return `<span style="text-decoration:underline">${caption}</span> ${KaliFormsObject.translations.conditionalLogic.should} ${labels.states[condition.state]} ${KaliFormsObject.translations.conditionalLogic.if} ${condition.conditioner} ${KaliFormsObject.translations.conditionalLogic.is} ${labels.operator[condition.operator]} ${condition.value}`;
	}

	return (
		<React.Fragment>
			<Grid container direction="row" spacing={2}>
				<Grid item>
					<Typography variant="h5">{KaliFormsObject.translations.conditionalLogic.conditionalLogic}</Typography>
				</Grid>
			</Grid>
			<Grid container direction="row" spacing={2} style={{ marginBottom: 10 }} alignItems="center">
				<Grid item>
					<Chip
						aria-controls="CURRENT-menu"
						variant="outlined"
						size="small"
						clickable onClick={e => handleClick(e, 'current')}
						color={isError('state') ? 'secondary' : 'default'}
						label={
							currentField === null
								? KaliFormsObject.translations.conditionalLogic.currentField
								: store._FIELD_COMPONENTS_.simplifiedFields[currentField].caption
						}
					/>
					<Menu
						id="current-menu"
						anchorEl={anchorElCurrent}
						keepMounted
						open={openCurrent}
						onClose={e => handleClose('current', null)}
						PaperProps={{
							style: {
								maxHeight: 48 * 4.5,
								width: 200,
							},
						}}
					>
						{
							Object.keys(store._FIELD_COMPONENTS_.simplifiedFields).map((key, index) => (
								<MenuItem key={index + key} onClick={e => handleClose('current', key)}>
									{store._FIELD_COMPONENTS_.simplifiedFields[key].caption}
								</MenuItem>
							))
						}
					</Menu>
				</Grid>
				<Grid item>
					<Chip
						aria-controls="state-menu"
						variant="outlined"
						size="small"
						clickable onClick={e => handleClick(e, 'state')}
						color={isError('state') ? 'secondary' : 'default'}
						label={
							action === null
								? KaliFormsObject.translations.conditionalLogic.state
								: labels.states[action]
						}
					/>
					<Menu
						id="state-menu"
						anchorEl={anchorElState}
						keepMounted
						open={openState}
						onClose={e => handleClose('state', null)}
						PaperProps={{
							style: {
								maxHeight: 48 * 4.5,
								width: 200,
							},
						}}
					>
						<MenuItem onClick={e => handleClose('state', 'show')}>
							{KaliFormsObject.translations.conditionalLogic.show}
						</MenuItem>
						<MenuItem onClick={e => handleClose('state', 'hide')}>
							{KaliFormsObject.translations.conditionalLogic.hide}
						</MenuItem>
					</Menu>
				</Grid>
				<Grid item>
					<Chip
						aria-controls="conditioner"
						variant="outlined"
						size="small"
						clickable onClick={e => handleClick(e, 'conditioner')}
						color={isError('conditioner') ? 'secondary' : 'default'}
						label={
							conditionedByField === null
								? KaliFormsObject.translations.conditionalLogic.ifThisField
								: store._FIELD_COMPONENTS_.fieldConditioners[conditionedByField].caption
						} />
					<Menu
						id="conditioner-menu"
						anchorEl={anchorElConditioner}
						keepMounted
						open={openConditioner}
						onClose={e => handleClose('conditioner', null)}
						PaperProps={{
							style: {
								maxHeight: 48 * 4.5,
								width: 200,
							},
						}}
					>
						{
							Object.keys(store._FIELD_COMPONENTS_.fieldConditioners).map((key, index) => (
								<MenuItem key={index + key} onClick={e => handleClose('conditioner', key)}>
									{store._FIELD_COMPONENTS_.fieldConditioners[key].caption}
								</MenuItem>
							))
						}
					</Menu>
				</Grid>
				<Grid item>
					<Chip
						variant="outlined"
						size="small"
						clickable onClick={e => handleClick(e, 'operator')}
						color={isError('operator') ? 'secondary' : 'default'}
						label={operator === null
							? KaliFormsObject.translations.conditionalLogic.operator
							: labels.operator[operator]
						} />
					<Menu
						id="operator-menu"
						anchorEl={anchorElOperator}
						keepMounted
						open={openOperator}
						onClose={e => handleClose('operator', null)}
					>
						<MenuItem onClick={e => handleClose('operator', 'equal')}>
							{KaliFormsObject.translations.conditionalLogic.equalTo}
						</MenuItem>
						<MenuItem onClick={e => handleClose('operator', 'different')}>
							{KaliFormsObject.translations.conditionalLogic.differentThan}
						</MenuItem>
						<MenuItem onClick={e => handleClose('operator', 'or')}>
							{KaliFormsObject.translations.conditionalLogic.canBe}
						</MenuItem>
					</Menu>
				</Grid>
				<Grid item>
					<Chip
						variant="outlined"
						size="small"
						clickable onClick={e => handleClick(e, 'value')}
						label={conditionalValue === null
							? KaliFormsObject.translations.conditionalLogic.value
							: conditionalValue
						}
					/>
					<Menu
						id="value-menu"
						anchorEl={anchorElValue}
						keepMounted
						open={openValue}
						onClose={e => handleClose('value', null)}
						color={isError('value') ? 'secondary' : 'default'}
					>
						{
							typeof store._FIELD_COMPONENTS_.fieldConditioners[conditionedByField] !== 'undefined'
							&& store._FIELD_COMPONENTS_.fieldConditioners[conditionedByField].values.map((e, index) => (
								<MenuItem key={index + e.value} onClick={el => handleClose('value', e.value)}>
									{e.label}
								</MenuItem>
							))
						}
					</Menu>
				</Grid>
				<Grid item>
					<Chip variant="outlined" size="small" clickable onClick={addCondition} label={KaliFormsObject.translations.conditionalLogic.add} icon={<PlusIcon />} />
				</Grid>
			</Grid>
			<Grid container direction="row" spacing={2} alignItems="center">
				{
					store._FORM_INFO_.conditionalLogic.map((condition, idx) => {
						return (
							<Grid item xs={12} key={condition.conditioner + condition.value + idx}>
								<Chip
									color="primary"
									label={
										<span dangerouslySetInnerHTML={{ __html: composeLabel(condition) }}></span>
									}
									onDelete={e => store._FORM_INFO_.removeConditionByAssertion(condition)}
									variant="outlined"
								/>
							</Grid>
						)
					})}
			</Grid>
		</React.Fragment>
	);
})
export default FormConditionalLogic;
