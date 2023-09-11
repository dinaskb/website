-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Sep 2023 pada 08.58
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinaskb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `foto`, `level`, `blokir`, `id_session`) VALUES
('dinasp3ap2kb', 'fd306cdd738de34868ee1cfdaf7974f8', 'admin', 'yundi@yahoo.com', '082170214495', '15me_yundi.jpg', 'admin', 'N', 'q173s8hs1jl04st35169ccl8o7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(5) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `jenis_agenda` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tema` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_agenda` text COLLATE latin1_general_ci NOT NULL,
  `tempat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `id_kategori`, `jenis_agenda`, `tema`, `isi_agenda`, `tempat`, `tgl_mulai`, `username`) VALUES
(65, 0, 'Umum', 'Rapat PLKB di Aula Dinas P3AP2KB', 'Membahas Mengenai Laporan Bulanan PLKB di Kecamatan Masing-Masing\r\n', 'DINAS P3AP2KB', '2023-07-01', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `judul_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `headline` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `utama` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `isi_berita` text COLLATE latin1_general_ci NOT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`) VALUES
(663, 31, 'dinasp3ap2kb', 'Peringatan Hari Olahraga Nasional(HAORNAS) Ke-40 Tahun Kab Paluta Berjalan dengan Lancar dan Khidmat', 'peringatan-hari-olahraga-nasionalhaornas-ke40-tahun-kab-paluta-berjalan-dengan-lancar-dan-khidmat', 'Y', 'Y', 'Y', 'Kepala Dinas P3AP2KB Kabupaten Padang Lawas Utara Hasbullah Harahap, S.Sos, MM didampingi Sekretaris Ganti Paruntungan Pulungan, SKM, Kepala UPTD. PPA Ahmad Adha, S.Kep, Ners dan beberapa pegawai Dinas P3AP2KB Kab Paluta hari ini mengikuti Jalan Sehat dalam rangka Peringatan Hari Olahraga Nasional (HAORNAS) Ke-40 Tahun Tingkat Kabupaten Padang Lawas Utara. Acara Jalan Sehat dengan rute Masjid Raya Gunungtua sampai Kantor Bupati Paluta di ikuti oleh berbagai instansi dan organisasi kemasyarakatan pemuda serta generasi muda dari berbagai lembaga yang dihadiri langsung oleh Bupati Padang Lawas Utara Andar Amin Harahap, S.STP, M.Si, Wakil Bupati H. Hariro Harahap, SE, M.Si, Sekda Patuan Rahmat Syukur P. Hasibuan, S.STP, MM dan Pimpinan OPD serta Forum Komunikasi Pimpinan Daerah Kabupaten Padang Lawas Utara. #BerencanaItuKeren #KeluargaKerenCegahStunting\r\n', 'Senin', '2023-09-11', '09:15:00', '64hornas.jpeg', 2),
(662, 31, 'dinasp3ap2kb', 'Pelaksanaan MOW di Rumah Sakit Umum Daerah Gunung Tua Berjalan dengan Lancar dan Khidmat', 'pelaksanaan-mow-di-rumah-sakit-umum-daerah-gunung-tua-berjalan-dengan-lancar-dan-khidmat', 'Y', 'Y', 'Y', '<div>\r\nBupati Padang Lawas Utara yang diwakili oleh Asisten Administrasi Umum Maralobi Siregar S.Sos MM melakukan pemantauan pelaksanaan kegiatan Medis Operasi Wanita (MOW)/Tubektomi yang laksanakan oleh Dinas Pemberdayaan Perempuan dan Perlindungan Anak serta Pengendalian Penduduk dan Keluarga Berencana (P3AP2KB) Kabupaten Padang Lawas Utara.\r\n</div>\r\n<div>\r\nKegiatan tersebut turut didampingi oleh Kepala Dinas P3AP2KB Kabupaten Padang Lawas Utara Hasbullah Harahap, S.Sos, MM, Sekretaris Ganti Paruntungan Pulungan, SKM, dan Kabid Pelayanan Medis RSUD Gunungtua dr. Mandayani Adelina Harahap. Kepala Dinas P3AP2KB Kab. Paluta dalam laporannya menjelaskan bahwa peserta kegiatan tersebut berjumlah 23 orang Perempuan Usia Subur yang berasal dari 9 Kecamatan yang ada di Paluta. Adapun tujuan MOW ini adalah prosedur pemotongan atau penutupan tuba falopi, yaitu saluran yang menghubungkan indung telur (ovarium) dan rahim. Prosedur ini membuat sel-sel telur tidak bisa memasuki rahim sehingga tidak dapat dibuahi. Tubektomi juga dapat menghalangi sperma masuk ke dalam tuba falopi. Sebagai salah satu metode KB yang bersifat permanen, tubektomi sangat efektif bila dibandingkan dengan KB jenis lain. Hal ini karena tubektomi tidak memerlukan wanita untuk menghitung masa subur saat siklus menstruasi, atau mengingat jadwal minum pil dan suntik KB.&nbsp;\r\n</div>\r\n<div>\r\n#Berencana ItuKeren\r\n</div>\r\n<div>\r\n#KeluargaKerenCegahStunting\r\n</div>\r\n', 'Senin', '2023-09-11', '09:07:46', '88MOW.jpeg', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int(5) NOT NULL,
  `id_kategori` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `jdl_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gallery_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `gbr_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `id_kategori`, `username`, `jdl_gallery`, `gallery_seo`, `keterangan`, `gbr_gallery`) VALUES
(243, '0', 'admin', 'Melaksanakan Apel Pagi', 'Melaksanakan-Apel-Pagi', 'kepala Dinas dan Sekretaris selalu memberi arahan kepada ASN dan Honorer Terkait dengan Kedisiplinan Tugas', 'apel.JPEG'),
(242, '0', 'admin', 'Melaksanakan Apel Pagi', 'Melaksanakan-Apel-Pagi', 'kepala Dinas dan Sekretaris selalu memberi arahan kepada ASN dan Honorer Terkait dengan Kedisiplinan Tugas', 'apel2.JPEG'),
(241, '0', 'admin', 'Melaksanakan Apel Pagi', 'Melaksanakan-Apel-Pagi', 'kepala Dinas dan Sekretaris selalu memberi arahan kepada ASN dan Honorer Terkait dengan Kedisiplinan Tugas', 'apel3.JPEG'),
(247, '22', 'admin', 'Melaksanakan Apel Pagi', 'Melaksanakan-Apel-Pagi', 'kepala Dinas dan Sekretaris selalu memberi arahan kepada ASN dan Honorer Terkait dengan Kedisiplinan Tugas', 'apel4.JPEG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `aktif`) VALUES
(19, 'Teknologi', 'Y'),
(2, 'Olahraga', 'Y'),
(21, 'Ekonomi', 'N'),
(22, 'Politik', 'N'),
(23, 'Hiburan', 'Y'),
(31, 'Kesehatan ', 'Y'),
(34, 'Seni & Budaya', 'N'),
(44, 'Wisata', 'N'),
(46, 'Tes', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(5) NOT NULL,
  `id_berita` int(5) NOT NULL,
  `nama_komentar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_komentar` text COLLATE latin1_general_ci NOT NULL,
  `tgl` date NOT NULL,
  `jam_komentar` time NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_berita`, `nama_komentar`, `url`, `isi_komentar`, `tgl`, `jam_komentar`, `aktif`, `email`) VALUES
