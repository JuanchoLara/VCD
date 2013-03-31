	<div class="sidebar">
		<div class="sidebar_item">
			<h2>Versions List</h2>
			<table>
				<tr>
					<th>Description</th><th>Timestamp</th>&nbsp;</th>
				</tr>
			<?php foreach($fileuploads as $fileupload) : ?>
				<tr>
					<td align="left"><?php echo $fileupload->description; ?></td>
					<td align="center"><?php echo $fileupload->created; ?></td>
					<td align="center"><?php echo anchor('fileupload/delete/'.$fileupload->id, 'Del', array('onclick' => "return confirm('Are you sure want to delete this version of the file?')")); ?> |
						<a href="#" onclick="window.open('../../../<?php echo $fileupload->ref_file; ?>');">View</a></td>
				</tr>
			<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>