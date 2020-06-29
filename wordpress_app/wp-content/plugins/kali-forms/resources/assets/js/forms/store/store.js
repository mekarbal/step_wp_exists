import { extendObservable, autorun, observable, toJS } from "mobx";
import Ui from './stores/ui';
import FieldComponents from './stores/fieldComponents';
import Grid from './stores/grid';
import Emails from './stores/emails';
import FormInfo from './stores/formInfo';
import FormStyles from './stores/formStyles'
import ConfirmationDialog from './stores/confirmationDialog';

const autoSave = (store, save) => {
	let firstRun = true;
	autorun(() => {
		const json = toJS(store._UI_);
		if (!firstRun) {
			save(json);
		}
		firstRun = false;
	});
}
export const clear = () => {
	localStorage.removeItem('KaliFormsUi_' + KaliFormsObject.formId);
}

class KaliFormsStore {
	@observable _UI_ = new Ui();
	@observable _FIELD_COMPONENTS_ = new FieldComponents();
	@observable _GRID_ = new Grid();
	@observable _EMAILS_ = new Emails();
	@observable _FORM_INFO_ = new FormInfo();
	@observable _FORM_STYLES_ = new FormStyles();
	@observable _CONFIRMATION_DIALOG_ = new ConfirmationDialog()

	constructor() {
		this.load();
		autoSave(this, this.save.bind(this));
	}

	load() {
		const lS = localStorage.getItem('KaliFormsUi_' + KaliFormsObject.formId);
		if (lS !== null) {
			extendObservable(this._UI_, JSON.parse(lS));
		}
	}

	save(json) {
		delete json.activeTabInSidebar;
		delete json.activeFormFieldInSidebar;
		delete json.activeFormFieldGroupTab;
		delete json.templateSelecting;
		delete json.activeEmailInSidebar;

		localStorage.setItem('KaliFormsUi_' + KaliFormsObject.formId, JSON.stringify({ ...json }));
	}
}


export const store = new KaliFormsStore();
