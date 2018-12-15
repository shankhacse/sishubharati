

		<tr id="rowDocument_0_<?php echo $rowno; ?>">
			<td>
				<select name="docType[]" id="docType_0_<?php echo $rowno; ?>" class="form-control custom_frm_input docType">
					<option value="3">Pdf Only</option>
					
				</select>
					<input type="hidden" name="prvFilename[]" id="prvFilename_0_<?php echo $rowno; ?>" class="form-control prvFilename" value="" readonly >

					<input type="hidden" name="randomFileName[]" id="randomFileName_0_<?php echo $rowno; ?>" class="form-control randomFileName" value="" readonly >

					<input type="hidden" name="docDetailIDs[]" id="docDetailIDs_0_<?php echo $rowno; ?>" class="form-control randomFileName" value="0" readonly >
			</td>
			<td>
				<input type="file" name="fileName[]" class="file fileName" id="fileName_0_<?php echo $rowno; ?>" accept=".pdf">
				<div class="input-group col-xs-12">
				     <!--  <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span> -->
					<input type="text" name="userFileName[]" id="userFileName_0_<?php echo $rowno; ?>" class="form-control input-xs userFileName" readonly placeholder="Upload Document" >

						<input type="hidden" name="isChangedFile[]" id="isChangedFile_0_<?php echo $rowno; ?>" value="Y" >
						<span class="input-group-btn">
					    <button class="browse btn btn-primary input-xs" type="button" id="uploadBtn_0_<?php echo $rowno; ?>">
					      	<i class="fa fa-folder-open" aria-hidden="true"></i>
						</button>
					    </span>
				</div>
			</td>
			<td>
				<textarea name="fileDesc[]" id="fileDesc_0_<?php echo $rowno; ?>" class="form-control custom_frm_input dtl_txt_area_trainer" style="height: 33px;" ></textarea>
			</td>
			<td style="vertical-align: middle;">
				<a href="javascript:;" class="delDocType" id="delDocRow_0_<?php echo $rowno; ?>" title="Delete">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		</tr>