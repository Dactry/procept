<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>


<body <?php body_class('sticky-footer preload'); ?>>
	<?php wp_body_open(); ?>
	<a class="skip-link" href="#site-content">Skip to main content</a>

	<header class="site-header underline-reverse text-white">

		<div class="container-xxl">
			<div class="row gx-3 align-items-center site-header-space justify-content-between">
				<?php
				$cta_link_shortcode = do_shortcode('[cta-link]');
				$custom_logo_id = get_custom_logo();
				if ($custom_logo_id) :
				?>
					<div class="col col-xl-auto d-flex"><?php the_custom_logo(); ?></div>
				<?php endif; ?>

				<?php
				if (has_nav_menu('menu-1')) : ?>
					<div class="col-auto">
						<div class="overlay-menu">
							<div class="row align-items-center hide-header-element">
								<div class="col"></div>
								<div class="col-auto">
									<button type="button" class="toggle-button" aria-label="Close Menu" data-overlay-menu-toggle>
										<span class="toggle-button__label">Close</span>
										<?php get_template_part('components/site-icon', null, ['icon' => 'close', 'class' => 'toggle-button__icon']); ?>
									</button>
								</div>
							</div>
							<?php
							wp_nav_menu(
								array(
									'container' => false,
									'theme_location' => 'menu-1',
									'menu_class' => 'site-menu site-menu--responsive',
									'walker' => new Sub_Menu_Toggle
								)
							);
							?>
							<?php if ($cta_link_shortcode && false) : ?>
								<p class="hide-header-element">
									<?= $cta_link_shortcode; ?>
								</p>
							<?php endif; ?>
						</div>

					</div>
				<?php endif; ?>

				<?php if ($cta_link_shortcode) : ?>
					<div class="col-auto">
						<?= $cta_link_shortcode; ?>
					</div>
				<?php endif; ?>

				<div class="col-auto hide-header-element">
					<button type="button" class="toggle-button" aria-label="Show Menu" data-overlay-menu-toggle>
						<span class="toggle-button__label d-none d-sm-block">Menu</span>
						<?php get_template_part('components/site-icon', null, ['icon' => 'menu', 'class' => 'toggle-button__icon']); ?>
					</button>
				</div>
			</div>
		</div>
		<div class="curtain curtain--menu curtain--hidden stretch pos-fixed hide-header-element" data-overlay-menu-toggle></div>
	</header>

	<main id="site-content" class="site-content" data-site-content>