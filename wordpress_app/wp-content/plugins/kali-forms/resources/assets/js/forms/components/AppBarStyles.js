import { makeStyles } from '@material-ui/core/styles';
const appBarStyles = makeStyles(theme => {
	// const backgroundColorDefault =
	// 	theme.palette.type === 'light' ? theme.palette.grey[100] : theme.palette.grey[900];
	return {
		appBar: {
			zIndex: theme.zIndex.drawer + 1,
		},
		formNameInput: {
			marginRight: 50,
			flexGrow: 1,
			display: 'flex',
			'& > .MuiInputBase-root': {
				color: theme.palette.getContrastText(theme.palette.primary.main),
				background: theme.palette.primary.main,
				fontSize: 24,
				zIndex: 1,
				'&:before': {
					content: 'none'
				},
				'&:after': {
					content: 'none'
				}
			}
		},
		inputAdornment: {
			background: theme.palette.grey[900],
			height: '42px',
			borderRadius: '50%',
			width: '42px',
			alignItems: 'center',
			alignContent: 'center',
			justifyContent: 'center',
			marginRight: '15px',
		},
		logo: {
			maxWidth: '42px',
			marginRight: '15px',
		}
	}
})


export default appBarStyles
