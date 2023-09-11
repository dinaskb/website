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

$aksi="modul/mod_pengumuman/aksi_pengumuman.php";
switch($_GET[act]){
  // Tampil Agenda
  default:
  
   echo "
   <div id='main-content'>
   <div class='container_12'>
   <div class=grid_12> 
   <br/>
   <a href='?module=pengumuman&act=tambahpengumuman' class='button'>
   <span>Tambah Pengumuman</span>
   </a></div>
   
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>PENGUMUMAN</h1>
   <span></span> 
   </div>
   <div class='block-content'>
		  
   <table id='table-example' class='table'>	  
	         
   <thead><tr>	  
		  
    <th>No</th>
	<th>Judul</th>
	<th>Isi</th>
	<th>Jenis Pengumuman</th>
	
	<th>Aksi</th>
	
   </thead>
   <tbody>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    if ($_SESSION[leveluser]=='admin'){
      $tampil=mysql_query("SELECT * FROM pengumuman ORDER BY id_pengumuman DESC");
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
   <td width=50><center>$g</center></td>
    <td width=220>$r[judul]</td>
    <td>$r[isi_pengumuman]</td>
   <td>$r[jenis_pengumuman]</td>

				
    <td width=80>
   
   <a href=?module=pengumuman&act=editpengumuman&id=$r[id_pengumuman] title='Edit' class='with-tip'>
   <center><img src='img/edit.png'></a>
   
   <a href=javascript:confirmdelete('$aksi?module=pengumuman&act=hapus&id=$r[id_pengumuman]') 
   title='Hapus' class='with-tip'>
   &nbsp;&nbsp;&nbsp;&nbsp;<img src='img/hapus.png'></center></a> 
	   
   </td></tr>";		
      $no++;
    }
    echo "</table>";

    if ($_SESSION[leveluser]=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM pengumuman"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM pengumuman WHERE username='$_SESSION[namauser]'"));
    }  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);


    break;

  
  case "tambahpengumuman":
  
   echo "
  <div id='main-content'>
  <div class='container_12'>

  <div class='grid_12'>
  <div class='block-border'>
  <div class='block-header'>
   
  <h1>TAMBAHKAN PENGUMUMAN</h1>
  </div>
  <div class='block-content'>	
	
  <form method=POST action='$aksi?module=pengumuman&act=input' enctype='multipart/form-data'>
     
   <p class=inline-small-label> 
   <label for=field4>Judul</label>
  <input type=text name='tema' size=60>
   </p> 		 
   
   <p class=inline-small-label> 
   <label for=field4>Isi Pengumuman</label>
  <textarea name='isi_pengumuman' style='width: 720px; height: 350px;'></textarea>
   </p> 		 
   
   <p class=inline-small-label> 
   <label for=field4>File</label>
   <input type=file name='gambar'>
   </p> 		 
   		  	
  			 </p> 
     		    <p class=inline-small-label> 
   <label for=field4>Kategori</label>
  <select name='kategori'>
   <option value=0 selected>Pilih Kategori</option>";
   $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
   while($r=mysql_fetch_array($tampil)){
   echo "<option value=$r[id_kategori]>$r[nama_kategori]</option></p>";}
   
   echo"</select>
   </p> 
    <p class=inline-small-label> 
   <label for=field4>Jenis Pengumuman</label>
  <select name='jenis'><option>--Pilih--</option>
  <option value='Umum'>Umum</option>
  <option value='Khusus'>Khusus</option></select>
   </p> 
					 
  	  
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=pengumuman'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
   <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
   </li> </ul>
   </form>";
   
    break;
  

  case "editpengumuman":
    $edit = mysql_query("SELECT * FROM pengumuman WHERE id_pengumuman='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>EDIT PENGUMUMAN</h1>
   </div>
   <div class='block-content'>	
	
   <form method=POST action='$aksi?module=pengumuman&act=update' enctype='multipart/form-data'>
   <input type=hidden name=id value=$r[id_pengumuman]>
		  
   <p class=inline-small-label> 
   <label for=field4>Judul</label>
   <input type=text name='tema' size=60 value='$r[judul]'>
   </p> 	
   
   		  
   <p class=inline-small-label> 
   <label for=field4>Isi Pengumuman</label>
  <textarea name='isi_pengumuman' style='width: 720px; height: 350px;'>$r[isi_pengumuman]</textarea>
   </p> 	
   
    	
   
   <p class=inline-small-label> 
   <label for=field4>Ganti Gambar</label>
  <input type=file name='fupload' size=30>
   </p> 
		  
   </p>  <p class=inline-small-label> 
   <label for=field4>Jenis Pengumuman</label>
   <input type=text name='jenis' size=40 value='$r[jenis_pengumuman]'>
   </p>
     		    <p class=inline-small-label> 
   <label for=field4>Kategori</label>
  <select name='kategori'>
   <option value=0 selected>Pilih Kategori</option>";
   $tampil=mysql_query("SELECT * FROM kategori where id_kategori=$r[id_kategori]");
   while($r=mysql_fetch_array($tampil)){
   echo "<option value=$r[id_kategori] selected>$r[nama_kategori]</option></p>";}
   
   echo"</select>
   </p> 
   
   
      
  
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=pengumuman'>Batal</a>
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