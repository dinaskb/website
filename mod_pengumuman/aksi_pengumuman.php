<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='pengumuman' AND $act=='hapus'){
  
 
  
  mysql_query("DELETE FROM pengumuman WHERE id_pengumuman='$_GET[id]'");  
  
  header('location:../../media.php?module='.$module);
}

// Input agenda
elseif ($module=='pengumuman' AND $act=='input'){
 
  
  $nama_file=$_FILES['gambar']['name'];
		$path=$_FILES['gambar']['tmp_name'];
		$destination="../../../img_galeri/$nama_file ";
		move_uploaded_file($path,$destination);

  // Apabila ada gambar yang diupload
  
    
    mysql_query("INSERT INTO pengumuman(id_kategori,jenis_pengumuman,judul,
                                  
                                  isi_pengumuman,
                                 
                                  file,
                                  tgl_posting,
                                   
                                  username) 
					                VALUES('$_POST[kategori]','$_POST[jenis]','$_POST[tema]',
					                       
                                 '$_POST[isi_pengumuman]',
                                 '$nama_file',
                                 
                                 NOW(),
                                                                  '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
  
}


// Update agenda
elseif ($module=='pengumuman' AND $act=='update'){

  mysql_query("UPDATE pengumuman SET judul        = '$_POST[tema]',
                                
                                 isi_pengumuman  = '$_POST[isi_pengumuman]'
                                
                           WHERE id_pengumuman   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
}
?>
