<?php
/**
 * Base layout
 *
 * @package wivs
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

	<?php
	// WP head.
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>
	<?php
	// Inertia app.
	bb_inject_inertia();

	// WP footer.
	wp_footer();
	?>
</body>

</html>
