import LogoPng from '@img/logo.png';
import Box from '@material-ui/core/Box';
import Button from '@material-ui/core/Button';
import IconButton from '@material-ui/core/IconButton';
import Paper from '@material-ui/core/Paper';
import GridOffIcon from '@material-ui/icons/GridOff';
import GridOnIcon from '@material-ui/icons/GridOn';
import { observer } from "mobx-react-lite";
import React, { useState } from 'react';
import BuilderZone from './../components/Builder/BuilderZone';
import { store } from "./../store/store";
import formBuilderStyles from './FormBuilderStyles';

/**
 * The Form Builder
 *
 * @param {*} props
 * @returns
 */
const FormBuilder = observer((props) => {
	const classes = formBuilderStyles(props);
	const [gridHelper, setGridHelper] = useState(false);

	// State
	return (
		<React.Fragment>
			<Paper className={classes.paper}>
				<Choose>
					<When condition={store._FIELD_COMPONENTS_.fieldComponents.length === 0}>
						<Box className={classes.placeholder}>
							<img src={LogoPng} style={{ width: 250 }} alt="logo" />
							<h4>{KaliFormsObject.translations.builder.placeholderTitle}</h4>
							<Button variant="contained" color="primary" onClick={() => store._UI_.setTemplateSelecting(true)}>{KaliFormsObject.translations.builder.placeholderButton}</Button>
						</Box>
					</When>
					<Otherwise>
						<BuilderZone />
					</Otherwise>
				</Choose>

				<If condition={gridHelper}>
					<div className={classes.gridHelperParent}>
						{[...Array(12)].map((x, i) =>
							<div key={i} className={classes.gridHelperColumn}>
								<span className={classes.gridHelperSpan}></span>
							</div>
						)}
					</div>
				</If>
			</Paper>

			<Box className={classes.gridHelperButton}>
				<If condition={gridHelper}>
					<IconButton onClick={() => setGridHelper(false)}>
						<GridOffIcon />
					</IconButton>
				</If>
				<If condition={!gridHelper}>
					<IconButton onClick={() => setGridHelper(true)}>
						<GridOnIcon />
					</IconButton>
				</If>
			</Box>
		</React.Fragment>
	);
})

export default FormBuilder;
