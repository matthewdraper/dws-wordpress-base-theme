<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package dws
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('dws_container_type');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('wp_body_open'); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar-top" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable"
		   href="#content"><?php esc_html_e('Skip to content', 'dws'); ?></a>

		<nav class="navbar navbar-expand-md navbar-dark bg-primary">

			<?php if ('container' == $container) : ?>
			<div class="container">
				<?php endif; ?>

				<div class="top-nav">

					<!-- Your site title as branding in the menu -->
					<?php if (!has_custom_logo()) { ?>

				<?php if (is_front_page() && is_home()) : ?>

					<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>"
													 title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
													 itemprop="url"><?php bloginfo('name'); ?></a></h1>

				<?php else : ?>

					<a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>"
					   title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
					   itemprop="url"><?php bloginfo('name'); ?></a>

				<?php endif; ?>


					<?php } else {
						the_custom_logo();
					} ?><!-- end custom logo -->

					<form class="search-box">
						<input class="search-box__input" placeholder="Search for items, brands or categories">
						<button type="submit" class="search-box__button" aria-label="Search"><i class="far fa-search"></i></button>
					</form>

					<!-- The WordPress Menu goes here -->
					<?php wp_nav_menu(
						array(
							'theme_location' => 'top',
							'container_class' => '',
							'container_id' => '',
							'menu_class' => 'navbar-nav',
							'fallback_cb' => '',
							'menu_id' => 'top-menu',
							'depth' => 1,
							'walker' => new Dws_WP_Bootstrap_Navwalker(),
						)
					); ?>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
							aria-controls="navbarNavDropdown" aria-expanded="false"
							aria-label="<?php esc_attr_e('Toggle navigation', 'dws'); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

				</div>
				<?php if ('container' == $container) : ?>
			</div><!-- .container -->
		<?php endif; ?>

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->

	<div id="wrapper-navbar-bottom" itemscope itemtype="http://schema.org/WebSite">
		<a class="skip-link sr-only sr-only-focusable"
		   href="#content"><?php esc_html_e('Skip to content', 'dws'); ?></a>
		<nav class="navbar navbar-expand-md navbar-dark bg-secondary">
			<?php if ('container' == $container) : ?>
			<div class="container">
				<?php endif; ?>
				<div class="bottom-nav">
					<!-- The WordPress Menu goes here -->
					<?php wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container_class' => 'collapse navbar-collapse',
							'container_id' => 'navbarNavDropdown',
							'menu_class' => 'navbar-nav',
							'fallback_cb' => '',
							'menu_id' => 'main-menu',
							'depth' => 2,
							'walker' => new Dws_WP_Bootstrap_Navwalker(),
						)
					); ?>
				</div>
				<?php if ('container' == $container) : ?>
			</div><!-- .container -->
		<?php endif; ?>

		</nav><!-- .site-navigation -->
	</div>
