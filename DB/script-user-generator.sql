insert into akun (select email,md5(namapanggilan),'0',now(),now() from anggota)
