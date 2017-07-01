<div class="panel panel-primary module">
	<div class="panel-heading">
		<h2>Peserta Seleksi</h2>
	</div>
	<div class="panel-body">
		<form action="?url=auth/login" method="post">
			<!-- Form -->
			<div class="form">
				<input type="hidden" name="login-seleksi">
				<div class="form-group">
				<input type="text" name="email" placeholder="Email Pendaftaran" class="form-control">
				</div>
				<div class="form-group">
				<input type="password" name="password" placeholder="Password" class="form-control">
				</div>
				<span><a href="?url=index/pendaftaran1">Belum terdaftar?</a></span>
				<!-- Form Buttons -->
				<div class="buttons">
				  <input type="submit" class="button" value="Login" />
				</div>
				<!-- End Form Buttons -->
			</div>
			<!-- End Form -->
		</form>
	</div>
</div>
