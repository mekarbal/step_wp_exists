import Typography from '@material-ui/core/Typography';
import Grid from '@material-ui/core/Grid';
import React, { useState, useEffect } from 'react';
const { CodeEditor } = (typeof Kali !== 'undefined' && Kali.hasOwnProperty('components')) ? Kali.components : () => (<div>Hello world</div>);
import { observer } from "mobx-react-lite";
import { store } from "./../../store/store";

const FormCustomCss = observer((props) => {
	return (
		<React.Fragment>
			<Grid container direction="row" spacing={8}>
				<Grid item lg={12} xs={12}>
					<Typography variant="h5">{KaliFormsObject.translations.customScripting.customCss}</Typography>
					<CodeEditor
						mode="css"
						height="250px"
						width="100%"
						theme="monokai"
						debounceChangePeriod={600}
						value={store._FORM_INFO_.customCss}
						onChange={(newValue) => store._FORM_INFO_.customCss = newValue}
						name="custom-css-editor"
						enableBasicAutocompletion={true}
						enableLiveAutocompletion={true}
						editorProps={{ $blockScrolling: Infinity }}
					/>
				</Grid>
			</Grid>
		</React.Fragment>
	);
})

export default FormCustomCss;
