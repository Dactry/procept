<?php if (!paginate_links()) return; ?>
<div class="block-header__title spacer-section-pt" data-animate>
	<span class=" decor-line decor-line--extra decor-line--right">
		<div class="site-pagination">
			<div class="pagination">
				<?php core_pagination(); ?>
			</div>
		</div>
	</span>
</div>