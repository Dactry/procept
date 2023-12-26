export function helpers() {

  const siteContent = document.querySelector('[data-site-content]');
  const allElements = Array.from(siteContent.children);
  const element = document.querySelector('[data-target-menu]');
  const root = document.documentElement;

  let blockRadiusInPx;
  let distances = [];
  let targetClick = false;

  function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
  }

  const debouncedRecalculate = debounce(recalculate);
  const resizeObserver = new ResizeObserver(debouncedRecalculate);
  resizeObserver.observe(siteContent);

  function recalculate() {
    calcBorderRadiusSize();
    recalculatePositions();
    desktopHover();
  };

  function calcBorderRadiusSize() {
    const fontSize = parseFloat(getComputedStyle(siteContent).fontSize);
    const blockRadiusValue = getComputedStyle(root).getPropertyValue('--block-radius');
    blockRadiusInPx = parseFloat(blockRadiusValue) * fontSize;
  }

  function recalculatePositions() {
    distances = [];
    document.querySelectorAll('[data-target-section]').forEach(el => {
      distances.push(el.offsetTop)
    })
    allElements.forEach(el => {
      const elHeight = el.offsetHeight - blockRadiusInPx;
      const windowHeight = window.innerHeight;
      if (elHeight > windowHeight) {
        const positionTop = Math.round(elHeight - windowHeight * 0.9);
        el.style.setProperty('--block-top', `-${positionTop}px`);
      }
    });
  }

  function desktopHover() {
    if (window.innerWidth > 992 && element) {
      element.classList.remove('active');
      targetClick = true;
      element.addEventListener('mouseenter', () => {
        element.classList.add('active')
      });
    }
  }

  if (element) {
    const links = element.querySelectorAll("[data-target-link]");
    function handleClick() {
      targetClick = true;
      element.classList.toggle('active');
    }

    element.addEventListener('click', handleClick);

    links.forEach((link, i) => {
      link.addEventListener('click', e => {
        e.preventDefault();
        if (targetClick && element.classList.contains('active')) {
          const sectionPositionTop = distances[i];
          window.scrollTo({
            top: sectionPositionTop,
            behavior: 'smooth'
          });
          targetClick = false;
        }
      });
    });
  }


  const header = document.querySelector('.site-header')
  const contentBlock = document.querySelector(".content-block");

  let lastScrollTop = 0;

  function hideHeader() {
    const windowScroll = window.scrollY;
    const contentBlockHeight = contentBlock.offsetHeight - blockRadiusInPx;
    if (windowScroll > lastScrollTop && windowScroll > contentBlockHeight) {
      header.classList.add('hide-header');
    } else {
      header.classList.remove('hide-header');
    }
    lastScrollTop = windowScroll <= 0 ? 0 : windowScroll;
  }
  hideHeader();
  document.addEventListener("scroll", hideHeader);
}
