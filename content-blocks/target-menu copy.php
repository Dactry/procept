<?php
global $spy_link;
if ($spy_link) : ?>
    <div class="sticky-menu text-white">
        <div class="target-menu">
            <div data-spy-window-height></div>
            <ul class="target-menu__buttons" data-spy-nav>
                <?= $spy_link; ?>
                <li><a class="target-menu__buttons-link" href="/contact"><span class="target-menu__buttons-title decor-line text-primary">Contact Us</span></a></li>
            </ul>
        </div>
    </div>
<?php endif ?>
