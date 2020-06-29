import Box from '@material-ui/core/Box';
import Container from '@material-ui/core/Container';
import Drawer from '@material-ui/core/Drawer';
import { observer } from "mobx-react-lite";
import { useSnackbar } from 'notistack';
import React, { useEffect } from 'react';
import AppBar from './../components/AppBar';
import EmailEditorContainer from './../containers/EmailEditorContainer';
import SaveDataComponent from './../components/SaveDataComponent/SaveDataComponent';
import CustomSnack from './../components/Snackbars/CustomSnack';
import SnackBarAction from './../components/SnackBars/SnackBarAction';
import { store } from "./../store/store";
import appStyles from './AppStyles';
import FormBuilder from './FormBuilder';
import FormSettings from './FormSettings';
import EmailBuilderSidebar from './Sidebars/EmailBuilderSidebar';
import FormBuilderSidebar from './Sidebars/FormBuilderSidebar';
import FormSettingsSidebar from './Sidebars/FormSettingsSidebar';
import TemplateSelector from './TemplateSelector';
import ConfirmationDialog from '../components/ConfirmationDialog/ConfirmationDialog';

/**
 * App created as a hook
 *
 * @param {*} props
 * @returns
 */
const App = observer(props => {
	const { enqueueSnackbar } = useSnackbar();
	const classes = appStyles(props);
	const queueSnack = (props) => {
		props.tip === true
			?
			enqueueSnackbar(props.message, {
				persist: true,
				preventDuplicate: true,
				content: (key) => (
					<CustomSnack id={key} message={props.message} title={props.title} type={props.type} actions={props.actions} />
				),
			})
			:
			enqueueSnackbar(props.message,
				{
					preventDuplicate: true,
					variant: props.type,
					action: (key) => <SnackBarAction snackKey={key} />
				}
			)
	}

	useEffect(() => {
		KaliFormsObject.notices.map(e => {
			queueSnack(e);
		});
	}, [])

	return (
		<Box className={classes.root}>
			<If condition={!store._UI_.templateSelecting}>
				<AppBar />
			</If>
			<Drawer className={classes.drawer}
				variant="permanent"
				classes={{
					paper: classes.drawerPaper,
				}}>
				<div className={classes.toolbar}
				/>
				<Choose>
					<When condition={store._UI_.appBar === 'formBuilder'}>
						<FormBuilderSidebar />
					</When>
					<When condition={store._UI_.appBar === 'emailBuilder'}>
						<EmailBuilderSidebar />
					</When>
					<When condition={store._UI_.appBar === 'formSettings'}>
						<FormSettingsSidebar />
					</When>
				</Choose>
			</Drawer>
			<main className={classes.content}>
				<div className={classes.appBarSpacer} />
				<Container className={classes.container} fixed={true} maxWidth="md" disableGutters={true}>
					<Choose>
						<When condition={store._UI_.templateSelecting}>
							<TemplateSelector />
						</When>
						<Otherwise>
							<If condition={store._UI_.appBar === 'formBuilder'}>
								<FormBuilder />
							</If>
							<If condition={store._UI_.appBar === 'emailBuilder'}>
								<EmailEditorContainer />
							</If>
							<If condition={store._UI_.appBar === 'formSettings'}>
								<FormSettings />
							</If>
						</Otherwise>
					</Choose>
				</Container>
			</main>
			<SaveDataComponent />
			<ConfirmationDialog />
		</Box>
	)
});

export default App;

