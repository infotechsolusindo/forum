<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $data['app_title']; ?></title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<!-- Bootstrap core CSS -->
<link href="public/assets/css/bootstrap.css" rel="stylesheet">

<link rel="stylesheet" href="public/assets/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="public/assets/css/jquery-ui.1.12.1.css" type="text/css" media="all" />
<script src="public/assets/js/jquery.js"></script>
</head>
<body>
<!-- Header -->
<div id="header">
  <div class="shell">
    <!-- Logo + Top Nav -->
    <div id="top">
      <h1><a href="#"><?php echo $data['brand']; ?></a></h1>
      <?php //if (checkSession() || isset($_SESSION['id'])) {?>
      <div id="top-navigation">
        Welcome <a href="#"><strong><?php echo $data['user']; ?></strong></a>
        <span>|</span> <a href="#">Help</a>
        <span>|</span> <a href="#">Profile Settings</a>
        <span>|</span>
        <a href="?url=auth/logout">Log out</a>
      </div>
      <?php //};?>
    </div>
    <!-- End Logo + Top Nav -->
    <!-- Main Nav -->
    <?php
$beranda = $admin = $peserta = $anggota = $forum = $karir = $kegiatan = "";
switch ($data['tabmenu']) {
case 'admin':
    $admin = 'class="active"';
    break;
case 'anggota':
    $anggota = 'class="active"';
    break;
case 'peserta':
    $peserta = 'class="active"';
    break;
case 'forum':
    $forum = 'class="active"';
    break;
case 'karir':
    $karir = 'class="active"';
    break;
case 'kegiatan':
    $kegiatan = 'class="active"';
    break;
default:
    $beranda = 'class="active"';
    break;
}
?>
    <div id="navigation">
      <ul>
      <?php if (!isset($data['wewenang'])) {?>
        <li><a href="<?php echo SITE_ROOT; ?>" <?php echo $beranda; ?>><span>Beranda</span></a></li>
      <?php } else if (isset($data['wewenang']) && $data['wewenang'] == 1) {?>
        <li><a href="?url=admin/index" <?php echo $admin; ?>><span><?php echo ucfirst($data['tabmenu']); ?></span></a></li>
      <?php } else if (isset($data['wewenang']) && $data['wewenang'] == 2) {?>
        <li><a href="?url=juri/index" <?php echo $admin; ?>><span><?php echo ucfirst($data['tabmenu']); ?></span></a></li>
      <?php } else if (isset($data['wewenang']) && $data['wewenang'] == 's') {?>
        <li><a href="?url=seleksi/index" <?php echo $peserta; ?>><span>Peserta</span></a></li>
      <?php } else {?>
        <li><a href="?url=anggota/index" <?php echo $anggota; ?>><span>Anggota</span></a></li>
        <li><a href="?url=anggota/forum" <?php echo $forum; ?>><span>Forum</span></a></li>
        <li><a href="?url=anggota/karir" <?php echo $karir; ?>><span>Karir</span></a></li>
        <li><a href="?url=anggota/kegiatan" <?php echo $kegiatan; ?>><span>Kegiatan</span></a></li>
      <?php }?>
      </ul>
    </div>
    <!-- End Main Nav -->
  </div>
</div>
<!-- End Header -->
