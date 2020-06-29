import HubSpotLogo from '@img/hubspot.svg';
import Badge from '@material-ui/core/Badge';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import { makeStyles, withStyles, withTheme } from '@material-ui/core/styles';
import CodeIcon from '@material-ui/icons/Code';
import SettingsIcon from '@material-ui/icons/Settings';
import TransformIcon from '@material-ui/icons/Transform';
import StyleIcon from '@material-ui/icons/StyleOutlined';
import VpnKeyIcon from '@material-ui/icons/VpnKey';
import { observer } from "mobx-react-lite";
import React from 'react';
import { store } from "./../../store/store";

const StyledBadge = withStyles(theme => ({
	badge: {
		right: -10,
		color: '#fff',
	},
}))(Badge);


const useStyles = makeStyles(theme => {
	return {
		root: {
			background: theme.palette.background.default,
			padding: 0,
			position: 'relative',
			height: '100%',
			minHeight: 'calc(100vh - 52px)',
		}
	}
});

const FormSettingsSidebar = observer((props) => {
	const classes = useStyles();

	const redirectToPricing = event => {
		window.open('https://www.kaliforms.com/?utm_source=formSettings&utm_campaign=userInterests&utm_medium=proBadge', '_blank');
	}

	return (
		<List>
			<ListItem
				button
				selected={store._UI_.activeFormSettingsItem === 'general'}
				onClick={event => store._UI_.setActiveFormSettingsItem('general')}
			>
				<ListItemIcon>
					<SettingsIcon />
				</ListItemIcon>
				<ListItemText primary={KaliFormsObject.translations.sidebar.general} />
			</ListItem>
			<ListItem
				button
				selected={store._UI_.activeFormSettingsItem === 'styling'}
				onClick={event => store._UI_.setActiveFormSettingsItem('styling')}
			>
				<ListItemIcon>
					<StyleIcon />
				</ListItemIcon>
				<ListItemText primary={KaliFormsObject.translations.sidebar.formStyling} />
			</ListItem>
			<ListItem
				button
				selected={store._UI_.activeFormSettingsItem === 'integrations'}
				onClick={event => store._UI_.setActiveFormSettingsItem('integrations')}
			>
				<ListItemIcon>
					<VpnKeyIcon />
				</ListItemIcon>
				<ListItemText primary={KaliFormsObject.translations.sidebar.integrations} />
			</ListItem>

			<If condition={typeof KaliFormsObject.conditionalLogic !== 'undefined'}>
				<ListItem
					button
					selected={store._UI_.activeFormSettingsItem === 'conditionalLogic'}
					onClick={event => store._UI_.setActiveFormSettingsItem('conditionalLogic')}
				>
					<ListItemIcon>
						<TransformIcon />
					</ListItemIcon>
					<ListItemText primary={KaliFormsObject.translations.conditionalLogic.conditionalLogic} />
				</ListItem>
				<ListItem
					button
					selected={store._UI_.activeFormSettingsItem === 'formCustomCss'}
					onClick={event => store._UI_.setActiveFormSettingsItem('formCustomCss')}
				>
					<ListItemIcon>
						<CodeIcon />
					</ListItemIcon>
					<ListItemText primary={KaliFormsObject.translations.customScripting.customCss} />
				</ListItem>
			</If>

			<If condition={typeof KaliFormsObject.conditionalLogic === 'undefined'}>
				<ListItem
					button
					selected={store._UI_.activeFormSettingsItem === 'conditionalLogic'}
					onClick={event => redirectToPricing()}
				>
					<ListItemIcon>
						<TransformIcon />
					</ListItemIcon>
					<StyledBadge badgeContent={'Pro'} color="secondary">
						<ListItemText primary={KaliFormsObject.translations.conditionalLogic.conditionalLogic} />
					</StyledBadge>
				</ListItem>
				<ListItem
					button
					selected={store._UI_.activeFormSettingsItem === 'formCustomCss'}
					onClick={event => redirectToPricing()}
				>
					<ListItemIcon>
						<CodeIcon />
					</ListItemIcon>
					<StyledBadge badgeContent={'Pro'} color="secondary">
						<ListItemText primary={KaliFormsObject.translations.customScripting.customCss} />
					</StyledBadge>
				</ListItem>
			</If>

			<If condition={typeof KaliFormsObject.conditionalLogic !== 'undefined'}>
				<ListItem
					button
					selected={store._UI_.activeFormSettingsItem === 'formCustomJs'}
					onClick={event => store._UI_.setActiveFormSettingsItem('formCustomJs')}
				>
					<ListItemIcon>
						<CodeIcon />
					</ListItemIcon>
					<ListItemText primary={KaliFormsObject.translations.customScripting.customJs} />
				</ListItem>
				<ListItem
					button
					selected={store._UI_.activeFormSettingsItem === 'formCustomPhp'}
					onClick={event => store._UI_.setActiveFormSettingsItem('formCustomPhp')}
				>
					<ListItemIcon>
						<CodeIcon />
					</ListItemIcon>
					<ListItemText primary={KaliFormsObject.translations.customScripting.customPhp} />
				</ListItem>
			</If>
			<If condition={typeof KaliFormsObject.conditionalLogic === 'undefined'}>
				<ListItem
					button
					selected={store._UI_.activeFormSettingsItem === 'formCustomJs'}
					onClick={event => redirectToPricing()}
				>
					<ListItemIcon>
						<CodeIcon />
					</ListItemIcon>
					<StyledBadge badgeContent={'Pro'} color="secondary">
						<ListItemText primary={KaliFormsObject.translations.customScripting.customJs} />
					</StyledBadge>
				</ListItem>
				<ListItem
					button
					selected={store._UI_.activeFormSettingsItem === 'formCustomPhp'}
					onClick={event => redirectToPricing()}
				>
					<ListItemIcon>
						<CodeIcon />
					</ListItemIcon>
					<StyledBadge badgeContent={'Pro'} color="secondary">
						<ListItemText primary={KaliFormsObject.translations.customScripting.customPhp} />
					</StyledBadge>
				</ListItem>
			</If>
			<If condition={typeof KaliFormsObject.hubspotInstalled !== 'undefined'}>
				<ListItem
					button
					selected={store._UI_.activeFormSettingsItem === 'hubspotIntegration'}
					onClick={event => store._UI_.setActiveFormSettingsItem('hubspotIntegration')}>
					<ListItemIcon>
						<img src={HubSpotLogo} style={{ width: 35 }} />
					</ListItemIcon>
					<ListItemText primary="HubSpot" />
				</ListItem>
			</If>
		</List>

	);
})

export default withTheme((FormSettingsSidebar));
