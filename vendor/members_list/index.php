<div class="panel panel-primary module">
	<div class="panel-heading">
		<h2>Percakapan</h2>
	</div>
	<div class="panel-body">
		<div class="tab-pane" style="height:<?php echo $data->height; ?>; overflow-y:scroll; width:100%;">
			<ul>
				<?php foreach ($data->a as $anggota) {?>
				<li class="list-group-item">
					<a href="<?php echo '?url=chat/show/' . strtolower($anggota->namapanggilan); ?>" style="text-decoration: none">
					<i class="glyphicon glyphicon-user"></i> <?=substr($anggota->namalengkap, 0, 18);?>
					</a>
				</li>
				<?php }?>
			</ul>
		</div>
	</div>
</div>