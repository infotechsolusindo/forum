<script src="public/assets/js/ckeditor/ckeditor.js"></script>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h2>Buat Artikel</h2>
	</div>
	<div class="panel-body">
		<form action="#" method="post">
			<!-- Form -->
			<div class="form">
			  <p> <span class="req">maks 100 karakter</span>
			    <label>Judul <span>(Wajib diisi)</span></label>
			    <input type="text" class="field size1" value="<?php echo $data->judul;?>" />
			  </p>
			  <p>
			  	<label>Kategori</label>
			  	<select name="kategori" id="kategori" class="field size1">
			  		<option value="">---- Pilih Kategori ----</option>
			  	<?php foreach($data->kategori as $kategori){?>
			  		<?php $selected = ($kategori->idkategori==$data->idkategori)?"selected":"";?>
			  		<option value="<?php echo $kategori->idkategori;?>" <?php echo $selected;?> ><?php echo $kategori->namakategori;?></option>
			  	<?php } ?>
			  	</select>
			  </p>
			  <p>
			    <label>Isi Artikel <span>(Wajib diisi)</span></label>
			    <textarea id="isi" class="field size1" rows="10" cols="30"><?php echo $data->isi;?></textarea>
			  </p>
			</div>
			<!-- End Form -->
			<!-- Form Buttons -->
			<div class="buttons">
			  <input type="submit" class="button" value="Simpan" />
			</div>
			<!-- End Form Buttons -->
		</form>
	</div>
</div>
<script>
    if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
        CKEDITOR.tools.enableHtml5Elements( document );

    CKEDITOR.config.height = 300;
    CKEDITOR.config.width = 'auto';

    var initEditor = ( function() {
    return function() {
        var editorElement = CKEDITOR.document.getById( 'isi' );
        CKEDITOR.replace( 'isi' );
    }       
    })();  

    initEditor();
</script>