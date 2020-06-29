import MomentUtils from '@date-io/moment';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormGroup from '@material-ui/core/FormGroup';
import FormLabel from '@material-ui/core/InputLabel';
import MenuItem from '@material-ui/core/MenuItem';
import Switch from '@material-ui/core/Switch';
import TextField from '@material-ui/core/TextField';
import { DatePicker, MuiPickersUtilsProvider, TimePicker } from '@material-ui/pickers';
import { observer } from "mobx-react-lite";
import moment from 'moment';
import React from 'react';
import AddableList from '../AddableList/AddableList';
import AddableProducts from '../AddableProducts/AddableProducts';
import { store } from "./../../store/store";
moment.defaultFormat = 'DD-MM-YYYY'
/**
 * Renders a field in the template
 * @param key
 */
const SidebarFieldType = observer((props) => {
	const translateCalendarValue = (value) => {
		return value !== '' ? moment(value, 'DD-MM-YYYY').toDate() : null
	}

	const translateTimePickerValue = value => {
		return value !== '' ? moment(value, 'HH:mm').toDate() : null
	}

	switch (props.field.type) {
		case 'textbox':
			return (
				<TextField
					label={props.field.label}
					value={store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id)}
					onChange={e => store._FIELD_COMPONENTS_.updatePropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id, e.target.value)}
					fullWidth={true}
					error={props.field.error}
					placeholder={props.field.label}
					margin="normal"
				/>
			);
		case 'textarea':
			return (
				<TextField
					label={props.field.label}
					value={store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id)}
					onChange={e => store._FIELD_COMPONENTS_.updatePropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id, e.target.value)}
					multiline={true}
					rows={2}
					fullWidth={true}
					error={props.field.error}
					margin="normal"
				/>
			);
		case 'select':
			return (
				<TextField
					label={props.field.label}
					value={store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id)}
					onChange={e => store._FIELD_COMPONENTS_.updatePropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id, e.target.value)}
					select
					fullWidth={true}
					error={props.field.error}
					margin="normal"
				>
					<Choose>
						<When condition={props.field.choices.hasOwnProperty('length')}>
							{props.field.choices.map((e, indx) => (
								<Choose>
									<When condition={e.hasOwnProperty('value') && e.hasOwnProperty('label')}>
										<MenuItem key={e.value + indx} value={e.value}>
											{e.label}
										</MenuItem>
									</When>
									<Otherwise>
										<MenuItem key={e + indx} value={e}>
											{e}
										</MenuItem>
									</Otherwise>
								</Choose>
							))}
						</When>
						<Otherwise>
							{
								Object.keys(props.field.choices).map((e, index) =>
									(
										<MenuItem key={e + index} value={e}>
											{props.field.choices[e]}
										</MenuItem>
									)
								)
							}
						</Otherwise>
					</Choose>
				</TextField>
			);
		case 'number':
			return (
				<TextField
					label={props.field.label}
					value={store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id)}
					onChange={e => store._FIELD_COMPONENTS_.updatePropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id, e.target.value)}
					type="number"
					fullWidth={true}
					error={props.field.error}
					InputLabelProps={{
						shrink: true,
					}}
					margin="normal"
				/>
			);
		case 'toggle':
			return (
				<FormGroup row>
					<FormControlLabel
						control={
							<Switch
								value={store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id) || false}
								onChange={e => store._FIELD_COMPONENTS_.updatePropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id, e.target.checked)}
								checked={store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id) || false}
								value="1"
							/>
						}
						label={props.field.label}
					/>
				</FormGroup>
			);
		case 'addableList':
			return (
				<div>
					<FormLabel>{props.field.label}</FormLabel>
					<AddableList
						key={store._UI_.activeFormFieldInSidebar}
						onChange={e => store._FIELD_COMPONENTS_.updatePropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id, [...e])}
						choices={store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id)}
					/>
				</div>
			);
		case 'addableProducts':
			return (
				<div>
					<FormLabel>{props.field.label}</FormLabel>
					<AddableProducts
						key={JSON.stringify(store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id))}
						onChange={e => store._FIELD_COMPONENTS_.updatePropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id, [...e])}
						choices={store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id) || []}
					/>
				</div>
			);
			break;
		case 'timePicker':
			return (
				<div>
					<MuiPickersUtilsProvider utils={MomentUtils}>
						<TimePicker
							value={translateTimePickerValue(store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id))}
							label={props.field.label}
							fullWidth={true}
							clearable={true}
							showTodayButton={true}
							onChange={e => store._FIELD_COMPONENTS_.updatePropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id, e.format('HH:mm'))}
							mask={[/\d/, /\d/, ':', /\d/, /\d/, ' ', /a|p/i, 'M']}
						/>
					</MuiPickersUtilsProvider>
				</div>
			);
		case 'calendar':
			return (
				<div>
					<MuiPickersUtilsProvider utils={MomentUtils}>
						<DatePicker
							label={props.field.label}
							value={translateCalendarValue(store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id))}
							clearable={true}
							margin="normal"
							fullWidth={true}
							format="DD-MM-YYYY"
							mask={[/\d/, /\d/, '-', /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/]}
							onChange={e => store._FIELD_COMPONENTS_.updatePropertyValue(store._UI_.activeFormFieldInSidebar, props.field.id, e.format())}
						/>
					</MuiPickersUtilsProvider>
				</div>
			);
		default:
			break;
	}
});

export default SidebarFieldType
