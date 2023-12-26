import "../scss/style.scss";

import { accordion } from "./modules/accordion";
import { tabs } from "./modules/tabs";
import { overlayMenu } from "./modules/overlay-menu";
import { animate } from "./modules/animate";
import { videoAutoplay } from "./modules/video-autoplay";
import { preload } from "./modules/preload";
import { targetMenu } from "./modules/target-menu";
import { horizontalScroll } from "./modules/horizontal-scroll";

preload();

videoAutoplay();

overlayMenu();

accordion();

tabs();

animate();

// targetMenu();

horizontalScroll()


window.onload = () => {

    const spySections = document.querySelectorAll('[data-spy-section]');
    const spyLinks = document.querySelectorAll("[data-spy-link]");
    const blocksBeforeSpySections = document.querySelectorAll('[data-site-content] > .content-block');
    const siteContent = document.querySelector('[data-site-content]');
    const root = document.documentElement;

    let blockRadiusInPx;
    let blocksHeightBeforeSpySection = 0;

    function calcFontSize() {
        const fontSize = parseFloat(getComputedStyle(siteContent).fontSize);
        const blockRadiusValue = getComputedStyle(root).getPropertyValue('--block-radius');
        blockRadiusInPx = parseFloat(blockRadiusValue) * fontSize;

        blocksHeightBeforeSpySection = Array.from(blocksBeforeSpySections).reduce((totalHeight, el) => {
            return totalHeight + (el.offsetHeight - blockRadiusInPx);

        }, 0);
    }

    calcFontSize();
    window.addEventListener('resize', calcFontSize);

    let arr;
    let sum;
    function recalculatePositions() {
        arr = [blocksHeightBeforeSpySection];
        sum = blocksHeightBeforeSpySection;

        spySections.forEach(el => {
            const elHeight = el.offsetHeight - blockRadiusInPx;
            sum += elHeight;
            arr.push(sum);
            const windowHeight = window.innerHeight;
            const positionTop = elHeight - windowHeight;
            el.style.top = (elHeight - blockRadiusInPx > windowHeight) ? `-${positionTop}px` : '';
        });
    }
    recalculatePositions();
    window.addEventListener('resize', recalculatePositions);


    spyLinks.forEach((link, i) => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const sectionPositionTop = arr[i];
            spyLinks.forEach(link => link.classList.remove('active'));
            link.classList.add('active')
            window.scrollTo({
                top: sectionPositionTop,
                behavior: 'smooth'
            })
        })
    })


    const header = document.querySelector('.site-header')
    const space = document.querySelector('.site-header-space')
    const spyElement = document.querySelector("[data-spy-section]");
    let lastScrollTop = 0;

    document.addEventListener("scroll", function () {
        const headerHeight = space.scrollTop;
        const spyElementRect = spyElement.getBoundingClientRect();
        const currentScrollTop = window.scrollY || document.documentElement.scrollTop;
        // const scrolledUp = lastScrollTop - currentScrollTop >= 200;
        if (spyElementRect.top <= headerHeight) {
            if (currentScrollTop > lastScrollTop) {
                header.style.setProperty('--translate-header', `-100%`);
            }
        } else {
            header.style.setProperty('--translate-header', 0);
        }
        lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop;
    });
}