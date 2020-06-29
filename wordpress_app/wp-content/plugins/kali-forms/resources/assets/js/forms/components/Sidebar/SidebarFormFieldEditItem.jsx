import Box from '@material-ui/core/Box';
import Button from '@material-ui/core/Button';
import Tab from '@material-ui/core/Tab';
import Tabs from '@material-ui/core/Tabs';
import { plainTabsStylesHook } from '@mui-treasury/styles/tabs';
import { observer } from "mobx-react-lite";
import moment from 'moment';
import React from 'react';
import { store } from "./../../store/store";
import SidebarFieldType from './SidebarFieldType';
import sidebarFormFieldEditStyles from './SidebarFormFieldEditItemStyles';
import ConditionalLogic from './../ConditionalLogic/ConditionalLogic'
moment.defaultFormat = 'DD-MM-YYYY'

const SidebarFormFieldEdit = observer((props) => {
	const tabsStyles = plainTabsStylesHook.useTabs();
	const tabItemStyles = plainTabsStylesHook.useTabItem();

	/**
	 * Change to array func
	 */
	const changeToArray = (obj) => {
		let properties = [];

		if (!store._FIELD_COMPONENTS_.fieldComponentProperties.hasOwnProperty(obj.id)) {
			return properties;
		}

		for (let sKey in store._FIELD_COMPONENTS_.fieldComponentProperties[obj.id]) {
			if (!obj.properties.hasOwnProperty(sKey)) {
				obj.properties[sKey] = store._FIELD_COMPONENTS_.fieldComponentProperties[obj.id][sKey].value
			}
		}

		for (const key in obj.properties) {
			properties.push({
				id: key,
				...store._FIELD_COMPONENTS_.fieldComponentProperties[obj.id][key],
				value: obj.properties[key],
			});
		}

		return properties;
	}

	const formatPropsInGroups = () => {
		let groups = {
			general: [],
			advanced: [],
			addable: []
		}

		let properties = changeToArray(store._FIELD_COMPONENTS_.getActiveFieldComponent(store._UI_.activeFormFieldInSidebar));

		if (!properties.length) {
			return false;
		}

		properties.map(el => {
			if (!el.hasOwnProperty('group')) {
				groups.general.push(el);
				return;
			}

			groups[el.group].push(el);
		})

		let returnArr = [];
		for (let key in groups) {
			if (!groups[key].length) {
				continue;
			}
			returnArr.push({
				id: key,
				fields: groups[key],
				label: KaliFormsObject.translations.fieldPropertiesGroup[key]
			})
		}

		if (typeof KaliFormsObject.conditionalLogic !== 'undefined') {
			if (
				!['hidden', 'pageBreak', 'grecaptcha'].includes(store._FIELD_COMPONENTS_.getActiveFieldComponent(store._UI_.activeFormFieldInSidebar).id)
			) {
				returnArr.push({
					id: 'conditional',
					label: KaliFormsObject.translations.fieldPropertiesGroup.conditional
				})
			}
		}

		return returnArr
	}

	const jumpToConditionalLogic = () => {
		store._UI_.setActiveFormSettingsItem('conditionalLogic')
		store._UI_.setAppBar('formSettings');
	}

	const classes = sidebarFormFieldEditStyles();
	const groups = formatPropsInGroups();

	/**
	 *
	 * @return {*}
	 */

	return (
		<React.Fragment>
			<Tabs
				className={classes.tabsRoot}
				classes={tabsStyles}
				value={store._UI_.activeFormFieldGroupTab || 'general'}
				onChange={(e, index) => store._UI_.setActiveFormFieldGroupTab(index)}
			>
				{groups.length && groups.map(group => <Tab value={group.id} key={group.id} className={classes.tabRoot} classes={tabItemStyles} label={group.label} />)}
			</Tabs>
			{groups.length && groups.map(group => (
				<Box key={group.id}
					className={classes.groupBox}
					style={{ display: group.id !== store._UI_.activeFormFieldGroupTab ? 'none' : 'inline-block' }}>
					<If condition={typeof group.fields !== 'undefined'}>
						{group.fields.map((field, idx) => <SidebarFieldType key={field.id + idx} field={field} />)}
					</If>
					<If condition={group.id === 'conditional'}>
						<If condition={typeof KaliFormsObject.conditionalLogic !== 'undefined'}>
							<Choose>
								<When condition={window.innerWidth > 1919}>
									<ConditionalLogic />
								</When>
								<Otherwise>
									<Button color="primary" onClick={() => jumpToConditionalLogic()}>
										{KaliFormsObject.translations.conditionalLogic.conditionalLogicSettings}
									</Button>
								</Otherwise>
							</Choose>
						</If>
					</If>
				</Box>
			))}

		</React.Fragment>
	)
})

export default SidebarFormFieldEdit;
