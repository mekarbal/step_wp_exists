import React from 'react';
import Button from '@material-ui/core/Button'
import { sortableContainer } from 'react-sortable-hoc';
import AddIcon from '@material-ui/icons/Add';
/**
 * Addable list container
 *
 * @class AddableListContainer
 * @extends {React.Component}
 */
const AddableListContainer = (props) => {
	const containerStyles = {
		padding: '5px 0',
		display: 'flex',
		justifyContent: 'center',
		flexDirection: 'column',
	}

	return (
		<div style={containerStyles}>
			{props.children}

			<Button variant="contained" color="primary" style={{marginTop: 10}} onClick={() => props.addChoice()}>
				<AddIcon /> {KaliFormsObject.translations.general.addChoice}
			</Button>
		</div>
	);
}

export default sortableContainer(AddableListContainer)
