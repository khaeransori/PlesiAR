				<?php
					$query 		= "SELECT * FROM poi WHERE status = 'visible' ORDER BY id DESC";
					$result 	= mysql_query($query);
					$count 		= mysql_num_rows($result);
				?>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Daftar POI tertampil
								</h3>
								<div class="actions">
									<a href="dashboard.php?page=poi&act=add" class="btn">
										<i class="icon-plus-sign"></i> Tambah POI
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>Nama</th>
											<th>Latitude</th>
											<th>Longitude</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php while ($row = mysql_fetch_array($result)): ?>
											<tr>
												<td>
													<?php echo $row['name']; ?>
												</td>
												<td>
													<?php echo $row['latitude']; ?>
												</td>
												<td>
													<?php echo $row['longitude']; ?>
												</td>
												<td>
													<a href="dashboard.php?page=poi&act=edit&id=<?php echo $row['id']; ?>" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
													<a href="#" data-id="<?php echo $row['id']; ?>"  data-name="<?php echo $row['name']; ?>" class="confirm-delete btn" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
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
						<h3 id="modal-deleteLabel">Delete POI</h3>
					</div>
					<div class="modal-body">
						<p>You are about to delete one POI, this procedure is irreversible.</p>
				        <p>Do you want to proceed?</p>
				        <p id="debug-url"></p>
					</div>
					<div class="modal-footer">
						<a href="process.php?what=poi&act=delete&id=" class="btn btn-danger">Yes</a>
				        <a href="#" data-dismiss="modal" class="btn">No</a>
					</div>
				</div>