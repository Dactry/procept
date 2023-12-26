import "../scss/style.scss";

import { accordion } from "./modules/accordion";
import { tabs } from "./modules/tabs";
import { overlayMenu } from "./modules/overlay-menu";
import { animate } from "./modules/animate";
import { videoAutoplay } from "./modules/video-autoplay";
import { preload } from "./modules/preload";
import { horizontalScroll } from "./modules/horizontal-scroll";
import { helpers } from "./modules/helpers";
import { targetMenu } from "./modules/target-menu";

preload();

videoAutoplay();

overlayMenu();

accordion();

tabs();

animate();

horizontalScroll()

helpers()

// targetMenu();
window.addEventListener('resize', videoAutoplay)

