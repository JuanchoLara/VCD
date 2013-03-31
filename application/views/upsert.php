<div class="sidebar_container">
	<div class="sidebar">
		<div class="sidebar_item">
			<h2>File</h2>
			<?php echo form_open($action, "enctype='multipart/form-data'"); ?>
				<table>
					<tr>
						<td>
							<label for="filename">File Name:</label>
							<input id="id" name="id" type="hidden" value="<?php echo $id; ?>" />
						</td>
						<td>&nbsp;</td>
						<td><input id="filename" name="filename" type="text" size="75" value="<?php echo $filename; ?>" /></td>
					</tr>
					<tr>
						<td><label for="description">Description:</label></td>
						<td>&nbsp;</td>
						<td><textarea id="description" name="description" cols="25" rows="4"><?php echo $description; ?></textarea></td>
					</tr>
					<tr>
						<td><label for="ref_id">File:</label></td>
						<td>&nbsp;</td>
						<td>
							<input id="uploaded" name="uploaded" type="file" />
							<input type="hidden" id="ref_id" name="ref_id" value="<?php echo $ref_id; ?>" />
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center"><input type="submit" value="Send" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>