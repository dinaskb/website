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

// Hapus agenda
if ($module=='pegawai' AND $act=='hapus'){
  
 
  
  mysql_query("DELETE FROM pegawai WHERE username='$_GET[id]'");  
  
  header('location:../../media.php?module='.$module);
}

// Input agenda
elseif ($module=='pegawai' AND $act=='input'){
  

  // Apabila ada gambar yang diupload
  
    
    mysql_query("INSERT INTO pegawai(username,password,nama_lengkap,
                                  
                                  level,
                                  email,
                                  
                                  nohp,
                                   
                                  alamat) 
					                VALUES('$_POST[user]','$_POST[pass]','$_POST[nama]',
					                       
                                 'pegawai',
                                 '$_POST[email]','$_POST[nohp]','$_POST[alamat]')");
  header('location:../../media.php?module='.$module);
  
}

// Update agenda
elseif ($module=='pegawai' AND $act=='update'){
  
 
 


  // Apabila gambar tidak diganti
  
  mysql_query("UPDATE pegawai SET 
                                 
                                 password  = '$_POST[pass]',
                                 email   = '$_POST[email]',
                                 nohp   = '$_POST[nohp]',
                                 alamat     = '$_POST[alamat]' 
                                
                           WHERE username   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
 
  
}
}
?>
