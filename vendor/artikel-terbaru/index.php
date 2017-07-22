<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="pull-left">
			<h2>Artikel Terbaru</h2>
		</div>
        <div class="pull-right">
          <label><i class="glyphicon glyphicon-search"></i></label>
          <input type="text" class="field small-field" />
          <input type="submit" class="button" value="search" />
        </div>
	</div>
	<div class="panel-body">
		<!-- Table -->
		<ul>
		<?php foreach ($data->artikels as $artikel) {?>
			<li class="list-group-item">
				<h4><a href="?url=artikel/index/<?php echo $artikel->id; ?>"><?php echo $artikel->judul; ?></a></h4>
				<table style="width:100%;font-size: 10px">
					<tr>
						<td><img src="<?php echo $artikel->gambar; ?>" style="width:100px;height:100px;padding-bottom: 2px;padding-right: 2px"></td>
						<td>
							<p><?php echo $artikel->isipendek; ?></p>
							<a href="?url=artikel/index/<?php echo $artikel->id; ?>">Baca Selengkapnya</a>
						</td>
					</tr>
				</table>
			</li>
		<?php }?>
		</ul>
		<!-- Table -->
	</div>
</div>