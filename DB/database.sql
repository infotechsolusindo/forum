create table akun (
    email varchar(50) not null primary key,
    password varchar(50) not null,
    wewenang char(1) not null default 'x', /* x=calon,s=anggota sementara,0=anggota,1=admin seleksi,2=juri,3=admin forum */
    created timestamp() null,
    lastmodify timestamp()
);
create table anggota (
    nra varchar(20) null, /* jika peserta seleksi tidak wajib isi nra, jika anggota lama wajib */
    email varchar(50) not null,
    angkatan char(4) not null,
    namalengkap varchar(50) not null,
    namapanggilan varchar(20) null,
    jeniskelamin enum('L','P') not null,
    tempatlahir char(15) null,
    tgllahir date null,
    nomerponsel char(15) null,
    alamatdomisili varchar(50) null,
    pendidikanterakhir enum('SMP','SMU','SMK','D1','D3','S1') null,
    pekerjaan varchar(30) null,
    institusi varchar(20) null,
    jabatan varchar(20) null,
    foto varchar(50) null,
    status char(1) not null default 'D', /* A=Aktif,B=Blocked,C=Cancel/Dihapus,D=Non Aktif */
    unique index idx0 (nra,email) 
);

create table thread (
    kodethread int(11) not null auto_increment primary key,
    nra varchar(20) not null,
    tanggal date not null,
    judul varchar(50) not null,
    isi text not null,
    topik varchar(20) null,
    status char(1) not null default '1' /**/
);

create table komenthread (
    kodekomenthread int(11) not null auto_increment primary key,
    tanggal date not null,
    kodethread int(11) not null,
    nra varchar(20) not null,
    waktu time not null,
    isi text not null,
    gambar varchar(50) null
);
create table karir (
    kodekarir int(11) not null auto_increment primary key,
    nra varchar(20) not null,
    kategori int(11) not null,
    tanggal date not null,
    gaji float null,                /* in IDR */
    bataswaktu int not null,        /* in days */
    judul varchar(50) not null,
    isi text not null,
    gambar varchar(50) null,
    status char(1) not null default '1'
);
create table komenkarir (
    kodekomenkarir int(11) not null auto_increment primary key,
    kodekarir int(11) not null,
    nra int(11) not null,
    tanggal date not null,
    isi text not null
);
create table kegiatan (
    kodekegiatan int(11) not null auto_increment primary key,
    nra varchar(20) not null,
    tanggal date not null,
    jadwal datetime not null,
    durasi int not null,            /* in seconds */
    biaya float null,               /* in IDR */
    judul varchar(50) not null,
    isi text not null,
    gambar varchar(50) null,
    status char(1) not null default '1'
);
create table komenkegiatan (
    idkomenkegiatan int(11) not null auto_increment primary key,
    kodekegiatan int(11) not null,
    nra varchar(20) not null,
    tanggal date not null,
    isi text not null
);
create table dokumen (
    iddokumen int(11) not null auto_increment primary key,
    tipe int(2) not null,
    peserta varchar(20) null,
    judul varchar(20) not null,
    deskripsi varchar(20) not null,
    file varchar(20) null
);
create table pendaftaran (
    idpendaftaran int(11) not null auto_increment primary key,
    tanggal date not null,
    peserta varchar(50) not null default '' unique,
    status char(1) not null default '0' /* 0=pendaftaran baru,1=diproses,2=selesai */
);

create table aturanseleksi (
    angkatan varchar(4) not null default '1910',
    tahap int(2) not null default 1,
    nomerberkas int(2) not null,
    namaberkas varchar(20) not null,
    wajib boolean not null default false,
    admin varchar(20) not null,
    created date not null
);
create table formulir (
    idformulir int(11) not null auto_increment primary key,
    minscore int(3) not null default 40,
    maxscore int(3) not null default 100
);
create table formulirdetail (
    idformulir int(11) not null,
    nomerfield int(3) not null,
    namafield varchar(20) not null
);
create table seleksi (
    idseleksi int(11) not null auto_increment primary key,
    tanggal date not null,
    angkatan varchar(4) not null,
    peserta varchar(50) not null,
    scoretotal int(3) null
);
create table seleksidetail (
    idseleksi int(11) not null,
    idformulir int(11) not null,
    nomerfield int(3) not null,
    isifield text null,
    score int(3) not null default 0
)




create table forum (
    idforum int(11) not null auto_increment primary key
);
