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

if ($module=='lakip' AND $act=='hapus'){
  
 
  
  mysql_query("DELETE FROM lakip WHERE id_lakip='$_GET[id]'");  
  
  header('location:../../media.php?module='.$module);
}

// Input agenda
elseif ($module=='lakip' AND $act=='input'){
  
    
    mysql_query("INSERT INTO lakip(indikator_kinerja,capaian_sblm,target,
                                  
                                  realisasi,
                                 
                                  nilai,
                                  kategori,
                                   
                                  target_akhir,capaian_akhir) 
					                VALUES('$_POST[indikator]','$_POST[capaian]','$_POST[target]',
					                       
                                 '$_POST[realisasi]','$_POST[nilai]','$_POST[kategori]','$_POST[target]','$_POST[capaian_akhir]'                                                                  )");
  header('location:../../media.php?module='.$module);
  
}


// Update agenda
elseif ($module=='lakip' AND $act=='update'){

  mysql_query("UPDATE lakip SET indikator_kinerja        = '$_POST[indikator]',
                                
                                 capaian_sblm  = '$_POST[capaian]',
								 target  = '$_POST[target]',
								 realisasi  = '$_POST[realisasi]',
								 nilai  = '$_POST[nilai]',
								 kategori  ='$_POST[kategori]',
								 target_akhir  = '$_POST[target]',
								 capaian_akhir  = '$_POST[capaian_akhir]'
                                
                           WHERE id_lakip   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
}
?>
