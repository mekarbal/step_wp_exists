import { observable, action, computed } from 'mobx'
import { computedFn } from "mobx-utils"
export default class FormStyles {
	@observable
	styles = KaliFormsObject.formStyles;
	@observable
	selectedStyle = KaliFormsObject.selectedFormStyle;
	@action
	setSelectedStyle(key) {
		this.selectedStyle = key
	}
}
