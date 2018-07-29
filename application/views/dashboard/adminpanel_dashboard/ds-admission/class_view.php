

<select id="sel_class" name="sel_class" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
		<option value="0">Select</option>
		<?php
				foreach ($classList as $key => $value) { ?>

				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>

					<?php	}
					?>

</select>