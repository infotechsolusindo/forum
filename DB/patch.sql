drop table if exists tahapanseleksi;
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
