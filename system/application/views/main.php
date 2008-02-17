<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Halalan - <?= $title; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <?php if (isset($meta) && !empty($meta)): ?>
  <?= $meta; ?>
  <?php endif; ?>
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/stylesheets/main.css" />
  <script type="text/javascript" src="<?= base_url(); ?>public/javascripts/jquery.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>public/javascripts/jquery.cookie.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>public/javascripts/main.js"></script>
</head>
<body>
<div id="wrap">
	<div id="header">
		<?= img(array('src'=>'public/images/logo.png', 'alt'=>'logo')); ?>
	</div>
	<?= $body; ?>
	<div id="footer">
		<br />
		Powered by Halalan.
	</div>
</div>
</body>
</html>