				<?php
					$query 		= "SELECT * FROM admin ORDER BY nama ASC";
					$result 	= mysql_query($query);
					$count 		= mysql_num_rows($result);
				?>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Daftar Administrator
								</h3>
								<div class="actions">
									<a href="dashboard.php?page=admin&act=add" class="btn">
										<i class="icon-plus-sign"></i> Tambah Admin
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>Nama</th>
											<th>Username</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php while ($row = mysql_fetch_array($result)): ?>
											<tr>
												<td>
													<?php echo $row['nama']; ?>
												</td>
												<td>
													<?php echo $row['user']; ?>
												</td>
												<td>
													<a href="dashboard.php?page=admin&act=edit&id=<?php echo $row['id']; ?>" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
													<a href="#" data-id="<?php echo $row['id']; ?>"  data-name="<?php echo $row['nama']; ?>" class="confirm-delete btn" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
												</td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div id="modal-delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="map-modalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="modal-deleteLabel">Delete Admin</h3>
					</div>
					<div class="modal-body">
						<p>You are about to delete one Admin, this procedure is irreversible.</p>
				        <p>Do you want to proceed?</p>
				        <p id="debug-url"></p>
					</div>
					<div class="modal-footer">
						<a href="process.php?what=admin&act=delete&id=" class="btn btn-danger">Yes</a>
				        <a href="#" data-dismiss="modal" class="btn">No</a>
					</div>
				</div>