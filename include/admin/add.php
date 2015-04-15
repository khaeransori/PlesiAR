<div class="row-fluid">
	<div class="span12">
		<form action="process.php?what=admin&act=save" method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered'>
			<div class="box box-bordered box-color">
				<div class="box-title">
					<h3><i class="icon-th-list"></i> Tambah Admin</h3>
				</div>
				<div class="box-content nopadding">
					<div class="control-group">
						<label for="name" class="control-label">Nama</label>
						<div class="controls">
							<input type="text" name="name" id="name" placeholder="Name" class="input-xlarge" required>
						</div>
					</div>
					<div class="control-group">
						<label for="user" class="control-label">Username</label>
						<div class="controls">
							<input type="text" name="user" id="username" placeholder="Username" class="input-xlarge" required>
						</div>
					</div>
					<div class="control-group">
						<label for="pass" class="control-label">Password</label>
						<div class="controls">
							<input type="password" name="pass" id="pass" placeholder="Password" class="input-large" required>
						</div>
					</div>
					<div class="control-group">
						<label for="map" class="control-label">Foto</label>
						<div class="controls">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 150px;"><img src="http://placehold.it/200x150" /></div>
								<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
								<div>
									<span class="btn btn-file"><span class="fileupload-new">Pilih gambar</span><span class="fileupload-exists">Ubah</span><input type="file" name='imagefile' /></span>
									<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Hapus</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Tambah Admin</button>
						<a href="dashboard.php?page=admin&act=front" class="btn">Batal</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>