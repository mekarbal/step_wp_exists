import React from 'react';
import ReactDOM from 'react-dom';
// if (process.env.NODE_ENV !== 'production') {
// 	const whyDidYouRender = require('@welldone-software/why-did-you-render');
// 	whyDidYouRender(React, {
// 		include: [/.App/],
// 		logOnDifferentValues: true,
// 	});
// }


import '@scss/main.scss';

import { MuiThemeProvider, createMuiTheme } from '@material-ui/core/styles';
import { red, green } from '@material-ui/core/colors';

const theme = createMuiTheme({
	palette: {
		primary: { main: '#3B88F7' },
		secondary: { main: '#8B8BF9' },
		// type: 'dark',
	},
	typography: {
		useNextVariants: true,
	},
	overrides: {
		MuiButton: {
			containedSecondary: {
				color: '#fff',
			}
		},
		MuiInputAdornment: {
			positionStart: {
				marginTop: '0 !important'
			}
		},
		MuiInputBase: {
			root: {
				// background: '#fff'
			},
			input: {
				border: 'none !important',
				boxShadow: 'none !important',
				background: 'initial !important'
			}
		},
		MuiIconButton: {
			edgeEnd: {
				bottom: 9
			}
		},
		MuiExpansionPanelSummary: {
			expandIcon: {
				bottom: 0
			}
		},
		MuiFilledInput: {
			root: {
				padding: '20px 13px 2px 13px',
			},
			// inputSelect: {
			// 	padding: '10px 27px 4px 0',
			// }
		},
		MuiSelect: {
			root: {
				padding: '10px 27px 4px 0',
			}
		},
		MuiTabs: {
			indicator: {
				background: '#fff'
			}
		},
		MuiTableCell: {
			footer: {
				borderBottom: 'none',
			}
		},
		MUIRichTextEditor: {
			root: {
				backgroundColor: "#ebebeb",
				borderRadius: 5,
			},
			container: {
				display: "flex",
				flexDirection: "column-reverse"
			},
			editor: {
				backgroundColor: "#ebebeb",
				padding: "0 20px",
			},
			toolbar: {
				borderTop: "1px solid gray",
				backgroundColor: "#ebebeb"
			},
			placeHolder: {
				backgroundColor: "#ebebeb",
				paddingLeft: 20,
				width: "inherit"
			}
		},
		MuiChip: {
			outlinedSecondary: {
				borderColor: red[500],
				color: red[500]
			}
		},
		MuiStepIcon: {
			completed: {
				color: green[500] + ' !important'
			}
		}
	}
});
import { SnackbarProvider } from 'notistack';
import App from './containers/App';
import supressNotices from '@/forms/utils/notices';
import PlaceholderDialog from '@/forms/components/PlaceholderDialog/PlaceholderDialog';
import CssBaseline from '@material-ui/core/CssBaseline';
KaliFormsObject.notices = supressNotices();

ReactDOM.render(
	<MuiThemeProvider theme={theme}>
		<CssBaseline />
		<SnackbarProvider>
			<App />
			<PlaceholderDialog />
		</SnackbarProvider>
	</MuiThemeProvider>,
	document.getElementById('kaliforms-container')
);
