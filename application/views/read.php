<div class="sidebar_container">
	<div class="sidebar">
		<div class="sidebar_item">
			<h2>File</h2>
			<?php echo form_open($action,  "enctype='multipart/form-data'") ;?>
				<table>
					<tr>
						<th colspan="2" align="left">
							<label for="filename">File Name:</label><input id="id" name="id" type="hidden" value="<?php echo $id; ?>" />
						</th>
						<td>&nbsp;</td>
						<td><?php echo $filename; ?><input id="filename" name="filename" type="hidden" value="<?php echo $filename; ?>" readonly /></td>
					</tr>
					<tr>
						<th colspan="2" align="left">
							<label for="filename">Description:</label>
						</th>
						<td>&nbsp;</td>
						<td><?php echo $description; ?><br /><a href="#" onclick="window.open('../../../<?php echo $ref_file; ?>');">View Initial Version</a></td>
					</tr>
					<tr>
						<th colspan="2" align="left">
							<label for="filename">File Name:</label><input id="id" name="id" type="hidden" value="<?php echo $id; ?>" />
						</th>
						<td>&nbsp;</td>
						<td><?php echo $filename; ?><input id="filename" name="filename" type="hidden" value="<?php echo $filename; ?>" readonly /></td>
					</tr>
					<tr>
						<td colspan="4">
							<?php echo anchor('fileupload/update/'.$id, 'Update Head'); ?>&nbsp;|&nbsp;
							<?php echo anchor('fileupload/deleteAll/'.$id, 'Delete complete version', array('onclick' => "return confirm('Are you sure want to delete this file and history?')")); ?>
						</td>
					</tr>
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="4"><h3>New version for this file<h3></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<th align="left"><label for="description">Description:</label></th>
						<td>&nbsp;</td>
						<td><textarea id="description" name="description" cols="25" rows="4"></textarea></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<th align="left"><label for="ref_id">File:</label></th>
						<td>&nbsp;</td>
						<td>
							<input id="uploaded" name="uploaded" type="file" />
							<input id="ref_id" name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3" align="center"><input type="submit" value="Add new version" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>