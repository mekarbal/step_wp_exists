import IconButton from '@material-ui/core/IconButton';
import TextField from '@material-ui/core/TextField';
import AddableListItemHandle from './AddableListItemHandle'
import Typography from '@material-ui/core/Typography';
import DeleteIcon from '@material-ui/icons/Delete';
import React, { useEffect, useState } from 'react';
import { sortableElement } from 'react-sortable-hoc';
import Grid from '@material-ui/core/Grid';
import Checkbox from '@material-ui/core/Checkbox';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import addableListItemStyles from './AddableListItemStyles';
import { store } from './../../store/store';
import { observer } from 'mobx-react-lite'
/**
 * Addable list item
 *
 * @class AddableListItem
 * @extends {React.Component}
 */
const AddableListItem = observer((props) => {
	const [element, setElement] = useState(props.element);
	const [idx, setIdx] = useState(props.idx);
	const [panelCollapsed, setPanelCollapsed] = useState(false);
	const classes = addableListItemStyles();
	useEffect(() => {
		setElement(props.element)
	}, [props.element])


	useEffect(() => {
		setIdx(props.idx)
	}, [props.idx])

	let currentVal = store._FIELD_COMPONENTS_.getPropertyValue(store._UI_.activeFormFieldInSidebar, 'default').split(',')
	currentVal = currentVal.filter(e => e !== '');

	return (
		<React.Fragment>
			<Grid container direction="row" spacing={2} className={classes.root}>
				<Grid item xs={1}>
					<AddableListItemHandle className={classes.handle} />
				</Grid>
				<Grid item xs={3}>
					<TextField
						className={classes.value}
						label={KaliFormsObject.translations.general.value}
						value={element.value}
						onChange={e => props.handleChange(e.target.value, 'value', idx)}
						fullWidth={true}
						margin="normal"
					/>
				</Grid>
				<Grid item xs={5}>
					<TextField
						className={classes.label}
						label={KaliFormsObject.translations.general.label}
						value={element.label}
						onChange={e => props.handleChange(e.target.value, 'label', idx)}
						fullWidth={true}
						margin="normal"

					/>
				</Grid>
				<Grid item xs={2}>
					<FormControlLabel
						value="top"
						className={classes.checkboxLabel}
						control={
							<Checkbox
								color="primary"
								checked={currentVal.includes(element.value)}
								onChange={e => props.handleCheckboxChange(e.target.checked, idx)}
							/>
						}
						label={KaliFormsObject.translations.general.checked}
						labelPlacement="top"
					/>
				</Grid>
				<Grid item xs={1}>
					<IconButton className={classes.delete} onClick={() => props.removeChoice(idx)}>
						<DeleteIcon />
					</IconButton>
				</Grid>
			</Grid>
		</React.Fragment>
	)
})

export default sortableElement(AddableListItem)