(142, 659, 'Jaka', 'jaka@gmail.com', ' Waw   ', '2016-12-14', '22:40:30', 'Y', ''),
(139, 659, 'Yundi', 'yundi@gmail.com', 'Mantap', '2016-12-09', '22:24:30', 'Y', ''),
(145, 0, 'RAJA', 'rajasetia@gmail.com', ' kereenn   ', '2023-09-10', '13:49:56', 'Y', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lakip`
--

CREATE TABLE `lakip` (
  `id_lakip` int(10) NOT NULL,
  `indikator_kinerja` varchar(100) NOT NULL,
  `capaian_sblm` varchar(10) NOT NULL,
  `target` varchar(10) NOT NULL,
  `realisasi` varchar(10) NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `target_akhir` varchar(10) NOT NULL,
  `capaian_akhir` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`username`, `password`, `nama_lengkap`, `level`, `email`, `nohp`, `alamat`) VALUES
('pegawai', 'pegawai', 'pegawai', 'pegawai', 'pegawai@gmail.com', '082170214495', 'Padang'),
('yundi', '12345', 'Yundi', 'pegawai', 'yundi@gmail.com', '082170214488', 'Jl. Aru Indah no 21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(5) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `jenis_pengumuman` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_pengumuman` text COLLATE latin1_general_ci NOT NULL,
  `file` text COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indeks untuk tabel `lakip`
--
ALTER TABLE `lakip`
  ADD PRIMARY KEY (`id_lakip`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=664;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT untuk tabel `lakip`
--
ALTER TABLE `lakip`
  MODIFY `id_lakip` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
