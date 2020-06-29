import { makeStyles } from '@material-ui/core/styles'
const addableListItemStyles = makeStyles(theme => {
	return {
		root: {
			position: 'relative'
		},
		value: {

		},
		label: {

		},
		handle: {
			position: 'relative',
			top: 25,
			left: -10,
		},
		delete: {
			position: 'relative',
			top: 25,
		},
		checkboxLabel: {
			fontWeight: 400,
			transform: 'scale(0.75)',
			color: 'rgba(0, 0, 0, 0.54)',
			position: 'relative',
			top: 10,
		}
	}
})

export default addableListItemStyles;
