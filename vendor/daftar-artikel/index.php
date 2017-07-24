<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="pull-left">
			<h2>Daftar Artikel
			</h2>
		</div>
	</div>
	<div class="panel-body">
		<div class="navbar"><a href="?url=anggota/forum/tambah/thread" class="btn btn-success pull-right">Tambah</a></div>
		<!-- Table -->
		<div class="table">
			<table id="daftarartikel" width="100%" border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Waktu</th>
						<th>Judul</th>
						<th>Kategori</th>
						<th>Author</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($data->artikels) {foreach ($data->artikels as $artikel) {?>
					<tr class="">
					<td><input type="checkbox" class="checkbox" /></td>
					<td><?php echo "$artikel->tglposting"; ?></td>
					<td><h3><a href="?url=artikel/view/<?php echo $artikel->id; ?>"><?php echo $artikel->judul; ?></a></h3></td>
					<td><?php //echo $artikel->namakategori; ;;;;;;?></td>
					<td><a href="#"><?php //echo $artikel->author; ;;;;;?></a></td>
					<td>
					<a href="?url=artikel/hapus/<?php echo $artikel->id; ?>" class="ico del">Hapus</a>
					<a href="?url=artikel/ubah/<?php echo $artikel->id; ?>" class="ico edit">Ubah</a></td>
					</tr>
					<?php }}?>
				</tbody>
			</table>
			<!-- Pagging -->
			<div class="pagging">
			  <div class="left">Showing 1-12 of 44</div>
			  <div class="right"> <a href="#">Previous</a> <a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">245</a> <span>...</span> <a href="#">Next</a> <a href="#">View all</a> </div>
			</div>
		<!-- End Pagging -->
		</div>
		<!-- Table -->
	</div>
	<script>
		$('#daftarartikel').DataTable();
	</script>
</div>