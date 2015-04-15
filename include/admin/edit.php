<?php
	$query 		= "SELECT * FROM admin WHERE id = '{$_GET['id']}' LIMIT 1";
	$result 	= mysql_query($query);
	$count 		= mysql_num_rows($result);

	if ($count < 1) header("Location:404.php");
	
	$row 		= mysql_fetch_array($result);
?>
<div class="row-fluid">
	<div class="span12">
		<form action="process.php?what=admin&act=update&id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered'>
			<div class="box box-bordered box-color">
				<div class="box-title">
					<h3><i class="icon-th-list"></i> Perbarui Admin</h3>
				</div>
				<div class="box-content nopadding">
					<div class="control-group">
						<label for="name" class="control-label">Nama</label>
						<div class="controls">
							<input type="text" name="name" id="name" placeholder="Name" class="input-xlarge" value="<?php echo $row['nama']; ?>" required>
						</div>
					</div>
					<div class="control-group">
						<label for="user" class="control-label">Username</label>
						<div class="controls">
							<input type="text" name="user" id="username" placeholder="Username" class="input-xlarge" value="<?php echo $row['user']; ?>" required>
						</div>
					</div>
					<div class="control-group">
						<label for="pass" class="control-label">Password lama</label>
						<div class="controls">
							<input type="password" name="old_pass" id="old_pass" placeholder="Password lama" class="input-large">
						</div>
					</div>
					<div class="control-group">
						<label for="pass" class="control-label">Password</label>
						<div class="controls">
							<input type="password" name="pass" id="pass" placeholder="Password" class="input-large">
						</div>
					</div>
					<div class="control-group">
						<label for="map" class="control-label">Foto</label>
						<div class="controls">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 150px;">
									<?php if($row['image'] != ''): ?>
										<img src="img/admin/<?php echo $row['image']; ?>" />
									<?php else: ?>
										<img src="http://placehold.it/200x150" />
									<?php endif; ?>
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
								<div>
									<span class="btn btn-file"><span class="fileupload-new">Pilih gambar</span><span class="fileupload-exists">Ubah</span><input type="file" name='imagefile' /></span>
									<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Hapus</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Perbarui Admin</button>
						<a href="dashboard.php?page=admin&act=front" class="btn">Batal</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>