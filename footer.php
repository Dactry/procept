<?php
$custom_logo_id = get_custom_logo();
$phone = do_shortcode('[phone]');
$phone_alt = do_shortcode('[phone suffix="alt"]');
$phone_alt = $phone_alt ? "<div class='hstack gap-2 align-items-end'>" . $phone_alt . '<span class="icon-label-suffix text-muted">USA</span></div>' : '';
$cta_form = get_field('cta_form', 'option');
$social_icons = do_shortcode('[social-icons]');
?>
</main>
<footer class="site-footer bg-dark spacer-section-py text-white">
	<div class="container">
		<div class="row gy-4 underline-reverse">
			<div class="col-12">
				<div class="row">
					<div class="col-md">
						<?php if ($custom_logo_id) : ?>
							<p><?php the_custom_logo(); ?></p>
						<?php endif; ?>
					</div>
					<div class="col offset-md-1 col-lg-7 col-xxl-6 align-self-end">
						<p class="h5">Industry leading Advisory, Product Development, IoT, Data & Cloud and Client Support Service experts.
						</p>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row gy-4">
					<div class="col-md">
						<p class="h4">Call our project experts at</p>
						<?= $phone || $phone_alt ? "<div class='h3 vstack'>$phone$phone_alt</div>" : '' ?>
					</div>
					<div class="col offset-md-1 col-lg-7 col-xxl-6">
						<div class="row">
							<div class="col-lg">
								<div class="row">
									<?php
									$footer_widget_counter = 1;
									while ($footer_widget_counter <= FOOTER_SIDEBAR_QUANTITY) {
										$sidebar_name = "footer-sidebar-$footer_widget_counter";
										if (is_active_sidebar($sidebar_name)) {
											dynamic_sidebar($sidebar_name);
										}
										$footer_widget_counter++;
									}
									?>
								</div>
							</div>
							<?= $cta_form || $social_icons ? "<div class='col site-footer__form'>$cta_form<br>$social_icons</div>" : '' ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row spacer-section-pt fs-xs gy-3">
			<div class="col">
				<div class="site-footer__bottom text-muted underline-reverse">
					<?php
					wp_nav_menu(
						array(
							'container' => false,
							'theme_location' => 'menu-2',
							'menu_class' => 'order-md-1 d-flex flex-column flex-md-row hstack gap-5 reset-list m-0',
							'walker' => new Sub_Menu_Toggle
						)
					);
					?>
					Copyright &copy; <?= esc_html(date('Y')); ?>, <?php bloginfo('name'); ?>
				</div>
			</div>
			<div class="col-md-auto">Procept have proudly partnered with <a href="https://sgd.com.au/" target="_blank" rel="noopener noreferrer">SGD</a> for our website</div>
		</div>
	</div>
</footer>


<?php wp_footer(); ?>


</body>

</html>