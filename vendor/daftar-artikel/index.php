<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="pull-left">
			<h2>Daftar Artikel</h2>
		</div>
        <div class="pull-right">
          <label><i class="glyphicon glyphicon-search"></i></label>
          <input type="text" class="field small-field" />
          <input type="submit" class="button" value="search" />
        </div>
	</div>
	<div class="panel-body">
		<!-- Table -->
		<div class="table">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
				<?php foreach($data->daftar as $artikel){ ?>
					<tr class="">
						<td><input type="checkbox" class="checkbox" /></td>
						<td><?php echo "$artikel->tgl $artikel->jam";?></td>
						<td><h3><a href="?url=artikel/view/<?php echo $artikel->idartikel;?>"><?php echo $artikel->judul;?></a></h3></td>
						<td><?php echo $artikel->namakategori;?></td>
						<td><a href="#"><?php echo $artikel->author;?></a></td>
						<td>
							<a href="?url=artikel/hapus/<?php echo $artikel->idartikel;?>" class="ico del">Hapus</a>
							<a href="?url=artikel/ubah/<?php echo $artikel->idartikel;?>" class="ico edit">Ubah</a></td>
					</tr>
				<?php } ?>
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
</div>