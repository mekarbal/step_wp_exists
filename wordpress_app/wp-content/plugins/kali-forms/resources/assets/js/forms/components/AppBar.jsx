import AppNavigationBar from '@material-ui/core/AppBar';
import Box from '@material-ui/core/Box';
import IconButton from '@material-ui/core/IconButton';
import Tab from '@material-ui/core/Tab';
import Tabs from '@material-ui/core/Tabs';
import TextField from '@material-ui/core/TextField';
import Toolbar from '@material-ui/core/Toolbar';
import Tooltip from '@material-ui/core/Tooltip';
import CloseIcon from '@material-ui/icons/Close';
import SaveIcon from '@material-ui/icons/Save';
import { observer } from "mobx-react-lite";
import React from 'react';
import LogoSvg from './../../../img/icon.svg';
import { clear, store } from './../store/store';
import appBarStyles from './AppBarStyles';

const AppBar = observer(props => {
	const classes = appBarStyles();

	/**
	 * Handle click
	 */
	const handleClick = (event, name) => {
		let action = name.toLowerCase();
		switch (action) {
			case 'delete':
				document.querySelector('#delete-action a').click();
				break;
			case 'save':
				document.getElementById('publish').click();
				break;
			case 'add-new':
				document.querySelector('.page-title-action').click();
				break;
			case 'back-to-wp':
				// When user clicks to close the form, we dont need to remember where he left off so lets clear the storage
				clear();
				window.location.href = KaliFormsObject.exit_url
				break;
			default:
				break;
		}
	};

	/**
	 * Tab toggler
	 * @param tab
	 */
	/**
	 * Changes the form name
	 */
	const changeFormName = (event) => {
		let val = event.target.value;
		document.querySelector('#title').value = val
		store._FORM_INFO_.formName = val;
	}

	return (
		<AppNavigationBar position="fixed" className={classes.appBar} color="primary" elevation={0} id="kali-appbar">
			<Toolbar>
				<img src={LogoSvg} className={classes.logo} />
				<TextField
					value={store._FORM_INFO_.formName || ''}
					onChange={e => changeFormName(e)}
					className={classes.formNameInput}
					placeholder={KaliFormsObject.translations.appBar.formName}
				/>
				<Tabs value={store._UI_.appBar} onChange={(e, tab) => store._UI_.setAppBar(tab)}>
					<Tab value="formBuilder" label={KaliFormsObject.translations.appBar.formBuilder} />
					<Tab value="emailBuilder" label={KaliFormsObject.translations.appBar.notifications} />
					<Tab value="formSettings" label={KaliFormsObject.translations.appBar.formSettings} />
				</Tabs>
				<Box style={{ marginLeft: 15 }}>
					<Tooltip title={KaliFormsObject.translations.general.save}>
						<IconButton
							onClick={(e) => handleClick(e, 'save')}
							color="inherit"
						>
							<SaveIcon />
						</IconButton>
					</Tooltip>
					<Tooltip title={KaliFormsObject.translations.appBar.backToWp}>
						<IconButton
							onClick={(e) => handleClick(e, 'back-to-wp')}
							color="inherit"
						>
							<CloseIcon />
						</IconButton>
					</Tooltip>
				</Box>
			</Toolbar>
		</AppNavigationBar>
	)
})
export default AppBar;

