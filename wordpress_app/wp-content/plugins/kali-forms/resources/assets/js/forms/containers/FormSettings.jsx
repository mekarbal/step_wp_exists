import React from 'react';
import FormInfo from './../components/FormSettings/FormInfo';
import FormIntegrations from './../components/FormSettings/FormIntegrations';
import FormConditionalLogic from './../components/FormSettings/FormConditionalLogic';
import FormCustomPhp from './../components/FormSettings/FormCustomPhp';
import FormCustomCss from './../components/FormSettings/FormCustomCss';
import FormCustomJs from './../components/FormSettings/FormCustomJs';
import FormStyling from './../components/FormSettings/FormStyling';
import HubSpotIntegration from './../components/FormSettings/HubSpotIntegration';
import Paper from '@material-ui/core/Paper';
import { observer } from "mobx-react-lite";
import { store } from "./../store/store";
import formSettingsStyles from './FormSettingsStyles'

const FormSettings = observer((props) => {
	const classes = formSettingsStyles(props);

	return (
		<Paper className={classes.paper}>
			<If condition={store._UI_.activeFormSettingsItem === 'general'}>
				<FormInfo />
			</If>
			<If condition={store._UI_.activeFormSettingsItem === 'integrations'}>
				<FormIntegrations />
			</If>
			<If condition={store._UI_.activeFormSettingsItem === 'styling'}>
				<FormStyling />
			</If>

			<If condition={typeof KaliFormsObject.hubspotInstalled !== 'undefined' && store._UI_.activeFormSettingsItem === 'hubspotIntegration'}>
				<HubSpotIntegration />
			</If>
			<If condition={typeof KaliFormsObject.conditionalLogic !== 'undefined' && store._UI_.activeFormSettingsItem === 'conditionalLogic'}>
				<FormConditionalLogic />
			</If>
			<If condition={typeof Kali !== 'undefined' && Kali.hasOwnProperty('components') && typeof Kali.components.CodeEditor === 'function'}>
				<If condition={store._UI_.activeFormSettingsItem === 'formCustomCss'}>
					<FormCustomCss />
				</If>
				<If condition={store._UI_.activeFormSettingsItem === 'formCustomJs'}>
					<FormCustomJs />
				</If>
				<If condition={store._UI_.activeFormSettingsItem === 'formCustomPhp'}>
					<FormCustomPhp />
				</If>
			</If>
		</Paper>
	);
})

export default FormSettings;
