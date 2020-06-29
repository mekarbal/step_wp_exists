import { makeStyles } from '@material-ui/core/styles';

const SidebarFieldComponentItemStyles = makeStyles(theme => {
	return {
		proButtonHolder: {
			position: 'relative',
			top: 15,
			right: 7,
			maxHeight: 48,
			height: 48,
			display: 'inline-block',
		},
		proButton: {
			textAlign: 'center',
			borderRadius: 10,
			padding: '4px 8px',
			fontSize: '.7rem',
			fontWeight: 'bold',
			color: '#fff',
			background: theme.palette.secondary.main,
			// boxShadow: theme.shadows[2],

			'&:hover': {
				background: theme.palette.secondary.light,
				// borderColor: '#eee',
				// background: '#fafafa',
				// borderColor: theme.palette.primary.main,
				// transition: 'all .25 ease-in-out'
			}
		}
	}
});

export default SidebarFieldComponentItemStyles;
