import { makeStyles } from '@material-ui/core/styles';
const builderZoneStyles = makeStyles(theme => {
	return {
		itemLoading: {
			position: 'absolute',
			top: 0,
			left: 0,
			right: 0,
			bottom: 0,
			background: 'rgba(255, 255, 255, .5)',
			zIndex: 1000,
			paddingTop: 21,
		},
		gridItem: {
			textAlign: 'center',
			display: 'flex',
			alignItems: 'center',
			justifyContent: 'center',
			borderRadius: theme.shape.borderRadius,
			border: '1px solid transparent',
			// boxShadow: theme.shadows[2],
			background: theme.palette.background.paper,
			'& > div >.KaliFormsBuilderDragHandle': {
				opacity: 0,
			},
			'&:before': {
				content: '""',
				display: 'block',
				background: 'transparent',
				position: 'absolute',
				width: 2,
				height: 92,
				transition: 'all .25 ease-in-out',
				left: 0,
				top: 0
			},

			'&:hover': {
				background: '#fafafa',
				// borderColor: theme.palette.primary.main,
				transition: 'all .25 ease-in-out',
				'&:before': {
					background: theme.palette.text.secondary,
					transition: 'all .25 ease-in-out',
				}
			},
			'&:hover > div:last-of-type': {
				transition: 'all .25 ease-in-out',
				opacity: 1,
			},
			'&:hover > .react-resizable-handle': {
				transition: 'all .25 ease-in-out',
				opacity: 1
			},
			'&:hover .KaliFormsBuilderDragHandle': {
				transition: 'all .25 ease-in-out',
				opacity: 1
			},
			'&.active': {
				'&> .react-resizable-handle': {
					transition: 'all .25 ease-in-out',
					opacity: 1
				},
				'& div:last-of-type': {
					transition: 'all .25 ease-in-out',
					opacity: 1,
				},
				'&:before': {
					background: theme.palette.text.secondary,
					transition: 'all .25 ease-in-out',
				},
				'& > div >.KaliFormsBuilderDragHandle': {
					opacity: 1
				}
			},
		},
		icon: {
			// color: theme.palette.primary.main
		},
		gridHelperParent: {
			position: 'absolute',
			top: 20,
			left: 5,
			right: 5,
			bottom: 10,
			display: 'flex',
			pointerEvents: 'none',
		},
		gridHelperColumn: {
			flexGrow: '1',
			paddingRight: 10,
			paddingLeft: 10,
			pointerEvents: 'none',
		},
		gridHelperSpan: {
			background: 'rgba(0,0,0,.025)',
			width: '100%',
			height: '100%',
			display: 'inline-block',
			pointerEvents: 'none',
		},
		actionButtons: {
			display: 'flex',
			opacity: 0,
			flexDirection: 'row',
			position: 'absolute',
			top: 2,
			right: 10,
			zIndex: 100,
		},
		placeholder: { display: 'flex', alignItems: 'center', justifyContent: 'center', flexDirection: 'column', minHeight: 390 }
	}
});

export default builderZoneStyles
