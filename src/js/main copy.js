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

targetMenu();

horizontalScroll()


window.onload = () => {
    const contentBlocks = document.querySelectorAll('[data-spy-section]')

    contentBlocks.forEach(block => {
        positionStickyElement(block)
        window.addEventListener('resize', () => positionStickyElement(block))
    })
    function positionStickyElement(el) {
        const blockHeight = el.offsetHeight;
        console.log(blockHeight);
        const windowHeight = window.innerHeight;
        const positionTop = blockHeight - windowHeight;
        const blockStyles = window.getComputedStyle(el);
        const borderRadius = parseFloat(blockStyles.getPropertyValue("border-top-right-radius"));
        if (blockHeight - borderRadius > windowHeight) {
            el.style.top = `calc(-${positionTop}px + ${borderRadius}px)`
        } else {
            el.style.top = ''
        }
    }

    const allSections = document.querySelectorAll("[data-site-content] > *:not(.target-menu)");
    const spyLinks = document.querySelectorAll("[data-spy-link]");

    let arr = []
    const recalculateArray = () => {
        arr = [];
        let sum = 0;
        let accumulator = 0;

        allSections.forEach(section => {
            const computedStyle = getComputedStyle(section);
            let negativeMargin = parseFloat(computedStyle.getPropertyValue("margin-bottom"));
            sum += section.offsetHeight + negativeMargin;

            if (!section.hasAttribute("data-spy-section")) {
                accumulator += sum;
                sum = 0;
            } else {
                arr.push(Math.round((sum + accumulator - section.offsetHeight - negativeMargin) * 100) / 100);
            }
        });
    };
    recalculateArray();
    window.addEventListener('resize', recalculateArray);

    spyLinks.forEach((link, i) => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const sectionOffsetTop = arr[i];
            spyLinks.forEach(link => link.classList.remove('active'));
            link.classList.add('active')
            window.scrollTo({
                top: sectionOffsetTop,
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
        const scrolledUp = lastScrollTop - currentScrollTop >= 40;
        if (spyElementRect.top <= headerHeight) {
            if (currentScrollTop > lastScrollTop) {
                header.style.setProperty('--translate-header', `-100%`);
            } else if (scrolledUp) {
                header.style.setProperty('--translate-header', 0);
            }
        } else {
            header.style.setProperty('--translate-header', 0);
        }
        lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop;
    });
}