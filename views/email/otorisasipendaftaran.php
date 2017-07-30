<p>
	<b>Pendaftaran Peserta Sudah di Setujui</b><br>
	</p>
	<p>
	Salam <?php echo $data['namalengkap']; ?>,<br>
	Proses pendaftaran untuk menjadi Calon Anggota sudah disetujui. Silahkan hadir di kegiatan Seleksi yang akan diadakan pada:<br></p>
	<h4>Data Peserta :</h4>
	<table>
		<tr> <td>No. Peserta</td> <td>: <?php echo $data['idpeserta']; ?></td></tr>
		<tr> <td>Nama Lengkap</td> <td>: <?php echo $data['namalengkap']; ?></td> </tr>
		<tr> <td>Email Terdaftar</td> <td>: <?php echo $data['email']; ?></td> </tr>
	</table>
	<table>
		<tr><td>Hari</td><td>: <?php echo HARISELEKSI; ?></td></tr>
		<tr><td>Tanggal</td><td>: <?php echo TGLSELEKSI; ?></td></tr>
		<tr><td>Jam</td><td>: <?php echo JAMSELEKSI; ?></td></tr>
		<tr><td>Lokasi</td><td>: <?php TEMPATSELEKSI;?></td></tr>
	</table>
<p>
	Gunakan email Anda ini, <?php echo $data['email']; ?> untuk mengakses halaman khusus yang disediakan bagi Calon Anggota.<br>
	Anda bisa memonitor hasil seleksi dari halaman tersebut.
</p>