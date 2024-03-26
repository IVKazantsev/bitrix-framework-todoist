<?php

/**
 * @var CMain $APPLICATION
 */

?>

<!doctype html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php $APPLICATION->ShowTitle(); ?></title>

	<?php $APPLICATION->ShowHead(); ?>
</head>
<body>
<?php $APPLICATION->ShowPanel(); ?>

<section class="section">
	<div class="column is-offset-one-fifth">
		<nav class="navbar" role="navigation" aria-label="main navigation">
			<div class="navbar-brand">
				<a class="navbar-item has-text-weight-semibold is-size-2 logo" href="/">
					📝<?php $APPLICATION->ShowTitle(); ?>
				</a>
			</div>
		</nav>
	</div>
</section>
<section class="section">
	<div class="container">
