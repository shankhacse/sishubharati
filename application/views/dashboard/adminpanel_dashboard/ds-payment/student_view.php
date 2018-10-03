

<select id="sel_student_name" name="sel_student_name" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
		<option value="0">Select</option>
		<?php
				foreach ($studentlist as $key => $value) { ?>

				<option value="<?php echo $value->academic_id; ?>"><?php echo $value->student_name; ?></option>

					<?php	}
					?>

</select>