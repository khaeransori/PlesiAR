<?php
	session_start();

	if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']) header("Location:index.php");

	include 'include/config.php';
	switch ($_GET['what']) {
		case 'poi':
				switch ($_GET['act']) {
					case 'delete':
							$query_old 		= "SELECT image FROM poi WHERE id = {$_GET['id']} LIMIT 1";
							$result_old 	= mysql_query($query_old);
							$row_old 		= mysql_fetch_array($result_old);
							$image_old 		= "upload/" . $row_old['image'];

							$query 		= "DELETE FROM poi WHERE id = {$_GET['id']} LIMIT 1";
							$result 	= mysql_query($query);

							if ($result) {
								if(file_exists($image_old)) {
			            			@unlink($image_old);
			            		}
								$_SESSION['has_flashdata']	= TRUE;
				            	$_SESSION['class'] 			= 'info';
				            	$_SESSION['msg'] 			= 'Data berhasil dihapus';
							} else {
								$_SESSION['has_flashdata']	= TRUE;
				            	$_SESSION['class'] 			= 'error';
				            	$_SESSION['msg'] 			= 'Data gagal dihapus';
							}
							
							if (isset($_GET['hidden']) || $_GET['hidden']) {
								header("Location:dashboard.php?page=poi&act=hidden");
								exit();
							} else {
								header("Location:dashboard.php?page=poi&act=visible");
								exit();
							}
						break;
					case 'save':
						$name 			= $_POST['name'];
						$description 	= $_POST['desc'];
						$latitude 		= $_POST['lat'];
						$longitude 		= $_POST['lon'];
						$status 	 	= ($_POST['visible'] == 'visible') ? 'visible' : 'hidden';

						if (!empty($_FILES["imagefile"]["tmp_name"])) {
							$folder 	= "upload/"; //tempat menyimpan file

						    $ext 		= $_FILES['imagefile']['type'];
						    if($ext=="image/jpeg" || $ext=="image/jpg" || $ext=="image/gif" || $ext=="image/x-png")
						    {           
						        $path_parts 	= pathinfo($_FILES['imagefile']['name']);
						    	$encrypted_name	= md5(date("Y-m-d H:i:s") . $_FILES['imagefile']['name']);
						    	$new_name 		= $encrypted_name . '.' . $path_parts['extension'];
						        $gambar 		= $folder . $encrypted_name . '.' . $path_parts['extension'];
						        if (move_uploaded_file($_FILES['imagefile']['tmp_name'], $gambar)) {
						            $query 	= "INSERT INTO poi (name, description, latitude, longitude, status, image) values ('$name', '$description', '$latitude', '$longitude', '$status', '$new_name')";
						            
						        } else {
						        	$_SESSION['has_flashdata']	= TRUE;
						        	$_SESSION['class'] 			= 'error';
						        	$_SESSION['msg'] 			= 'Gagal mengunggah gambar';

						        	header("Location:dashboard.php?page=poi&act=add");
						        	exit();
						        }
						   } else {
						   			$_SESSION['has_flashdata']	= TRUE;
						   			$_SESSION['class'] 			= 'error';
						        	$_SESSION['msg'] 			= 'Jenis gambar yang anda kirim salah. Harus .jpg .gif .png';

						        	header("Location:dashboard.php?page=poi&act=add");
						        	exit();
						   }
						} else {
							$query 	= "INSERT INTO poi (name, description, latitude, longitude, status) values ('$name', '$description', '$latitude', '$longitude', '$status')";
						}

						$result = mysql_query($query);

			            if ($result) {
			            	$_SESSION['has_flashdata']	= TRUE;
			            	$_SESSION['class'] 			= 'info';
			            	$_SESSION['msg'] 			= 'Data berhasil ditambahkan';
			            } else {
			            	$_SESSION['has_flashdata']	= TRUE;
			            	$_SESSION['class'] 			= 'error';
			            	$_SESSION['msg'] 			= 'Data gagal ditambahkan';
			            }

			            if($status == 'visible') {
			            	header("Location:dashboard.php?page=poi&act=visible");
			            } else {
							header("Location:dashboard.php?page=poi&act=hidden");
			            }
			            exit();
						break;
					case 'update':
						$id 			= $_GET['id'];
						$name 			= $_POST['name'];
						$description 	= $_POST['desc'];
						$latitude 		= $_POST['lat'];
						$longitude 		= $_POST['lon'];
						$status 	 	= ($_POST['visible'] == 'visible') ? 'visible' : 'hidden';

						$query_old 		= "SELECT image FROM poi WHERE id = '$id' LIMIT 1";
						$result_old 	= mysql_query($query_old);
						$row_old 		= mysql_fetch_array($result_old);
						$image_old 		= "upload/" . $row_old['image'];

						if (!empty($_FILES["imagefile"]["tmp_name"])) {
							$folder 	= "upload/"; //tempat menyimpan file

						    $ext 		= $_FILES['imagefile']['type'];
						    if($ext=="image/jpeg" || $ext=="image/jpg" || $ext=="image/gif" || $ext=="image/x-png")
						    {
						    	$path_parts 	= pathinfo($_FILES['imagefile']['name']);
						    	$encrypted_name	= md5(date("Y-m-d H:i:s") . $_FILES['imagefile']['name']);
						    	$new_name 		= $encrypted_name . '.' . $path_parts['extension'];
						        $gambar 		= $folder . $encrypted_name . '.' . $path_parts['extension'];       
						        if (move_uploaded_file($_FILES['imagefile']['tmp_name'], $gambar)) {
						            $query 	= "UPDATE poi SET name='$name', description='$description', latitude='$latitude', longitude='$longitude', image='$new_name', status='$status' WHERE id = '$id'";
						            
						        } else {
						        	$_SESSION['has_flashdata']	= TRUE;
						        	$_SESSION['class'] 			= 'error';
						        	$_SESSION['msg'] 			= 'Gagal mengunggah gambar';

						        	header("Location:dashboard.php?page=poi&act=edit&id=" . $id);
						        	exit();
						        }
						   } else {
						   			$_SESSION['has_flashdata']	= TRUE;
						   			$_SESSION['class'] 			= 'error';
						        	$_SESSION['msg'] 			= 'Jenis gambar yang anda kirim salah. Harus .jpg .gif .png';

						        	header("Location:dashboard.php?page=poi&act=edit&id=" . $id);
						        	exit();
						   }
						} else {
							$query 	= "UPDATE poi SET name='$name', description='$description', latitude='$latitude', longitude='$longitude', status='$status' WHERE id = '$id'";
						}

						$result = mysql_query($query);

			            if ($result) {
			            	if (!empty($_FILES["imagefile"]["tmp_name"])) {
			            		if(file_exists($image_old)) {
			            			@unlink($image_old);
			            		}
			            	}

			            	
			            	$_SESSION['has_flashdata']	= TRUE;
			            	$_SESSION['class'] 			= 'info';
			            	$_SESSION['msg'] 			= 'Data berhasil diperbarui';
			            } else {
			            	$_SESSION['has_flashdata']	= TRUE;
			            	$_SESSION['class'] 			= 'error';
			            	$_SESSION['msg'] 			= 'Data gagal diperbarui';
			            }

			           	if($status == 'visible') {
			            	header("Location:dashboard.php?page=poi&act=visible");
			            } else {
							header("Location:dashboard.php?page=poi&act=hidden");
			            }
						break;
					default:
						exit();
						break;
				}
			break;
		case 'admin':
			switch ($_GET['act']) {
				case 'delete':
					if ($_SESSION['id'] == $_GET['id']) {
						$_SESSION['has_flashdata']	= TRUE;
		            	$_SESSION['class'] 			= 'error';
		            	$_SESSION['msg'] 			= 'tidak dapat menghapus diri sendiri';
					} else {
						$query_old 		= "SELECT image FROM admin WHERE id = {$_GET['id']} LIMIT 1";
						$result_old 	= mysql_query($query_old);
						$row_old 		= mysql_fetch_array($result_old);
						$image_old 		= "img/admin/" . $row_old['image'];

						$query 		= "DELETE FROM admin WHERE id = {$_GET['id']} LIMIT 1";
						$result 	= mysql_query($query);

						if ($result) {
							if(file_exists($image_old)) {
		            			@unlink($image_old);
		            		}
							$_SESSION['has_flashdata']	= TRUE;
			            	$_SESSION['class'] 			= 'info';
			            	$_SESSION['msg'] 			= 'Data berhasil ditambahkan';
						} else {
							$_SESSION['has_flashdata']	= TRUE;
			            	$_SESSION['class'] 			= 'error';
			            	$_SESSION['msg'] 			= 'Data gagal ditambahkan';
						}
					}
					header("Location:dashboard.php?page=admin&act=front");
					exit();
					break;
				case 'save':
						$name 			= $_POST['name'];
						$user 			= $_POST['user'];
						$pass 			= md5($_POST['pass']);

						$query 		= "SELECT user FROM admin WHERE user = '$user'";
						$result 	= mysql_query($query);
						$count 		= mysql_num_rows($result);

						if ($count > 0) {
							$_SESSION['has_flashdata']	= TRUE;
			            	$_SESSION['class'] 			= 'error';
			            	$_SESSION['msg'] 			= 'Username sudah ada';

			            	header("Location:dashboard.php?page=admin&act=add");
			            	exit();
						} else {
							if (!empty($_FILES["imagefile"]["tmp_name"])) {
								$folder 	= "img/admin/"; //tempat menyimpan file

						    	$ext 		= $_FILES['imagefile']['type'];
						    	if($ext=="image/jpeg" || $ext=="image/jpg" || $ext=="image/gif" || $ext=="image/x-png") {           
							        $path_parts 	= pathinfo($_FILES['imagefile']['name']);
							    	$encrypted_name	= md5(date("Y-m-d H:i:s") . $_FILES['imagefile']['name']);
							    	$new_name 		= $encrypted_name . '.' . $path_parts['extension'];
							        $gambar 		= $folder . $encrypted_name . '.' . $path_parts['extension'];
							        if (move_uploaded_file($_FILES['imagefile']['tmp_name'], $gambar)) {
							            $query 	= "INSERT INTO admin (user, pass, nama, image) values ('$user', '$pass', '$name', '$new_name')";
							            
							        } else {
							        	$_SESSION['has_flashdata']	= TRUE;
							        	$_SESSION['class'] 			= 'error';
							        	$_SESSION['msg'] 			= 'Gagal mengunggah gambar';

							        	header("Location:dashboard.php?page=admin&act=add");
							        	exit();
							        }
						   		} else {
						   			$_SESSION['has_flashdata']	= TRUE;
						   			$_SESSION['class'] 			= 'error';
						        	$_SESSION['msg'] 			= 'Jenis gambar yang anda kirim salah. Harus .jpg .gif .png';

						        	header("Location:dashboard.php?page=admin&act=add");
						        	exit();
						   		}
							} else {
								$query 	= "INSERT INTO admin (user, pass, nama) values ('$user', '$pass', '$name')";
							}

							$result = mysql_query($query);

				            if ($result) {
				            	$_SESSION['has_flashdata']	= TRUE;
				            	$_SESSION['class'] 			= 'info';
				            	$_SESSION['msg'] 			= 'Data berhasil ditambahkan';
				            } else {
				            	$_SESSION['has_flashdata']	= TRUE;
				            	$_SESSION['class'] 			= 'error';
				            	$_SESSION['msg'] 			= 'Data gagal ditambahkan';
				            }

			            	header("Location:dashboard.php?page=admin&act=front");
						    exit();	
						}
						break;
				case 'update':
						$id 			= $_GET['id'];
						$name 			= $_POST['name'];
						$user 			= $_POST['user'];
						$old_pass 		= md5($_POST['old_pass']);
						$pass 			= md5($_POST['pass']);

						$query 		= "SELECT user FROM admin WHERE user = '$user' && $id != '$id'";
						$result 	= mysql_query($query);
						$count 		= mysql_num_rows($result);
						if ($count > 0) {
							$_SESSION['has_flashdata']	= TRUE;
			            	$_SESSION['class'] 			= 'error';
			            	$_SESSION['msg'] 			= 'Username sudah ada';

			            	header("Location:dashboard.php?page=admin&act=edit&id=" . $id);
			            	exit();
						} else {
							if ($_POST['old_pass'] != '') {
								$query 		= "SELECT pass FROM admin WHERE pass = '$old_pass' && id = '$id'";
								$result 	= mysql_query($query);
								$count 		= mysql_num_rows($result);
								if ($count == 0) {
									$_SESSION['has_flashdata']	= TRUE;
					            	$_SESSION['class'] 			= 'error';
					            	$_SESSION['msg'] 			= 'Password lama salah';

					            	header("Location:dashboard.php?page=admin&act=edit&id=" . $id);
					            	exit();
								} else {
									if ($_POST['pass'] == '') {
					            		$_SESSION['has_flashdata']	= TRUE;
						            	$_SESSION['class'] 			= 'error';
						            	$_SESSION['msg'] 			= 'Password baru kosong';

						            	header("Location:dashboard.php?page=admin&act=edit&id=" . $id);
						            	exit();
					            	} else {
					            		$query_addition_pass = ", pass='$pass'";
					            	}
								}
							}

							$query_old 		= "SELECT image FROM admin WHERE id = '$id' LIMIT 1";
							$result_old 	= mysql_query($query_old);
							$row_old 		= mysql_fetch_array($result_old);
							$image_old 		= "img/admin/" . $row_old['image'];

							if (!empty($_FILES["imagefile"]["tmp_name"])) {
								$folder 	= "img/admin/"; //tempat menyimpan file

							    $ext 		= $_FILES['imagefile']['type'];
							    if($ext=="image/jpeg" || $ext=="image/jpg" || $ext=="image/gif" || $ext=="image/x-png")
							    {
							    	$path_parts 	= pathinfo($_FILES['imagefile']['name']);
							    	$encrypted_name	= md5(date("Y-m-d H:i:s") . $_FILES['imagefile']['name']);
							    	$new_name 		= $encrypted_name . '.' . $path_parts['extension'];
							        $gambar 		= $folder . $encrypted_name . '.' . $path_parts['extension'];       
							        if (move_uploaded_file($_FILES['imagefile']['tmp_name'], $gambar)) {
							        	$query_addition = ", image='$new_name'";
							            
							        } else {
							        	$_SESSION['has_flashdata']	= TRUE;
							        	$_SESSION['class'] 			= 'error';
							        	$_SESSION['msg'] 			= 'Gagal mengunggah gambar';

							        	header("Location:dashboard.php?page=admin&act=edit&id=" . $id);
							        	exit();
							        }
							   } else {
						   			$_SESSION['has_flashdata']	= TRUE;
						   			$_SESSION['class'] 			= 'error';
						        	$_SESSION['msg'] 			= 'Jenis gambar yang anda kirim salah. Harus .jpg .gif .png';

						        	header("Location:dashboard.php?page=admin&act=edit&id=" . $id);
						        	exit();
							   }
							}

							$query 	= "UPDATE admin SET nama='$name', user='$user' " . $query_addition_pass . " " . $query_addition . " WHERE id = '$id'";

							$result = mysql_query($query) or die(mysql_error());

				            if ($result) {
				            	if (!empty($_FILES["imagefile"]["tmp_name"])) {
				            		if(file_exists($image_old)) {
				            			@unlink($image_old);
				            		}
				            	}

				            	if ($_SESSION['id'] == $id) {
				            		$_SESSION['user']       = $user;
									$_SESSION['nama']       = $name;
									if ($query_addition != '') {
										$_SESSION['image']  = $new_name;
									}
				            	}
				            	
				            	$_SESSION['has_flashdata']	= TRUE;
				            	$_SESSION['class'] 			= 'info';
				            	$_SESSION['msg'] 			= 'Data berhasil diperbarui';
				            } else {
				            	$_SESSION['has_flashdata']	= TRUE;
				            	$_SESSION['class'] 			= 'error';
				            	$_SESSION['msg'] 			= 'Data gagal diperbarui';
				            }

				            header("Location:dashboard.php?page=admin&act=front");
						}
						break;
				default:
					# code...
					break;
			}
			break;
		default:
			# code...
			break;
	}