<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "
  <link href='css/zalstyle.css' rel='stylesheet' type='text/css'>";

  echo "
  </head>
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  
  <img src='img/lock.png'>
  <h1>MODUL TIDAK DAPAT DIAKSES</h1>
  
  <p><span class style=\"font-size:14px; color:#ccc;\">Untuk mengakses modul, Anda harus login dahulu!</p></span><br/>
  
  </section>
  
  <section id='error-text'>
  <p><a class='button' href='index.php'>&nbsp;&nbsp; <b>ULANGI LAGI</b> &nbsp;&nbsp;</a></p>
  </section>
  </div>";
}
else{

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){

$aksi="modul/mod_lakip/aksi_lakip.php";
switch($_GET[act]){
  
  default:
  
   echo "
   <div id='main-content'>
   <div class='container_12'>
   <div class=grid_12> 
   <br/>
   <a href='?module=lakip&act=tambahlakip' class='button'>
   <span>Tambah Data</span>
   </a></div>
   
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>DATA LAKIP</h1>
   <span></span> 
   </div>
   <div class='block-content'>
		  
   <table id='table-example' class='table'>	  
	         
   <thead><tr>	  
		  
    <th>No</th>
	<th>Indikator Kinerja</th>
	<th>Capaian Sebelumnya (ton) </th>
	<th>Target %</th>
	<th>Realisasi (ton)</th>
	<th>Nilai Capaian (ton)</th>
	<th>Kategori</th>
	<th>Target Akhir</th>
	<th>Capaian Akhir %</th>
	<th>Aksi</th>
	
   </thead>
   <tbody>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    if ($_SESSION[leveluser]=='admin'){
      $tampil=mysql_query("SELECT * FROM lakip ORDER BY id_lakip DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM pengumuman 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_pengumuman DESC LIMIT $posisi,$batas");
    }

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl_mulai   = tgl_indo($r[tgl_mulai]);
      $tgl_selesai = tgl_indo($r[tgl_selesai]);

    $lebar=strlen($no);
    switch($lebar){
      case 1:
      {
        $g="0".$no;
        break;     
      }
      case 2:
      {
        $g=$no;
        break;     
      }      
    } 
    
   echo "<tr class=gradeX>
   <td ><center>$g</center></td>
    <td >$r[indikator_kinerja]</td>
	<td >".number_format($r[capaian_sblm])."</td>
	<td >".number_format($r[target])."</td>
    <td>".number_format($r[realisasi])."</td>
	<td>$r[nilai]</td>
	<td>$r[kategori]</td>
	<td>".number_format($r[target_akhir])."</td>
	<td>$r[capaian_akhir]</td>
   

				
    <td width=80>
   
   <a href=?module=lakip&act=editlakip&id=$r[id_lakip] title='Edit' class='with-tip'>
   <center><img src='img/edit.png'></a>
   
   <a href=javascript:confirmdelete('$aksi?module=lakip&act=hapus&id=$r[id_lakip]') 
   title='Hapus' class='with-tip'>
   &nbsp;&nbsp;&nbsp;&nbsp;<img src='img/hapus.png'></center></a> 
	   
   </td></tr>";		
      $no++;
    }
    echo "</table>";

    if ($_SESSION[leveluser]=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM lakip"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM pengumuman WHERE username='$_SESSION[namauser]'"));
    }  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);


    break;

  
  case "tambahlakip":
  
   echo "
  <div id='main-content'>
  <div class='container_12'>

  <div class='grid_12'>
  <div class='block-border'>
  <div class='block-header'>
   
  <h1>TAMBAHKAN DATA LAKIP</h1>
  </div>
  <div class='block-content'>	
	
  <form method=POST action='$aksi?module=lakip&act=input'>
     
   <p class=inline-small-label> 
   <label for=field4>Indikator Kinerja</label>
  <input type=text name='indikator' size=60>
   </p> 		 
   
   <p class=inline-small-label> 
   <label for=field4>Capaian Sebelumnya</label>
  <input type=text name='capaian' size=60>
   </p> 
   <p class=inline-small-label> 
   <label for=field4>Target</label>
  <input type=text name='target' size=60>
   </p> 	
   <p class=inline-small-label> 
   <label for=field4>Realisasi</label>
  <input type=text name='realisasi' size=60>
   </p> 	 
   <p class=inline-small-label> 
   <label for=field4>Nilai</label>
  <input type=text name='nilai' size=60>
   </p> 
   
  		 
   		  	
  			 
     		    <p class=inline-small-label> 
   <label for=field4>Kategori</label>
  <select name='kategori'>
   <option value=0 selected>Pilih Kategori</option>";
   $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
   while($r=mysql_fetch_array($tampil)){
   echo "<option value=$r[nama_kategori]>$r[nama_kategori]</option></p>";}
   
   echo"</select>
   </p> 
    <p class=inline-small-label> 
   <label for=field4>Target Akhir</label>
  <input type=text name='target' size=60>
   </p> 
			<p class=inline-small-label> 
   <label for=field4>Capaian Akhir</label>
  <input type=text name='capaian_akhir' size=60>
   </p> 		 
  	  
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=lakip'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
   <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
   </li> </ul>
   </form>";
   
    break;
  

  case "editlakip":
    $edit = mysql_query("SELECT * FROM lakip WHERE id_lakip='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>EDIT LAKIP</h1>
   </div>
   <div class='block-content'>	
	
   <form method=POST action='$aksi?module=lakip&act=update' enctype='multipart/form-data'>
   <input type=hidden name=id value=$r[id_lakip]>
		  
   <p class=inline-small-label> 
   <label for=field4>Indikator Kinerja</label>
   <input type=text name='indikator' size=60 value='$r[indikator_kinerja]'>
   </p> 	
   
   		  
   <p class=inline-small-label> 
   <label for=field4>Capaian Sebelumnya</label>
  <input type=text name='capaian' size=60 value='$r[capaian_sblm]'>
   </p> 	
   
    	
   
    <p class=inline-small-label> 
   <label for=field4>Target</label>
  <input type=text name='target' size=60 value='$r[target]'>
   </p> 
		  
		   <p class=inline-small-label> 
   <label for=field4>Realisasi</label>
  <input type=text name='realisasi' size=60 value='$r[realisasi]'>
   </p> 
    <p class=inline-small-label> 
   <label for=field4>Nilai</label>
  <input type=text name='nilai' size=60 value='$r[nilai]'>
   </p> 
   
     		    <p class=inline-small-label> 
   <label for=field4>Kategori</label>
   <input type=text name='kategori' size=60 value='$r[kategori]'>
   </p> 
   
    <p class=inline-small-label> 
   <label for=field4>Target Akhir</label>
  <input type=text name='target' size=60 value='$r[target_akhir]'>
   </p> 
       <p class=inline-small-label> 
   <label for=field4>Capaian Akhir</label>
  <input type=text name='capaian_akhir' size=60 value='$r[capaian_akhir]'>
   </p> 
  
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=lakip'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
   <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
   </li> </ul>
   </form>";
   
   
   
    break;
	
   }
    //kurawal akhir hak akses module
    } else {
	echo akses_salah();
    }
    }
    ?>

   </div> 
   </div>
   </div>
   <div class='clear height-fix'></div> 
   </div></div>