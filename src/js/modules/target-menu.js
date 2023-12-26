export function targetMenu() {
    const spySections = document.querySelectorAll("[data-spy-section]");
    const spyNav = document.querySelector("[data-spy-nav]");
    const spyLinks = document.querySelectorAll("[data-spy-link]");

    if (!spySections.length && !spyNav) return;

    const activeClass = "active";
    let isoInstance;
    //Handler
    const isoHandler = entry => {
        const spyLink = spyNav.querySelector(`[data-spy-link][href="#${entry.target.id}"]`);
        if (entry.isIntersecting) {
            spyLinks.forEach(link => {
                link.classList.remove(activeClass)
            });
            spyLink.classList.add(activeClass);
        }
    };

    //Options
    const isoOptions = () => {
        const bottomOffset = Math.ceil(window.innerHeight - 5);
        return { 
            rootMargin: `0px 0px -${bottomOffset}px 0px`
        };
    };

    //Main Function
    const iso = () => {
        if (isoInstance) isoInstance.disconnect();
        isoInstance = new IntersectionObserver(entries => entries.forEach(isoHandler), isoOptions());
        spySections.forEach(item => {
            isoInstance.observe(item);
        });
    };
    //Init
    const resizeObserver = new ResizeObserver(entries => {
        entries.forEach(() => iso());
    });
    // resizeObserver.observe(spyNav);
    resizeObserver.observe(document.querySelector("[data-spy-window-height]"));



    document.addEventListener('DOMContentLoaded', () => {
        if (window.location.hash) {
            const hash = window.location.hash.substring(1);
            const targetElement = document.getElementById(hash);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
            history.replaceState(null, null, ' ');
        }
    });

    window.addEventListener('hashchange', () => {
        history.replaceState(null, null, ' ');
    })
};

