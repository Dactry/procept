<?php
global $spy_link;
if ($spy_link) : ?>
    <div class="target-menu-wrap text-white">
        <div class="target-menu">
            <ul class="target-menu__buttons" data-target-menu>
                <?= $spy_link; ?>
                <li><a class="target-menu__buttons-link" href="/contact"><span class="target-menu__buttons-title decor-line text-primary">Contact Us</span></a></li>
            </ul>
        </div>
    </div>
<?php endif ?>
