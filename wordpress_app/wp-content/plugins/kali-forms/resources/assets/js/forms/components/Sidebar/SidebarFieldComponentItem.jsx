import React from 'react';
import Badge from '@material-ui/core/Badge';
import Card from '@material-ui/core/Card';
import CardHeader from '@material-ui/core/CardHeader';
import IconButton from '@material-ui/core/IconButton';
import Button from '@material-ui/core/Button';
import AddIcon from '@material-ui/icons/Add';
import SidebarFieldComponentItemStyles from './SidebarFieldComponentItemStyles';
import { observer } from "mobx-react-lite";
import { store } from "./../../store/store";
/**
 * Returns the last grid item
 */
const getDefaultGrid = field => {
	let gridItem = { x: 0, y: Infinity, w: 12, h: 1, maxH: 1, minW: 3, moved: false, static: false, i: field.internalId }
	gridItem.minW = (field.constraint === 'none' || typeof field.constraint === 'undefined')
		? 3
		: parseFloat(field.constraint);
	gridItem.minW = gridItem.minW === 0 ? 3 : gridItem.minW;
	gridItem.w = gridItem.minW > gridItem.w ? gridItem.minW : gridItem.w;

	return gridItem;
}

const SidebarFieldComponentItem = observer((props) => {
	const classes = SidebarFieldComponentItemStyles();
	/**
	 * Add a field in the builder
	 * SHOULD BE PARSED/STRINGIFY SO YOU FORGET OBJECT REFS
	 */
	const addField = () => {
		props.id === 'collection' ? _addFields() : _addField();

	}
	const _addFields = () => {
		let fields = [];
		let grid = [];
		let start = store._FIELD_COMPONENTS_.lastIndex;
		let rows = {};
		props.properties.fields.map((obj, idx) => {
			obj.field.properties.id.value = obj.field.properties.id.value + (start + idx)
			let fieldToBePushed = {
				id: obj.field.id,
				label: obj.field.label,
				properties: formatObj(obj.field),
				constraint: obj.field.constraint,
				internalId: obj.field.id.toLowerCase() + (start + idx)
			}

			for (let key in obj.values) {
				if (fieldToBePushed.properties.hasOwnProperty(key)) {
					fieldToBePushed.properties[key] = obj.values[key]
				}
			}

			fields.push(JSON.parse(JSON.stringify(fieldToBePushed)));

			rows[fieldToBePushed.internalId] = { w: parseFloat(obj.grid.w), y: parseFloat(obj.grid.row) };
			let defaultGrid = getDefaultGrid(fieldToBePushed);
			defaultGrid.w = rows[fieldToBePushed.internalId].w
			defaultGrid.y = rows[fieldToBePushed.internalId].y + store._GRID_.lastY + 1
			grid.push(JSON.parse(JSON.stringify(defaultGrid)));
		});

		//@todo there is a bug here where Y is not "respected"
		store._FIELD_COMPONENTS_.addMultipleComponents(fields);
		store._GRID_.addMultipleGridItems(grid);
	}
	const _addField = () => {
		props.properties.id.value = props.properties.id.value + store._FIELD_COMPONENTS_.lastIndex
		let field = {
			id: props.id,
			label: props.label,
			properties: formatObj(props),
			constraint: props.constraint,
			internalId: props.id.toLowerCase() + store._FIELD_COMPONENTS_.lastIndex,
		}
		store._FIELD_COMPONENTS_.addFieldComponent(field)
		store._GRID_.addGridItem(getDefaultGrid(field))
	}
	/**
	 * Format object
	 *
	 * @param {*} obj
	 * @returns
	 * @memberof SidebarFieldComponentItem
	 */
	const formatObj = (obj) => {
		let properties = {};
		for (const key in obj.properties) {
			properties[key] = obj.properties[key].value
		}

		return properties;
	}

	const redirectToPricing = event => {
		window.open('https://www.kaliforms.com/pricing?utm_source=formBuilder&utm_campaign=userInterests&utm_medium=proBadge', '_blank');
	}

	const redirectToPricingAction = () => {
		return (
			<span className={classes.proButtonHolder}>
				<IconButton className={classes.proButton} onClick={() => redirectToPricing()}>
					pro
				</IconButton>
			</span>
		)
	}

	const addFieldAction = () => {
		return (
			<span style={{ position: 'relative', top: 4 }}>
				<IconButton onClick={() => addField()}>
					<AddIcon />
				</IconButton>
			</span>
		)
	}
	const determineCourseOfAction = () => {
		return typeof props.properties.pro !== 'undefined' && props.properties.pro ? redirectToPricingAction() : addFieldAction();
	}

	return (
		<Card variant="outlined"
		// className="droppable-element"
		// draggable={true}
		// unselectable="on"
		// // this is a hack for firefox
		// // Firefox requires some kind of initialization
		// // which we can do by adding this attribute
		// // @see https://bugzilla.mozilla.org/show_bug.cgi?id=568313
		// onDragStart={e => e.dataTransfer.setData("text/plain", "")}
		>
			<CardHeader
				style={{ padding: '6px 16px' }}
				titleTypographyProps={{ variant: 'subtitle2' }}
				action={determineCourseOfAction()}
				title={props.label}
			/>
		</Card>
	)
})

export default SidebarFieldComponentItem;
