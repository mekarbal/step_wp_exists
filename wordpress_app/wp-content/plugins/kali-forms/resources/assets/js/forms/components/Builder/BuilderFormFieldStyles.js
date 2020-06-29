import { makeStyles } from '@material-ui/core/styles';
const builderFormFieldStyles = makeStyles(theme => {
	return {
		container: {
			width: '100%',
			display: 'inline-block',
			height: '100%',
			padding: theme.spacing(2),
			cursor: 'pointer',
			position: 'relative',
			textAlign: 'left',
			'& > .button': {
				pointerEvents: 'none'
			}
		},
		moveButton: {
			cursor: 'grab',
			position: 'absolute',
			top: 30,
			left: -25,
			color: theme.palette.text.secondary,
		},
		label: {
			pointerEvents: 'none',
		},
		labelCheckbox: {
			marginRight: '15px',
		},
		select: {
			width: '100%',
			padding: theme.spacing(1),
			pointerEvents: 'none',
		},
		input: {
			width: '100%',
			padding: theme.spacing(1),
			pointerEvents: 'none',
		},
		inputHidden: {
			width: '100%',
			padding: theme.spacing(1),
			pointerEvents: 'none',
			opacity: .3,
		},
		textarea: {
			width: '100%',
			height: 50,
			lineHeight: '16px !important',
			boxShadow: 'none',
			resizable: false,
			pointerEvents: 'none',
		},
		checkbox: {
			marginRight: '10px'
		},
		divider: {
			width: '100%',
			position: 'relative',
			display: 'block',
			top: 23,
			'& span': {
				position: 'absolute',
				left: 'calc(50% - 70px)',
				top: -11,
				display: 'inline-block',
				width: '70px',
				textAlign: 'center',
				background: theme.palette.background.paper,
				zIndex: 100,
			}
		},
		fileUpload: {
			textAlign: 'center',
			borderRadius: '5px',
			background: '#fafafa',
			pointerEvents: 'none',
			display: 'block',
			padding: theme.spacing(3)
		},
		grecaptcha: {
			textAlign: 'center',
			display: 'inline-block',
			width: '100%',
			pointerEvents: 'none',
			'& > img': {
				width: '310px'
			}
		},
		pageBreak: {
			display: 'flex',
			alignItems: 'center',
			width: '100%',
			'& > div': {
				flexGrow: '1',
				textAlign: 'center',
				'&:first-of-type': {
					textAlign: 'left',
					marginLeft: '10%',
				},
				'&:last-of-type': {
					textAlign: 'right',
					marginRight: '10%',
				},
				'& > button': {
					pointerEvents: 'none',
				}
			}
		},
		paypal: {
			borderRadius: '5px',
			backgroundColor: '#ffc439',
			display: 'flex',
			alignItems: 'center',
			alignContent: 'center',
			pointerEvents: 'none',
			justifyContent: 'center'
		},
		code: {
			whiteSpace: 'pre',
			display: 'flex',
			maxHeight: 70,
			padding: theme.spacing(2),
			marginRight: 60,
			overflowY: 'scroll',
			pointerEvents: 'none',
		}
	}
});

export default builderFormFieldStyles
