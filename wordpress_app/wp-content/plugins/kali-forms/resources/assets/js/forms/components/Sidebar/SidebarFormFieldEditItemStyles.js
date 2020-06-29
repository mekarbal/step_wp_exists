import { makeStyles } from '@material-ui/core/styles';
const sidebarFormFieldEditItemStyles = makeStyles(theme => {
	return {
		tabsRoot: {
			// borderLeft: '1px solid #e9e9e9',
			// borderRight: '1px solid #e9e9e9',
		},
		tabRoot: {
			minWidth: 120
		},
		groupBox: {
			padding: theme.spacing(3),
			border: '1px solid #e9e9e9',
			width: '100%',
			position: 'relative',
			top: -1
		},
	}
});
export default sidebarFormFieldEditItemStyles
