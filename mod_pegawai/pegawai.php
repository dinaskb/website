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

$aksi="modul/mod_pegawai/aksi_pegawai.php";
switch($_GET[act]){
  // Tampil Agenda
  default:
  
   echo "
   <div id='main-content'>
   <div class='container_12'>
   <div class=grid_12> 
   <br/>
   <a href='?module=pegawai&act=tambahpegawai' class='button'>
   <span>Tambah Pegawai</span>
   </a></div>
   
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>PEGAWAI</h1>
   <span></span> 
   </div>
   <div class='block-content'>
		  
   <table id='table-example' class='table'>	  
	         
   <thead><tr>	  
		  
    <th>No</th>
	<th>Nama Lengkap</th>
	<th>Email</th>
	<th>No Hp</th>
	<th>Alamat</th>
	<th>Aksi</th>
	
   </thead>
   <tbody>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    if ($_SESSION[leveluser]=='admin'){
      $tampil=mysql_query("SELECT * FROM pegawai ");
    }
    else{
      $tampil=mysql_query("SELECT * FROM pegawai 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_pegawai DESC LIMIT $posisi,$batas");
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
    <td width=220>$r[nama_lengkap]</td>
    <td>$r[email]</td>
	<td>$r[nohp]</td>
	<td>$r[alamat]</td>
   

				
    <td width=80>
   
   <a href=?module=pegawai&act=editpegawai&id=$r[username] title='Edit' class='with-tip'>
   <center><img src='img/edit.png'></a>
   
   <a href=javascript:confirmdelete('$aksi?module=pegawai&act=hapus&id=$r[username]') 
   title='Hapus' class='with-tip'>
   &nbsp;&nbsp;&nbsp;&nbsp;<img src='img/hapus.png'></center></a> 
	   
   </td></tr>";		
      $no++;
    }
    echo "</table>";

    if ($_SESSION[leveluser]=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM pegawai"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM pegawai WHERE username='$_SESSION[namauser]'"));
    }  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);


    break;

  
  case "tambahpegawai":
  
   echo "
  <div id='main-content'>
  <div class='container_12'>

  <div class='grid_12'>
  <div class='block-border'>
  <div class='block-header'>
   
  <h1>TAMBAHKAN PEGAWAI</h1>
  </div>
  <div class='block-content'>	
	
  <form method=POST action='$aksi?module=pegawai&act=input' >
     
   <p class=inline-small-label> 
   <label for=field4>Username</label>
  <input type=text name='user' size=60>
   </p>
   <p class=inline-small-label> 
   <label for=field4>Password</label>
  <input type=password name='pass' size=60>
   </p> 		 
   <p class=inline-small-label> 
   <label for=field4>Nama Lengkap</label>
  <input type=text name='nama' size=60>
   </p> 
  	 
   <p class=inline-small-label> 
   <label for=field4>Email</label>
  <input type=text name='email' size=60>
   </p> 		 
   <p class=inline-small-label> 
   <label for=field4>No Hp</label>
  <input type=text name='nohp' size=60>
   </p>  	
   <p class=inline-small-label> 
   <label for=field4>Alamat</label>
  <input type=text name='alamat' size=60>
   </p> 
					 
  	  
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=pegawai'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
   <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
   </li> </ul>
   </form>";
   
    break;
  

  case "editpegawai":
    $edit = mysql_query("SELECT * FROM pegawai WHERE username='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>EDIT PEGAWAI</h1>
   </div>
   <div class='block-content'>	
	
   <form method=POST action='$aksi?module=pegawai&act=update' enctype='multipart/form-data'>
   <input type=hidden name=id value=$r[username]>
		  
   <p class=inline-small-label> 
   <label for=field4>Username</label>
   <input type=text name='user' size=60 value='$r[username]'>
   </p> 	
    <p class=inline-small-label> 
   <label for=field4>Password</label>
   <input type=password name='pass' size=60 value='$r[password]'>
   </p> 
    <p class=inline-small-label> 
   <label for=field4>Email</label>
   <input type=text name='email' size=60 value='$r[email]'>
   </p> 
    <p class=inline-small-label> 
   <label for=field4>No Hp</label>
   <input type=text name='nohp' size=60 value='$r[nohp]'>
   </p> 
   <p class=inline-small-label> 
   <label for=field4>Alamat</label>
   <input type=text name='alamat' size=60 value='$r[alamat]'>
   </p> 
   		  
  
    	
   
   
   
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=pegawai'>Batal</a>
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