<?php
	require_once ('../config.php');
	date_default_timezone_set('Asia/Jakarta');

	if (isset($_POST['btn_selesai']))
	{
    $nama = isset($_POST['txt_nama']) ? $_POST['txt_nama'] : '';
    $emailaddress = isset($_POST['txt_email']) ? $_POST['txt_email'] : '';
    $nomor = isset($_POST['txt_nomor']) ? $_POST['txt_nomor'] : '';
    $modifiedon = date('Y-m-d H:i:s');
    $id = $_POST['id'];

		$update = "UPDATE tb_account SET nama='$nama', email='$emailaddress', nomor='$nomor', modified_on='$modifiedon' WHERE id='$id'";
		$ubah = mysqli_query($conn, $update);
				
		if ($ubah && isset($_FILES['img_file']['name'])) {
			$filename = $_FILES['img_file']['name'];											
			$imageFileType = pathinfo('../assets/img/profile'.$filename, PATHINFO_EXTENSION);
			$imageFileType = strtolower($imageFileType);
			
			/* Valid extensions */
			$valid_extensions = array('jpg','jpeg','png');
			
			if ($filename != '') {
				/* Check file extension */
				if (in_array($imageFileType, $valid_extensions)) {
					move_uploaded_file($_FILES['img_file']['tmp_name'], "../assets/img/profile/".$_FILES['img_file']['name']);
					$filename = $_FILES['img_file']['name'];
					$update = "UPDATE tb_account SET path='$filename' WHERE id='$id'";
					$ubah = mysqli_query($conn, $update);
					echo"<script>alert('Profile berhasil diubah.');window.location='./'</script>";
				} 
				else 
				{
					echo"<script>alert('Gambar gagal diupload. Pastikan ekstensi yang diupload .jpg, .jpeg, atau .png');window.location='./'</script>";
				}
			}
			else {
				echo "<script>alert('Profile berhasil diubah.');window.location='./'</script>";
			}
		}
		elseif ($ubah && !isset($_FILES['img_file']['name'])) echo "<script>alert('Profile berhasil diubah.');window.location='./'</script>";
	}
	elseif (isset($_POST['btn_batal'])) 
	{
		echo"<script>window.location='./'</script>";
	}
?>
