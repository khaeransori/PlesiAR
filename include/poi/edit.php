<?php
	$query 		= "SELECT * FROM poi WHERE id = '{$_GET['id']}' LIMIT 1";
	$result 	= mysql_query($query);
	$count 		= mysql_num_rows($result);

	if ($count < 1) header("Location:404.php");
	
	$row 		= mysql_fetch_array($result);
?>
<div class="row-fluid">
	<div class="span12">
		<form action="process.php?what=poi&act=update&id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered'>
			<div class="box box-bordered box-color">
				<div class="box-title">
					<h3><i class="icon-th-list"></i> Perbaharui POI</h3>
				</div>
				<div class="box-content nopadding">
					<div class="control-group">
						<label for="name" class="control-label">Nama</label>
						<div class="controls">
							<input type="text" name="name" id="name" placeholder="Name" class="input-xlarge" value="<?php echo $row['name']; ?>" required>
						</div>
					</div>
					<div class="control-group">
						<label for="textarea" class="control-label">Deskripsi</label>
						<div class="controls">
							<textarea name="desc" id="desc" rows="5" class="input-block-level" required><?php echo $row['description']; ?></textarea>
						</div>
					</div>
					<div class="control-group">
						<label for="map" class="control-label">Lokasi</label>
						<div class="controls">
							<input type="text" id="lat" name="lat" placeholder="Latitude" value="<?php echo $row['latitude']; ?>" required>
							<input type="text" id="lon" name="lon" placeholder="Longitude" value="<?php echo $row['longitude']; ?>" required>
							<a href="#map-modal" role="button" class="btn" data-toggle="modal">Buka Peta</a>
						</div>
					</div>
					<div class="control-group">
						<label for="map" class="control-label">Gambar</label>
						<div class="controls">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 150px;"><img src="upload/<?php echo $row['image']; ?>" /></div>
								<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
								<div>
									<span class="btn btn-file"><span class="fileupload-new">Pilih gambar</span><span class="fileupload-exists">Ubah</span><input type="file" name='imagefile' /></span>
									<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Hapus</a>
								</div>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label for="map" class="control-label">Ditampilkan</label>
						<div class="controls">
							<div class="check-demo-col">
								<div class="check-line">
									<?php
										$c = ($row['status'] == 'visible') ? "checked='checked'" : '';
									?>
									<input type="checkbox" id="c5" class='icheck-me' data-skin="square" data-color="blue" name="visible" value="visible" <?php echo $c; ?>>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Perbaharui POI</button>
						<a href="dashboard.php?page=poi&act=<?php echo $row['status']; ?>" class="btn">Batal</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Map Modal -->
<div id="map-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="map-modalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="map-modalLabel">Tunjuk Koordinat</h3>
	</div>
	<div class="modal-body">
		<div id="map-canvas" style="height:300px"></div>
		<br />
		<p>
			<input id="coordx" class="span5" type="text" placeholder="Latitude" readonly>
		</p>
		<p>
			<input id="coordy" class="span5" type="text" placeholder="Longitude" readonly>
		</p>
		
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
		<button class="btn" id="savecoord">Simpan Koordinat</button>
	</div>
</div>