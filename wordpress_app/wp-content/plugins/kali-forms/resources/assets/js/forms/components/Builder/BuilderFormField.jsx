import React from 'react';
import paypalLogo from './../../../../img/paypal.svg';
import DragIndicatorIcon from '@material-ui/icons/DragIndicator';
import Box from '@material-ui/core/Box';
import builderFormFieldStyles from './BuilderFormFieldStyles';
import { observer } from "mobx-react-lite";
import { store } from "./../../store/store";
import StarIcon from '@material-ui/icons/Star';

const BuilderFormField = observer((props) => {
	const classes = builderFormFieldStyles(props);

	const previewField = (field, classes) => {
		switch (field.id) {
			case 'rating':
				var label = setComputedLabelFunc(field);
				var items = [];
				var defaultVal = field.properties.default;
				var max = parseFloat(field.properties.max) > 10 ? 10 : parseFloat(field.properties.max);
				for (var j = 0; j < max; j++) {
					items.push(<StarIcon key={j} color={defaultVal <= j ? 'inherit' : 'primary'} />);
				}

				return (
					<label className={classes.label}>
						{label} {required ? store._FORM_INFO_.requiredFieldMark || '(*)' : ''}
						<br />
						{items}
						<br />
						<small>{field.properties.description}</small>
					</label>
				)
			case 'choices':
			case 'dropdown':
				var label = setComputedLabelFunc(field);
				var checked = field.properties.default;
				var required = field.properties.required;
				return (
					<label className={classes.label}>
						{label} {required ? store._FORM_INFO_.requiredFieldMark || '(*)' : ''}
						<br />
						<select className={classes.select} value={checked || ''} onChange={e => e}>
							<If condition={field.properties.hasOwnProperty('choices')}>
								{
									field.properties.choices.map((choice, idx) => {
										return (
											<option value={choice.value} key={choice.value + idx}>
												{choice.label}
											</option>
										)
									})
								}
							</If>
						</select>
						<small>{field.properties.description}</small>
					</label>
				)
			case 'freeText':
				var label = field.properties.id;
				var content = field.properties.content;
				if (content !== '') {
					return (<span dangerouslySetInnerHTML={{ __html: field.properties.content }}></span>);
				}

				return (<span>{label}</span>)
			case 'radio':
				var label = setComputedLabelFunc(field);
				return (
					<label className={classes.label}>
						{label} {required ? store._FORM_INFO_.requiredFieldMark || '(*)' : ''}
						<br />
						<If condition={field.properties.hasOwnProperty('choices')}>
							{
								field.properties.choices.map((choice, idx) => {
									var checked = choice.value === field.properties.default;

									return (
										<label className={classes.labelCheckbox} key={choice.value + idx}>
											<input type="radio" checked={checked} onChange={e => e} className={classes.checkbox} />
											{choice.label}
										</label>
									)
								})
							}
						</If>
						<br />
						<small>{field.properties.description}</small>
					</label>
				);
			case 'checkbox':
				var label = setComputedLabelFunc(field);
				return (
					<label className={classes.label}>
						{label} {required ? store._FORM_INFO_.requiredFieldMark || '(*)' : ''}
						<br />
						<If condition={field.properties.hasOwnProperty('choices')}>
							{
								field.properties.choices.map((choice, idx) => {
									let checkedOptions = field.properties.default.split(',');
									let checked = checkedOptions.includes(choice.value);
									return (
										<label className={classes.labelCheckbox} key={choice.value + idx}>
											<input type="checkbox" checked={checked} onChange={e => e} className={classes.checkbox} />
											<em>{choice.value}</em> / {choice.label}
										</label>
									)
								})
							}
						</If>
						<br />
						<small>{field.properties.description}</small>
					</label>
				);
			case 'textarea':
				var label = setComputedLabelFunc(field);
				var required = field.properties.required;
				var defaultVal = field.properties.default;
				var placeholder = field.properties.placeholder;
				return (
					<label className={classes.label}>
						{label} {required ? store._FORM_INFO_.requiredFieldMark || '(*)' : ''}
						<br />
						<textarea className={classes.textarea} placeholder={placeholder} value={defaultVal || ''} onChange={e => e} />
						<small>{field.properties.description}</small>
					</label>
				);
			case 'divider':
				return (
					<span className={classes.divider}>
						<span>{field.properties.type}</span>
						<hr />
					</span>
				);
			case 'fileUpload':
				return (
					<span className={classes.fileUpload}>
						<span dangerouslySetInnerHTML={{ __html: KaliFormsObject.translations.frontend.filePond.labelIdle }}>
						</span>
					</span>
				);
			case 'submitButton':
				var label = setComputedLabelFunc(field);
				return (<button className="button">{label}</button>)
			case 'hidden':
				var required = field.properties.required;
				var defaultVal = field.properties.default;
				var label = field.properties.name + ' field';
				return (
					<label className={classes.label}>
						{label} {required ? store._FORM_INFO_.requiredFieldMark || '(*)' : ''}
						<br />
						<input className={classes.inputHidden} type="textbox" value={defaultVal || ''} onChange={e => e} />
						<small>{field.properties.description}</small>
					</label>
				)
			case 'grecaptcha':
				return (
					<span className={classes.grecaptcha}>
						<img src={KaliFormsObject.assetsUrl + '/img/recaptcha.gif'} />
					</span>
				);
			case 'pageBreak':
				var label = setComputedLabelFunc(field);
				return (
					<span className={classes.pageBreak}>
						<div><button className="button">Back</button></div>
						<div> {label} </div>
						<div><button className="button">Next</button></div>
					</span>
				);
			case 'dateTimePicker':
			case 'date':
				var label = setComputedLabelFunc(field);
				var required = field.properties.required;
				var defaultVal = field.properties.default;
				var placeholder = field.properties.placeholder;
				return (
					<label className={classes.label}>
						{label} {required ? store._FORM_INFO_.requiredFieldMark || '(*)' : ''}
						<br />
						<input className={classes.input} type="date" placeholder={placeholder} value={defaultVal || ''} onChange={e => e} />
						<small>{field.properties.description}</small>
					</label>
				)
			case 'password':
				var label = setComputedLabelFunc(field);
				var required = field.properties.required;
				var defaultVal = field.properties.default;
				var placeholder = field.properties.placeholder;
				return (
					<label className={classes.label}>
						{label} {required ? store._FORM_INFO_.requiredFieldMark || '(*)' : ''}
						<br />
						<input className={classes.input} type="textbox" placeholder={placeholder} value="******" onChange={e => e} />
						<small>{field.properties.description}</small>
					</label>
				)
			case 'range':
				var label = setComputedLabelFunc(field);
				var required = field.properties.required;
				var defaultVal = field.properties.default;
				var placeholder = field.properties.placeholder;
				return (
					<label className={classes.label}>
						{label} {required ? store._FORM_INFO_.requiredFieldMark || '(*)' : ''}
						<br />
						<input className={classes.input} min="0" max="100" type="range" placeholder={placeholder} value={defaultVal || ''} onChange={e => e} />
						<small>{field.properties.description}</small>
					</label>
				)
			case 'product':
				var label = setComputedLabelFunc(field);
				return (<span>{label} - {field.properties.price}</span>)
			case 'paypal':
				return (<span className={classes.paypal}><img src={paypalLogo} /></span>)
			case 'smartTextOutput':
				return (<code className={classes.code}>{field.properties.content}</code>)
			default:
				var label = setComputedLabelFunc(field);
				var required = field.properties.required;
				var defaultVal = field.properties.default;
				var placeholder = field.properties.placeholder;
				return (
					<label className={classes.label}>
						{label} {required ? store._FORM_INFO_.requiredFieldMark || '(*)' : ''}
						<br />
						<input className={classes.input} type="textbox" placeholder={placeholder} value={defaultVal || ''} onChange={e => e} />
						<small>{field.properties.description}</small>
					</label>
				)
		}
	}

	/**
	 * Better labels
	 * @return {*}
	 */
	const setComputedLabelFunc = (field) => {
		let compLabel = `${field.label} field`;
		if (field.properties.caption !== '') {
			compLabel = field.properties.caption;
		}

		return compLabel;
	}

	const getField = (id) => {
		let field = store._FIELD_COMPONENTS_.fieldComponents.filter(el => el.internalId === id)
		if (!field.length) {
			return null
		}
		return field[0];
	}

	const field = getField(props.field);

	return (
		<Box className={classes.container}>
			<DragIndicatorIcon className={'KaliFormsBuilderDragHandle ' + classes.moveButton} />
			{<If condition={typeof props.field !== 'undefined'}>
				{previewField(field, classes)}
			</If>}
		</Box>
	);
});

export default BuilderFormField;
