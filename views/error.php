<?php echo $data['header']; ?>
    <!-- Container -->
    <div id="container">
		<div class="alert alert-danger">
			<h2>ERROR ...</h2>
			<?php if (isset($data['error'])) {?>
			<center><?php echo $data['error']; ?></center>
			<?php } else {?>
			<center><strong><h2>"Maaf! Halaman tidak tersedia !!!"</h2></strong>
			<p>Mungkin Anda melupakan sesuatu atau ada kesalahan pengetikan URL?<br />
			  Klik <a href="<?php echo SITE_ROOT; ?>">Beranda</a> untuk kembali.</p></center>
			<?php }?>
		</div>

    </div>
    <!-- End Container -->
<?php echo $data['footer']; ?>