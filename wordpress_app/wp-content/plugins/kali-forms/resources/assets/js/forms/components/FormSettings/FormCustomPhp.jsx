import Typography from '@material-ui/core/Typography';
import Grid from '@material-ui/core/Grid';
import React, { useState, useEffect } from 'react';
const { CodeEditor } = (typeof Kali !== 'undefined' && Kali.hasOwnProperty('components')) ? Kali.components : () => (<div>Hello world</div>);
import { observer } from "mobx-react-lite";
import { store } from "./../../store/store";

const FormCustomPhp = observer((props) => {
	return (
		<React.Fragment>
			<Grid container direction="row" spacing={8}>
				<Grid item lg={12} xs={12}>
					<Typography variant="h5">{KaliFormsObject.translations.customScripting.phpBefore}</Typography>
					<CodeEditor
						mode="php"
						height="250px"
						width="100%"
						theme="monokai"
						value={store._FORM_INFO_.customPhpBefore}
						debounceChangePeriod={600}
						onChange={(newValue) => store._FORM_INFO_.customPhpBefore = newValue}
						name="custom-php-before-process-editor"
						enableBasicAutocompletion={true}
						enableLiveAutocompletion={true}
						editorProps={{ $blockScrolling: Infinity }}
					/>
				</Grid>
			</Grid>
			<Grid container direction="row" spacing={8}>
				<Grid item lg={12} xs={12}>
					<Typography variant="h5">{KaliFormsObject.translations.customScripting.phpAfter}</Typography>
					<CodeEditor
						mode="php"
						height="250px"
						width="100%"
						theme="monokai"
						value={store._FORM_INFO_.customPhpAfter}
						debounceChangePeriod={600}
						onChange={(newValue) => store._FORM_INFO_.customPhpAfter = newValue}
						name="custom-php-after-process-editor"
						enableBasicAutocompletion={true}
						enableLiveAutocompletion={true}
						editorProps={{ $blockScrolling: Infinity }}
					/>
				</Grid>
			</Grid>
		</React.Fragment>
	);
});

export default FormCustomPhp;
