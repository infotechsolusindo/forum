/*drop table if exists tahapanseleksi;
create table tahapanseleksi(
	id int(11) not null auto_increment primary key,
	angkatan int(4)  not null,
	tahap int(2)  not null,
	item varchar(30) not null, 
	deskripsi varchar(100),
	juri varchar(50) not null
);
create table penilaian(
    id int auto_increment primary key,
    totalnilai int null
);

alter table seleksi modify idpeserta varchar(10) null;

alter table penilaian modify totalnilai float(3,2);
*/
/*
CREATE TABLE `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtopik` int(11) NOT NULL,
  `tipe` int(11) NOT NULL DEFAULT '0',
  `judul` varchar(100) NOT NULL,
  `isipendek` varchar(255) NOT NULL DEFAULT '__ISI ARTIKEL TIDAK DITEMUKAN__',
  `isipanjang` text NOT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `penulis_email` varchar(50) DEFAULT NULL,
  `tglposting` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tglrubah` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` char(1) NOT NULL DEFAULT 'a',
  `gambar` varchar(100) DEFAULT 'public/assets/img/_gambarblank.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1
*/
/*
 CREATE TABLE `_config` (
      `parmname` varchar(20) NOT NULL,
      `parmival` int(11) DEFAULT NULL,
      `parmsval` varchar(20) DEFAULT NULL,
      `parmdesc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

CREATE TABLE `topik` (
      `idtopik` int(11) NOT NULL AUTO_INCREMENT,
      `deskripsi` varchar(100) NOT NULL,
      `idpemilik` varchar(50) NOT NULL,
      `status` char(1) NOT NULL DEFAULT '1',
      PRIMARY KEY (`idtopik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

*/
DROP TABLE `seleksi`;
CREATE TABLE `seleksi` (
      `idseleksi` int(11) NOT NULL AUTO_INCREMENT,
      `tgl` date NOT NULL,
      `angkatan` int(4) NOT NULL,
      `idpeserta` varchar(10) DEFAULT NULL,
      `jeniskelamin` enum('L','P') NOT NULL,
      `wilayah` int(11) NOT NULL,
      `tahap` int(11) NOT NULL,
      `item` varchar(30) NOT NULL,
      `nilai` int(3) DEFAULT '0',
      `prosentase` int(3) DEFAULT '0',
      `idjuri` varchar(50) NOT NULL,
      `idpenilaian` int(11) DEFAULT NULL,
      PRIMARY KEY (`idseleksi`),
      UNIQUE KEY `idx_angkatan_tahap_item` (`angkatan`,`tahap`,`item`,`idpeserta`),
      KEY `idx_peserta_angkatan` (`angkatan`,`idpeserta`,`jeniskelamin`),
      KEY `idx_peserta_wilayah` (`wilayah`,`idpeserta`),
      KEY `idx_peserta_angkatan_wilayah` (`angkatan`,`wilayah`,`idpeserta`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
