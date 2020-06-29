import React from 'react';
import TextField from '@material-ui/core/TextField';
import MenuItem from '@material-ui/core/MenuItem';
import { observer } from "mobx-react-lite";
import { store } from "./../../store/store";

const FieldComponentSelect = (props) => {
	return (
		<TextField
			label={props.label}
			variant="filled"
			value={props.selectedValue}
			select
			onChange={e => props.onChange({ field: props.field, value: e.target.value })}
			fullWidth={true}>
			{store._FIELD_COMPONENTS_.fieldComponents.map(field => {
				if (
					(field.properties.name !== '')
					&& (field.id === 'checkbox'
						|| field.id === 'select'
						|| field.id === 'textbox'
						|| field.id === 'radio'
						|| field.id === 'hidden'
						|| field.id === 'dropdown'
						|| field.id === 'date'
						|| field.id === 'range'
						|| field.id === 'choices')
				) {

					let label = (typeof field.properties.caption !== 'undefined' && field.properties.caption !== '') ? field.properties.caption : field.properties.name
					return (
						<MenuItem
							key={field.internalId}
							value={field.properties.name}>
							{label}
						</MenuItem>
					)
				}
			})}
		</TextField>
	);
}

export default FieldComponentSelect
