import { makeStyles } from '@material-ui/core/styles';
import { store } from "./../store/store";

const appStyles = makeStyles(theme => {
	return {
		root: { display: 'flex' },
		toolbar: theme.mixins.toolbar,
		appBarSpacer: theme.mixins.toolbar,
		content: {
			flexGrow: 1,
			height: '100vh',
			overflow: 'auto',
			background: theme.palette.background.default
		},
		container: {
			position: 'relative',
		},
		drawerProgress: {
			position: 'absolute',
			left: props => {
				return store._UI_.appBar === 'formBuilder'
					? 300
					: 140;
			},
			top: '50%',
			zIndex: 100,
		},
		drawer: {
			width: props => {
				return store._UI_.templateSelecting
					? 0
					: store._UI_.appBar === 'formBuilder'
						? 600
						: 320;
			},
			flexShrink: 0,
			transition: theme.transitions.create(['width', 'opacity'], {
				easing: theme.transitions.easing.sharp,
				duration: theme.transitions.duration.leavingScreen,
			}),
			pointerEvents: props => {
				// let loading = props.ui.hasOwnProperty('drawerLoading') ? props.ui.drawerLoading : false;
				// return loading ? 'none' : 'initial';
			}
		},
		drawerPaper: {
			paddingLeft: props => {
				return store._UI_.templateSelecting
					? 0
					: store._UI_.appBar === 'formBuilder' ? theme.spacing(4) : 0
			},
			paddingRight: props => {
				return store._UI_.templateSelecting
					? 0
					: store._UI_.appBar === 'formBuilder' ? theme.spacing(4) : 0
			},
			width: props => {
				return store._UI_.templateSelecting
					? 0
					: store._UI_.appBar === 'formBuilder'
						? 600
						: 320;
			},
			transition: theme.transitions.create(['width', 'opacity'], {
				easing: theme.transitions.easing.sharp,
				duration: theme.transitions.duration.leavingScreen,
			}),
		},
		drawerLoader: {
			display: 'block',
			position: 'fixed',
			left: 0,
			top: 0,
			bottom: 0,
			background: '#fff',
			zIndex: theme.zIndex.drawer + 1,
			transition: theme.transitions.create(['width', 'opacity'], {
				easing: theme.transitions.easing.sharp,
				duration: theme.transitions.duration.leavingScreen,
			}),
			width: props => {
				return store._UI_.appBar === 'formBuilder'
					? 600
					: 320;
			},
			...theme.mixins.toolbar
		}
	}
});

export default appStyles;
