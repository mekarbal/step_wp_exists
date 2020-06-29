import { observable, action } from 'mobx'
import { computedFn } from "mobx-utils"

export default class FormInfo {
	@observable
	formName = KaliFormsObject.formName;
	@observable
	requiredFieldMark = KaliFormsObject.requiredFieldMark;
	@observable
	globalErrorMessage = KaliFormsObject.globalErrorMessage
	@observable
	multipleSelectionsSeparator = KaliFormsObject.multipleSelectionsSeparator
	@observable
	cssId = KaliFormsObject.cssId
	@observable
	cssClass = KaliFormsObject.cssClass
	@observable
	thankYouMessage = KaliFormsObject.thankYouMessage
	@observable
	redirectUrl = KaliFormsObject.redirectUrl
	@observable
	hideFormName = KaliFormsObject.hideFormName
	@observable
	removeCaptchaForLoggedUsers = KaliFormsObject.removeCaptchaForLoggedUsers
	@observable
	showThankYouMessage = KaliFormsObject.showThankYouMessage
	@observable
	saveFormSubmissions = KaliFormsObject.saveFormSubmissions
	@observable
	submissionViewPage = typeof KaliFormsObject.submissionViewPage !== 'undefined' ? KaliFormsObject.submissionViewPage : ''
	@observable
	googleSecretKey = KaliFormsObject.googleSecretKey
	@observable
	googleSiteKey = KaliFormsObject.googleSiteKey
	@observable
	currency = KaliFormsObject.currency
	@observable
	paymentsLive = KaliFormsObject.paymentsLive
	@observable
	payPalClientId = KaliFormsObject.payPalClientId
	@observable
	payPalClientIdSandBox = KaliFormsObject.payPalClientIdSandBox
	@observable
	stripeKey = typeof KaliFormsObject.stripeKey !== 'undefined' ? KaliFormsObject.stripeKey : ''
	@observable
	stripeKeySandBox = typeof KaliFormsObject.stripeKeySandBox !== 'undefined' ? KaliFormsObject.stripeKeySandBox : ''
	@observable
	conditionalLogic = KaliFormsObject.conditionalLogic
	@observable
	customCss = typeof KaliFormsObject.formScripting !== 'undefined' ? KaliFormsObject.formScripting.css : ''
	@observable
	customJs = typeof KaliFormsObject.formScripting !== 'undefined' ? KaliFormsObject.formScripting.js : ''
	@observable
	customPhpAfter = typeof KaliFormsObject.formScripting !== 'undefined' ? KaliFormsObject.formScripting.phpAfter : ''
	@observable
	customPhpBefore = typeof KaliFormsObject.formScripting !== 'undefined' ? KaliFormsObject.formScripting.phpBefore : ''
	@observable
	hubspotData = typeof KaliFormsObject.hubspotData !== 'undefined' ? KaliFormsObject.hubspotData : ''
	@observable
	deleteQueue = typeof KaliFormsObject.deleteQueue !== 'undefined' ? KaliFormsObject.deleteQueue : ''

	@action
	setFormInfo(data) {
		for (let key in data) {
			if (this.hasOwnProperty(key) && key !== 'conditionalLogic') {
				this[key] = data[key];
			}
		}
	}

	@action
	setConditionalLogic(logic) {
		this.conditionalLogic = logic;
	}

	@action
	addConditional(item) {
		this.conditionalLogic.push(item)
	}

	@action
	removeCondition(index) {
		this.conditionalLogic = [...this.conditionalLogic].filter((el, idx) => idx !== index)
	}

	@action
	removeConditionByAssertion(condition) {
		this.conditionalLogic = [...this.conditionalLogic].filter(field => JSON.stringify(field) !== JSON.stringify(condition));
	}

	getFieldConditionersByInternalId = computedFn(function getFieldConditionersByInternalId(internalId) {
		let conditions = [...this.conditionalLogic].filter(e => e.conditioner === internalId);
		return conditions;
	})

	getFieldConditionsByInternalId = computedFn(function getFieldConditionsByInternalId(internalId) {
		let conditions = [...this.conditionalLogic].filter(e => e.field === internalId);
		return conditions;
	})
}
