 <?php
 include "tglindo.php";
 ?>
  <div class='main-column-wrapper'>
  <div class='main-column-left'>
  
 <div class='blog-style-1'>
  <div class='post-title'>
  <b>Pengumuman Dinas P3AP2KB</b>
  </div> 
  

 <table id='theList' border=1 width='100%' class='table table-bordered table-striped'>
<tr><th width="10%" bgcolor="#999999"><span class="style3">No.</span></th>
<th bgcolor="#999999"><span class="style3">Tanggal Post</span></th>
<th bgcolor="#999999"><span class="style3">Judul</span></th>

<th width="22%" bgcolor="#999999"><span class="style3">Download File</span></th>




</tr>
<?php
$sql = mysql_query("select * from pengumuman where jenis_pengumuman='Umum' order by id_pengumuman desc");
$no=1;
while($r = mysql_fetch_array($sql)){

?>
<tr>
  <td class='td' align='center'><?=$no++?></td>
  <td class='td' width='26%' align='center'><?=TanggalIndo($r['tgl_posting'])?></td>
  <td class='td' width='42%' a><?=$r['judul']?></td>

<td class='td' align="center"><span class="style3"><a href='./img_galeri/<?=$r['file']?>'>Download</a> </td>



</tr>
<?php
$no++;
  }?>
</table>
  </div>            
  


  </div>


 <div class="sidebar">
  
 <!------------- TABS BERITA -------------------->
  <div class="sidebar-item">
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
  </div>";
  }
  ?>
  </div>
  </div>	
  <!-- AKHIR BAGIAN TERKINI -->	

  <!-- BAGIAN KOMENTAR -->	
  <div id="kernel_triple_comments_kernel_3" style="display: none;">
  <div class="list">
  <?php    
  $komentar=mysql_query("SELECT * FROM berita,komentar 
  WHERE komentar.id_berita=berita.id_berita  
  ORDER BY id_komentar DESC LIMIT 6");
  while($k=mysql_fetch_array($komentar)){
  $isi_komentar = strip_tags($k['isi_komentar']); 
  $isi = substr($isi_komentar,0,100); 
  $isi = substr($isi_komentar,0,strrpos($isi," ")); 
  echo "
  <div class='item'>
  <div class='image'>
  </div>";
  echo "<div class='text2'>
  <span class='judulberita1'><a href='http://$k[url]' target='_blank'>$k[nama_komentar]</span></a>
  <p><class style=\"color:#EA1C1C;font-size:12px\">pada 
  <a href='media.php?module=detailberita&judul=$k[id_berita]#$k[id_komentar]' class='tooltip' title='$isi ...'><b>$k[judul]</b></a></div>
  </div>";}
  ?>
  </div>
  </div>	
  <!-- AKHIR BAGIAN KOMENTAR -->	
  </div>
  </div>	
  <!------------- AKHIR TABS BERITA -------------------->


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
  $agenda=mysql_query("SELECT * FROM agenda where jenis_agenda='Umum' ORDER BY rand() DESC LIMIT 6");
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
  $pengumuman=mysql_query("SELECT * FROM pengumuman where jenis_pengumuman='Umum' ORDER BY rand() DESC LIMIT 6");
  while($a=mysql_fetch_array($pengumuman)){
  $tgl_post = tgl_indo($a[tgl_post]);

  echo "							  
  <li><p><span class='tanggal02'><span>$tgl_post</span></p>
  <a href='media.php?module=pengumuman'><b>$a[judul]</b></a>
  
  </li>";}
  ?>
  
  </ul></div></div>
  </div></div>
  
  

  </div>
  <div class="clear">&nbsp;</div>
  </div>
  </div><br />