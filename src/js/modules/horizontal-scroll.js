export function horizontalScroll() {
    const buttons = document.querySelectorAll('[data-horizontal-scroll]');
    if (!buttons.length) return;

    buttons.forEach(item => {
        item.onwheel = function (e) { this.scrollLeft += e.deltaY * 0.5; };
        checkScroll(item);
        window.addEventListener('resize', () => checkScroll(item));
    });

    function checkScroll(item) { item.scrollWidth > item.clientWidth ? item.classList.add('has-scroll') : item.classList.remove('has-scroll') };
}
