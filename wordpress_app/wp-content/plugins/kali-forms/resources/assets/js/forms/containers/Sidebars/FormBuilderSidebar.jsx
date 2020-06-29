import Box from '@material-ui/core/Box';
import Grid from '@material-ui/core/Grid';
import Tab from '@material-ui/core/Tab';
import Tabs from '@material-ui/core/Tabs';
import Typography from '@material-ui/core/Typography';
import { observer } from "mobx-react-lite";
import React from 'react';
import SidebarFieldComponentItem from './../../components/Sidebar/SidebarFieldComponentItem';
import SidebarFormFieldEditorContainer from './../../components/Sidebar/SidebarFormFieldEditorContainer';
import { store } from "./../../store/store";

const FormBuilderSidebar = observer(props => {
	const toggle = (e, tab) => {
		if (store._UI_.activeTabInSidebar !== tab) {
			store._UI_.setActiveTabInSidebar(tab);
		}
	}

	const displayStyles = {
		formFields: store._UI_.activeTabInSidebar === 'formFields' ? { display: 'block' } : { display: 'none' },
		fieldProperties: store._UI_.activeTabInSidebar === 'fieldProperties' ? { display: 'block' } : { display: 'none' },
	}

	return (
		<React.Fragment>
			<React.Fragment>
				<Tabs
					value={store._UI_.activeTabInSidebar}
					indicatorColor="primary"
					textColor="primary"
					onChange={toggle}
					centered
				>
					<Tab value="formFields" label={KaliFormsObject.translations.sidebar.formFields} />
					<Tab value="fieldProperties" label={KaliFormsObject.translations.sidebar.fieldProperties} />
				</Tabs>
			</React.Fragment>
			<React.Fragment>
				<Box style={displayStyles.formFields}>
					{
						store._FIELD_COMPONENTS_.formFieldTypes.map((group, index) => {
							return (
								<div key={group.id} style={{ marginBottom: 25 }}>
									<Typography variant="subtitle2">{group.label}</Typography>
									<hr />
									<Grid container spacing={1}>
										{group.fields.map((e, idx) => {
											return (
												<Grid item xs={12} md={6} xl={4} key={e.id + idx}>
													<SidebarFieldComponentItem
														id={e.id}
														label={e.label}
														constraint={e.constraint}
														properties={e.properties}
													/>
												</Grid>
											)
										})}
									</Grid>
								</div>
							)
						})
					}
				</Box>
				<Box style={displayStyles.fieldProperties}>
					<SidebarFormFieldEditorContainer />
				</Box>
			</React.Fragment>
		</React.Fragment>
	)
})

export default FormBuilderSidebar;
