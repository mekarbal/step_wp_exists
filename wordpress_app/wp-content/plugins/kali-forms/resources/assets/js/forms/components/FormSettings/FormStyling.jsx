import FormControlLabel from '@material-ui/core/FormControlLabel';
import Grid from '@material-ui/core/Grid';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import { makeStyles } from '@material-ui/core/styles';
import Typography from '@material-ui/core/Typography';
import { observer } from "mobx-react-lite";
import React from 'react';
import { store } from "./../../store/store";
const useStyles = makeStyles(theme => {
	return {
		radio: {
			marginBottom: theme.spacing(2),
			minWidth: 270,
		},
		styleThumb: {
			maxWidth: 270,
			display: 'block'
		},
		styleCaption: {
			display: 'block',
			textAlign: 'center'
		},
		marginTop: {
			marginTop: theme.spacing(4),
		}
	}
});

const FormStyling = observer((props) => {
	const classes = useStyles();
	return (
		<React.Fragment>
			<Grid container direction="row" spacing={6}>
				<Grid item>
					<Typography variant="h5">{KaliFormsObject.translations.formStyling.title}</Typography>
				</Grid>
			</Grid>

			<Grid container direction="row" className={classes.marginTop}>
				<Grid item xs={12}>
					<RadioGroup value={store._FORM_STYLES_.selectedStyle} row>
						{store._FORM_STYLES_.styles.map(e => (
							<FormControlLabel key={e.id}
								control={
									<Radio color="primary" onChange={() => store._FORM_STYLES_.setSelectedStyle(e.id)} value={e.id} />
								}
								className={classes.radio}
								labelPlacement="top"
								label={
									<React.Fragment>
										<img className={classes.styleThumb} src={e.thumb} />
										<small className={classes.styleCaption}>{e.label}</small>
									</React.Fragment>
								}
							/>

						))}
					</RadioGroup>
				</Grid>
			</Grid>
		</React.Fragment>
	)
})
export default FormStyling;
