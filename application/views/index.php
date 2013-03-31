<div class="sidebar_container">
<?php foreach($fileuploads as $fileupload) : ?>
	<div class="sidebar">
		<div class="sidebar_item">
			<h2><?php echo anchor("fileupload/read/{$fileupload->id}/{$fileupload->ref_id}", $fileupload->filename); ?></h2>
			<p><?php echo $fileupload->description; ?></p>
			<p><?php echo $fileupload->created; ?></p>
		</div>
	</div>
<?php endforeach; ?>
</table>
</div>