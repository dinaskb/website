 
  <?php
  if ($_GET['module']=='home'){?>

  <!------------------ MULAI HALAMAN HOME -------------------->
  <div class="main-column-wrapper">
  <div class="main-column-left">

  <div class="tanggal"><script src="<?php echo "./layout/hijau/js/almanak.js" ?>" type="text/javascript"></script>
   &nbsp;&nbsp;<span class="style2">I</span>&nbsp;&nbsp;
  <script src="<?php echo "./layout/hijau/js/selamat.js" ?>" type="text/javascript"></script>
   </div>
  <!------------------  HEADLINE -------------------->
  <div id="lofslidecontent45" class="lof-slidecontent lof-snleft">
  <div class="preload"><div></div></div>
  
  <div class="lof-main-outer">
  <ul class="lof-main-wapper">
  
  <?php
  $terkini=mysql_query("SELECT * FROM berita WHERE headline='Y' ORDER BY id_berita DESC LIMIT 5");
  $no=1;
  while($t=mysql_fetch_array($terkini)){      
                
  $isi_berita = strip_tags($t['isi_berita']); 
  $isi = substr($isi_berita,0,150); 
  $isi = substr($isi_berita,0,strrpos($isi," ")); 
       	    
  echo "<li><img src=foto_berita/$t[gambar] height='300' width='357'/>

  <div class='lof-main-item-desc2'><img src=./layout/hijau/images/bg_headline.png width='360' height='300'>

  <div class='lof-main-item-desc'>
  <h3><a href='media.php?module=detailberita&judul=$t[id_berita]'>$t[judul]</a></h3>
  <p>$isi ...<a href=media.php?module=detailberita&judul=$t[id_berita]>
  <span class=lengkap>[selengkapnya]</span></a></p>
  </div>
  </li>"; 
  
  $no++;} 
  ?>
  
  </ul>
  </div>          
          
  <div class="lof-navigator-outer">
  <ul class="lof-navigator">
            
  <?php
  $terkini2=mysql_query("SELECT * FROM berita WHERE headline='Y' ORDER BY id_berita DESC LIMIT 5");
  $no=1;
  while($t=mysql_fetch_array($terkini2)){      
  $tgl = tgl_indo($t[tanggal]);

  $isi_berita = strip_tags($t['isi_berita']); 
  $isi = substr($isi_berita,0,120); 
  $isi = substr($isi_berita,0,strrpos($isi," ")); 

  echo "<li><div><h3>$t[judul]</h3><p>$t[hari], $tgl</p></div></li>";
  $no++;} 
  ?>
  </ul>
  </div></div>
  <img src=<?php echo "./layout/hijau/images/shadow.jpg" ?> width="557" />
  <!---------------------- AKHIR HEADLINE -------------------------->		
  

  <!---------------- BERITA UTAMA ------------------------>
  <div class="blog-style-1">
  <div class="post-title">
  <b>BERITA TERKINI </b>
  </div>
 
  
  <?php    
  $terkini=mysql_query("SELECT * FROM berita WHERE utama='Y' ORDER BY id_berita DESC LIMIT 7");
  while($t=mysql_fetch_array($terkini)){
  $tgl = tgl_indo($t['tanggal']);
  $baca = $t[dibaca]+1;		
  
  $komentar = "SELECT * FROM komentar WHERE id_berita = '".$t['id_berita']."'";
  $zalkomentar = mysql_query($komentar);
  $total_komentar = mysql_num_rows($zalkomentar);
  
  echo "<div class='item'>
  <div class='sub_judul1'>$t[sub_judul]</div>
  <h2><a href=media.php?module=detailberita&judul=$t[id_berita]>$t[judul]</a></h2>
  <div class='info'> <span class='date'>$t[hari], $tgl - $t[jam] WIB <span class style=\"color:#EA1C1C;\">|</span> 
  dibaca: $baca pembaca <span class style=\"color:#EA1C1C;\">|</span> komentar: $total_komentar</span></div>";
  
  if ($t['gambar']!=''){
  
  echo " <a href=berita-$t[judul_seo].html>
  <div class='crop'><p><img src='foto_berita/small_$t[gambar]' ></p></div></a>";}
  
  $isi_berita =(strip_tags($t['isi_berita']));
  $isi = substr($isi_berita,0,300); 
  $isi = substr($isi_berita,0,strrpos($isi," ")); 
  
  echo "<p>$isi ... 
  <a href=media.php?module=detailberita&judul=$t[id_berita] class='more-link'>[selengkapnya]</a></p>
  </div>";}
  ?>
  </div><br />
  <!---------------- AKHIR BERITA UTAMA ------------------------>
 
 
  <!------------------------ PILIHAN REDAKSI ------------------------------>
  <div class="post-title"><b>BERITA PILIHAN</b></div>
  <div class="photo-gallery">
  <div class="row">
  <div class="infiniteCarousel">
  <div class="wrapper">
  <ul>
  <?php            
  $terkini=mysql_query("SELECT * FROM berita 
  WHERE aktif='Y' ORDER BY id_berita DESC LIMIT 8");
  while($t=mysql_fetch_array($terkini)){
  $tgl = tgl_indo($t['tanggal']);
					
  if ($t['gambar']!=''){
					
  echo "<li><div class='index-item'>
  <a href=media.php?module=detailberita&judul=$t[id_berita]>
  <img src='foto_berita/small_$t[gambar]' width=119 height=100 border=0 >
  </a>";}
 
  $isi_berita =(strip_tags($t['isi_berita'])); 
  $isi = substr($isi_berita,0,200); 
  $isi = substr($isi_berita,0,strrpos($isi," ")); 

  echo "<a href=media.php?module=detailberita&judul=$t[id_berita] class='tooltip' title='$isi...<br/> 
  <span class=tanggal03>$t[hari], $tgl</span>'><span class=judultopik>$t[judul]</span></a>
  </div></li>";} 
  ?>
				
  </ul>        
  </div>
  </div>	
  </div></div>
  <!------------------------ AKHIR PILIHAN REDAKSI ------------------------------>
				
 
  <!------------------------ AKHIR IKLAN TENGAH #2 ------------------------------>
  
  <div class="archive">
  <div class="row">

	
  <!------------------------ KOLOM BERITA ------------------------------>
   <!------------------------ AKHIR KOLOM BERITA ------------------------------>
	
  </div>
  </div>
  </div>
  </div>
	

  <!--============================= BAGIAN KANAN ==================================--->
 
 <div class="sidebar">						
 <!------------- TABS BERITA -------------------->
  <div class="sidebar-item">
  <div class="photo-gallery-widget">
  <div class="sidebar-title"><b>Sambutan </b></div>
  <b>Kepala Dinas P3AP2KB</b><br>
  <div class="photos">
    <img width="140" height="150" src="foto_sambutan/kadiis.JPEG" />
      Assalamu'alaikum wr.wb
      
      <br>
      Selamat datang di Website resmi Dinas P3AP2KB Kab. Padang Lawas Utara. Puji Syukur kepada Allah SWT, atas karunia dan hidayahNya Website Dinas P3AP2KB Kab. Padang Lawas Utara bisa terealisasi dan dapat diakses oleh masyarakat luas.<br><br>
    
    <div class="sidebar-title"><b>Sambutan</b></div>
   <div class="photos"> <p><b>Sekretaris</b></p>
  <img width="150"  src="foto_sambutan/sekretaris.JPEG" />
  <div class="photos"> <p><b>Kasubbag. Umum dan Kepegawaian</b></p>
  <img width="140"  src="foto_sambutan/kasubbag.JPEG" />
 
   </div>
  </div>
  </div>
  <br><br>
  <div class="latest-activity">
								
  <!-- TAB JUDUL -->
  <div class="tabs-1">
  <table><tr>
  
  <td><a href="#" class="tab-1 kernel_triple_btn active" id="kernel_triple_popular_btn_kernel_3">
  <span>Terpopuler</span></a></td>
  
  <td><a href="#" class="tab-1 tab-1-disabled kernel_triple_btn" id="kernel_triple_recent_btn_kernel_3">
  <span>Terkini</span></a></td>
  
  <td><a href="#" class="tab-1 tab-1-disabled kernel_triple_btn" id="kernel_triple_comments_btn_kernel_3">
  <span>Komentar</span></a></td>
  
  </tr></table>
  </div>
  <!-- AKHIR TAB JUDUL -->	
									
   <!-- BAGIAN POPULER -->								
 
  <div id="kernel_triple_popular_kernel_3">
  <div class="list">
  <?php
  /* Berita Terpopuler dalam Seminggu     
  $hari_ini=date("Ymd");
  $sebelum=mktime(0, 0, 0, date("m"), date("d") - 7, date("Y"));    
  $tgl_sebelumnya=date("Ymd", $sebelum);

  $sql=mysql_query("SELECT * FROM berita WHERE tanggal BETWEEN '$tgl_sebelumnya' AND '$hari_ini' 
  ORDER BY dibaca DESC LIMIT 5"); 
  */
  
  $sql=mysql_query("SELECT * FROM berita ORDER BY dibaca DESC LIMIT 5");  
  
  while($p=mysql_fetch_array($sql)){
  
  echo "
  <div class='item'>
  <div class='image'>
  <a href=media.php?module=detailberita&judul=$p[id_berita]>
  <img src='foto_berita/small_$p[gambar]' width=60 height=50 border=0></a>
  </div>";
  
  echo "<div class='text'>
  <a href=media.php?module=detailberita&judul=$p[id_berita]><span class='judulberita1'>$p[judul]</span></a>
  <p><span class='tanggal01'><span> dibaca : $p[dibaca] pembaca</span></p></div>
  </div>";
  }
  ?>
  </div>
  </div>	
  <!-- AKHIR BAGIAN POPULER -->								
								

  <!-- BAGIAN TERKINI -->	
   <div id="kernel_triple_recent_kernel_3" style="display: none;">
  <div class="list">
  <?php    
  $terkini=mysql_query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 5");
  while($t=mysql_fetch_array($terkini)){
  $tgl = tgl_indo($t['tanggal']);
  $isi_berita = strip_tags($t['isi_berita']); 
  $isi = substr($isi_berita,0,150); 
  $isi = substr($isi_berita,0,strrpos($isi," ")); 
  
  echo "
  <div class='item'>
  <div class='image'>
  <a href=media.php?module=detailberita&judul=$t[id_berita]>
  <img src='foto_berita/small_$t[gambar]' width=60 height=50 border=0></a>
  </div>";
  
  echo "<div class='text'>
  <a href=media.php?module=detailberita&judul=$t[id_berita]><span class='judulberita1'>$t[judul]</span></a>
  <p><span class='tanggal01'><span> $t[hari], $tgl</span></p></div>
  </div>";}
  ?>
  </div>
  </div>	
  <!-- AKHIR BAGIAN TERKINI -->	

 
 
  
  <br>
  <!------------- AGENDA HARI INI  -------------------->
  <div class="sidebar-item">
  <div class="latest-news">
  <div class="sidebar-title"><b>AGENDA</b></div>
  <div class="list">
  
  <div id="test-widget" class="widget">
  <div class="nav">
  <span id="prev_test"></span>
  <span id="next_test"></span></div>
  <ul>
						  
  <?php    
  $agenda=mysql_query("SELECT * FROM agenda ORDER BY rand() DESC LIMIT 6");
  while($a=mysql_fetch_array($agenda)){
  $tgl_mulai = tgl_indo($a[tgl_mulai]);
  
  $isi_agenda = strip_tags($a['isi_agenda']);
  $isi = substr($isi_agenda,0,150);
  $isi = substr($isi_agenda,0,strrpos($isi," ")); 
  
  echo "							  
  <li><p><span class='tanggal02'><span>$tgl_mulai </span></p>
  <a href='media.php?module=semuaagenda'><b>$a[tema]</b></a>
  <p>'$isi ...'</p>
  </li>";}
  ?>
  
  </ul></div></div>
  </div></div>
  
  <!------------- AKHIR AGENDA HARI INI  -------------------->
 
  <div class="sidebar-item">
  <div class="latest-news">
  <div class="sidebar-title"><b>PENGUMUMAN</b></div>
  <div class="list">
  
  <div id="test-widget" class="widget">
  <div class="nav">
  <span id="prev_test"></span>
  <span id="next_test"></span></div>
  <ul>
						
  
  <?php    
  $pengumuman=mysql_query("SELECT * FROM pengumuman ORDER BY rand() DESC LIMIT 6");
  while($a=mysql_fetch_array($pengumuman)){
  $tgl_post = tgl_indo($a[tgl_posting]);

  echo "							  
  <li><p><span class='tanggal02'><span>$tgl_post</span></p>
  <a href='media.php?module=pengumuman'><b>$a[judul]</b></a>
  
  </li>";}
  ?>
  
  </ul></div></div>
  </div></div>
  
  <!------------- AKHIR PENGUMUMAN HARI INI  -------------------->




 
  
  <div class="sidebar-item">
  <div class="photo-gallery-widget">
  <div class="sidebar-title"><b>Link Terkait</b></div>
  <div class="photos">
  <?php

  echo "<a href='https://dinkes.padanglawasutarakab.go.id/' 'target='_blank' >
  <img width=250 src='foto_sambutan/dinkes.JPEG' border=0></a>";
   echo "<a href='https://padanglawasutarakab.go.id/' 'target='_blank' >
  <img width=250 src='foto_sambutan/ktr.JPEG' border=0></a>";
  
  ?>
  </div>
  </div>
  </div>
 
  
  </div>
   
  </div>
  </div>
  
  <!------------------ TUTUP HALAMAN HOME -------------------->


  <?php 
  }
  // DETAIL BERITA////////////////////////////////////////////
  elseif ($_GET['module']=='detailberita'){
  include "./layout/hijau/modul/mod_berita/detailberita.php";}
  ////////////////////////////////////////////////////////////

  // KATEGORI BERITA ////////////////////////////////////////////
  elseif ($_GET['module']=='detailkategori'){
  include "./layout/hijau/modul/mod_berita/detailkategori.php";}
  ////////////////////////////////////////////////////////////
  
  // CARI BERITA ////////////////////////////////////////////
  elseif ($_GET['module']=='hasilcari'){
  include "./layout/hijau/modul/mod_berita/hasilcari.php";}
  ////////////////////////////////////////////////////////////

  // SEMUA BERITA ////////////////////////////////////////////
  elseif ($_GET['module']=='semuaberita'){
  include "./layout/hijau/modul/mod_berita/semuaberita.php";}
  ////////////////////////////////////////////////////////////


  // DETAIL AGENDA ////////////////////////////////////////////
  elseif ($_GET['module']=='detailagenda'){
  include "./layout/hijau/modul/mod_agenda/detailagenda.php";}
  elseif ($_GET['module']=='login'){
  include "login.php";}
   elseif ($_GET['module']=='agenda_rapat'){
  include "./layout/hijau/modul/mod_agenda/agenda_rapat.php";}
   elseif ($_GET['module']=='pengumuman_internal'){
  include "./layout/hijau/modul/mod_pengumuman/pengumuman_internal.php";}
   elseif ($_GET['module']=='lakip'){
  include "./layout/hijau/modul/mod_lakip/lakip.php";}
  /////////////////////////////////////////////////////////////
  
  // SEMUA AGENDA ////////////////////////////////////////////
  elseif ($_GET['module']=='semuaagenda'){
  include "./layout/hijau/modul/mod_agenda/semuaagenda.php";}
  /////////////////////////////////////////////////////////////
  
 
    elseif ($_GET['module']=='berita'){
  include "berita.php"; }  
  /////////////////////////////////////////////////////////////
  

 
  /////////////////////////////////////////////////////////////
  

 
  
  elseif ($_GET['module']=='pengumuman'){
  include "./layout/hijau/modul/mod_pengumuman/semuapengumuman.php";}
  /////////////////////////////////////////////////////////////
 


  
   elseif ($_GET['module']=='visi'){
  include "visi.php";}
   elseif ($_GET['module']=='kontak'){
  include "kontak.php";}
  elseif ($_GET['module']=='gallery'){
  include "gallery.php";}
  
  elseif ($_GET['module']=='sejarah'){
  include "sejarah.php";}
  
  elseif ($_GET['module']=='struktur'){
  include "struktur.php";}
 /////////////////////////////////////////////////////////////

 

  // DETAIL HALAMAN ERROR ////////////////////////////////////////////
 elseif ($_GET['module']=='notfound'){
  include "./layout/hijau/modul/404/404.php";}
  /////////////////////////////////////////////////////////////
 


  ?>      
