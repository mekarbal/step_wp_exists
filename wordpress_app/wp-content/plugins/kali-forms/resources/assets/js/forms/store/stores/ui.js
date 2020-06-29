import { observable, action, computed } from 'mobx'

export default class Ui {
	@observable
	appBar = 'formBuilder';
	@observable
	sidebar = 'formFields';
	@observable
	drawerLoading = false;
	@observable
	pageLoading = false;
	@observable
	placeholderDialog = false;
	@observable
	emailWizardDialog = false;
	@observable
	activeTabInSidebar = 'formFields';
	@observable
	activeFormFieldInSidebar = 0;
	@observable
	activeFormFieldGroupTab = 'general';
	@observable
	templateSelecting = false;
	@observable
	activeEmailInSidebar = false;
	@observable
	activeFormSettingsItem = 'general';
	@action
	setActiveFormFieldGroupTab(key) {
		this.activeFormFieldGroupTab = key;
	}
	@action
	setTemplateSelecting(state) {
		this.templateSelecting = state;
	}
	@action
	setActiveFormFieldInSidebar(key) {
		this.activeFormFieldInSidebar = key;
	}
	@action
	setActiveFormSettingsItem(key) {
		this.activeFormSettingsItem = key;
	}
	@action
	setActiveEmailInSidebar(key) {
		this.activeEmailInSidebar = key;
	}
	@action
	setActiveTabInSidebar(string) {
		this.activeTabInSidebar = string
	}
	@action
	setPlaceholderDialog(loading) {
		this.placeholderDialog = loading;
	}
	@action
	setEmailWizardDialog(loading) {
		this.emailWizardDialog = loading;
	}
	@action
	setPlaceholderDialog(state) {
		this.placeholderDialog = state
	}
	@action
	setPageLoading(loading) {
		this.pageLoading = loading;
	}
	@action
	setAppBar(string) {
		this.appBar = string;
	}
	@action
	setSidebar(string) {
		this.sidebar = string
	}
	@action
	setDrawerLoading(loading) {
		this.drawerLoading = loading;
	}

	constructor() {
		if (!KaliFormsObject.fieldComponents.length) {
			this.templateSelecting = true;
		}
	}
}
