import IconButton from '@material-ui/core/IconButton';
import { withTheme } from '@material-ui/core/styles';
import DeleteIcon from '@material-ui/icons/Delete';
import DuplicateIcon from '@material-ui/icons/FileCopy';
import { observer } from "mobx-react-lite";
import React from 'react';
import GridLayout from 'react-grid-layout';
import 'react-grid-layout/css/styles.css';
import { store } from "./../../store/store";
import BuilderFormField from './BuilderFormField';
import builderZoneStyles from './BuilderZoneStyles';
import { useSnackbar } from 'notistack';
import SnackBarAction from '@/forms/components/SnackBars/SnackBarAction';
/**
 * Should be reactive
 *
 * @returns
 * @memberof BuilderFieldDropZone
 */
const getContainerWidth = () => {
	let item = document.querySelector('.MuiContainer-fixed');
	return item === null ? 930 : item.offsetWidth - 30
}

/**
 * The actual Builder
 *
 * @param {*} props
 * @returns
 */
const BuilderZone = observer(props => {
	const { enqueueSnackbar } = useSnackbar();
	// State
	const classes = builderZoneStyles();

	/**
	 * Sets active form field in editor
	 *
	 * @param {*} idx
	 * @param {*} e
	 */
	const setFormField = (internalId, e) => {
		if (e.target.tagName.toLowerCase() !== 'div') {
			return;
		}
		let id = 0;
		let fieldType = '';
		store._FIELD_COMPONENTS_.fieldComponents.map((e, idx) => { if (e.internalId === internalId) { fieldType = e.id; id = idx; } })

		if (typeof KaliFormsObject.conditionalLogic === 'undefined' && store._FIELD_COMPONENTS_.isRestrictedField(fieldType)) {
			enqueueSnackbar(
				KaliFormsObject.translations.general.accessRestrictedField,
				{
					preventDuplicate: true,
					variant: 'error',
					action: (key) => <SnackBarAction snackKey={key} />
				}
			)
			return;
		}

		//QOL Improvement - check to see if the field does have the tab we are in - and dont change
		store._UI_.setActiveFormFieldGroupTab('general');
		store._UI_.setActiveTabInSidebar('fieldProperties');
		store._UI_.setActiveFormFieldInSidebar(id);
	}

	/**
	 * Retrieves item style
	 *
	 * @param {*} item
	 * @param {*} idx
	 */
	const getItemStyle = (item, idx) => {
		if (store._UI_.activeTabInSidebar !== 'fieldProperties') {
			return {};
		}

		let style = {};
		if (store._FIELD_COMPONENTS_.getInternalIdByIndex(store._UI_.activeFormFieldInSidebar).toLowerCase() === item.i.toLowerCase()) {
			style = { ...style, ...{ backgroundColor: '#fafafa' } };
		}

		if (typeof KaliFormsObject.conditionalLogic === 'undefined') {
			return style;
		}

		store._FORM_INFO_.conditionalLogic.map(condition => {
			if (typeof store._FIELD_COMPONENTS_.fieldComponents[store._UI_.activeFormFieldInSidebar] !== 'undefined'
				&& condition.field === item.i
				&& store._FIELD_COMPONENTS_.fieldComponents[store._UI_.activeFormFieldInSidebar].internalId === condition.conditioner) {
				style = { ...style, ...{ backgroundColor: 'rgba(162, 162, 250, .15)' } }
			}
		})

		return style;
	}
	const _duplicateField = field => {
		let duplicateField = {};
		store._FIELD_COMPONENTS_.fieldComponents.map(e => { if (e.internalId === field.i) { duplicateField = JSON.parse(JSON.stringify({ ...e })) } })

		duplicateField.internalId = duplicateField.id.toLowerCase() + store._FIELD_COMPONENTS_.lastIndex
		duplicateField.properties.id = duplicateField.internalId
		duplicateField.properties.name = duplicateField.internalId
		duplicateField.properties.caption = duplicateField.properties.caption + '(duplicate)'
		let duplicateFieldGrid = JSON.parse(JSON.stringify({ ...field }));
		duplicateFieldGrid.i = duplicateField.internalId;
		duplicateFieldGrid.y += 1;
		let insertHere = 0;
		let currentGrid = [...store._GRID_.grid];
		currentGrid.map((item, idx) => {
			if (item.y === field.y) {
				insertHere = idx;
			}

			if (item.y >= duplicateFieldGrid.y) {
				currentGrid[idx].y += 1;
			}
		})
		currentGrid.splice(insertHere, 0, duplicateFieldGrid)
		store._FIELD_COMPONENTS_.addFieldComponent({ ...duplicateField })
		store._GRID_.setGrid([...currentGrid])
	}
	/**
	 * Duplicates a field
	 *
	 * @param {*} field
	 */
	const duplicateField = field => {
		store._CONFIRMATION_DIALOG_.setTitle(KaliFormsObject.translations.alerts.duplicateFieldTitle);
		store._CONFIRMATION_DIALOG_.setMessage(KaliFormsObject.translations.alerts.duplcateFieldMessage);
		store._CONFIRMATION_DIALOG_.setAction(_duplicateField)
		store._CONFIRMATION_DIALOG_.setActionProps(field)
		store._CONFIRMATION_DIALOG_.setState(true);
	}
	/**
	 * Gets the last index
	 */
	const getLastIndex = () => {
		return store._FIELD_COMPONENTS_.lastIndex;
	}

	/**
	 * Removes a field
	 * @param {*} field
	 * @param {*} idx
	 */
	const removeField = field => {
		store._CONFIRMATION_DIALOG_.setTitle(KaliFormsObject.translations.alerts.removeFieldTitle);
		store._CONFIRMATION_DIALOG_.setMessage(KaliFormsObject.translations.alerts.removeFieldMessage);
		store._CONFIRMATION_DIALOG_.setAction(_removeField)
		store._CONFIRMATION_DIALOG_.setActionProps(field)
		store._CONFIRMATION_DIALOG_.setState(true);
	}

	const _removeField = field => {
		store._UI_.setActiveTabInSidebar('formFields');
		store._UI_.setActiveFormFieldInSidebar(0);
		store._GRID_.removeGridItem(field.i);

		// are we a "dependency" in conditionals?
		let conditions = store._FORM_INFO_.getFieldConditionersByInternalId(field.i);
		conditions.map(condition => store._FORM_INFO_.removeConditionByAssertion(condition));

		store._FIELD_COMPONENTS_.removeFieldComponent(field.i)
	}

	const layoutChange = layout => {
		store._GRID_.setGrid(layout);
	}

	return (
		<div id="kali-responsive-grid-layout" style={{ minHeight: 380, position: 'relative', padding: '15px' }}>
			<GridLayout
				className="layout"
				useCSSTransforms={false}
				width={getContainerWidth()}
				rowHeight={95}
				draggableHandle='.KaliFormsBuilderDragHandle'
				cols={12}
				onLayoutChange={layout => layoutChange(layout)}>
				{
					store._GRID_.getGrid.map((item, idx) => {
						let active =
							store._UI_.activeTabInSidebar === 'fieldProperties'
								&& store._FIELD_COMPONENTS_.getInternalIdByIndex(store._UI_.activeFormFieldInSidebar).toLowerCase() === item.i.toLowerCase() ? 'active' : '';
						return (
							<div
								data-grid={item}
								key={item.i}
								style={getItemStyle(item, idx)}
								className={
									classes.gridItem + ' ' + active
								}
								onClick={(e) => setFormField(item.i, e)}>

								<BuilderFormField field={item.i} />
								<div className={classes.actionButtons}>
									<IconButton className={classes.icon} onClick={() => duplicateField(item)} size="small" aria-label={KaliFormsObject.translations.general.duplicate}>
										<DuplicateIcon />
									</IconButton>
									<IconButton className={classes.icon} onClick={() => removeField(item, idx)} size="small" aria-label={KaliFormsObject.translations.general.delete}>
										<DeleteIcon />
									</IconButton>
								</div>
							</div>
						);
					})}
			</GridLayout>
		</div >
	);
})

export default withTheme(BuilderZone);
