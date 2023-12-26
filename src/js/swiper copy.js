import "../scss/plugins/_swiper.scss";

import Swiper from "swiper";
import { Navigation, Pagination, EffectFade, Autoplay } from "swiper/modules";
const prefix = "data-swiper";

initSwiper({
  selector: `[${prefix}-gallery]`,
});

initSwiper({
  selector: `[${prefix}-testimonials]`,
});

initSwiper({
  selector: `[${prefix}-members]`,
  spaceBetween: 0,
  slidesPerView: "auto",
  centeredSlides: true,
})

initSwiper({
  selector: `[${prefix}-hero]`,
  pagination: {
    el: `[${prefix}-pagination]`,
    type: "progressbar",
  },
  on: {
    init: function () {
      document.querySelector('.current-slide').textContent = (this.realIndex + 1).toString().padStart(2, '0');
      document.querySelector('.total-slides').textContent = this.slides.length.toString().padStart(2, '0');
    },
    slideChange: function () {
      document.querySelector('.current-slide').textContent = (this.realIndex + 1).toString().padStart(2, '0');
    }
  }
})

function initSwiper(options) {
  const defaultOptions = {
    spaceBetween: 20,
    pagination: {
      el: `[${prefix}-pagination]`,
      type: "fraction",
      clickable: true,
    },
    navigation: {
      nextEl: `[${prefix}-button-next]`,
      prevEl: `[${prefix}-button-prev]`,
    },
  }

  let config = { ...defaultOptions, ...options }

  const sliders = document.querySelectorAll(config.selector);
  if (sliders.length) {
    sliders.forEach((slider) => {
      const loopValue = slider.hasAttribute(`${prefix}-loop`)
      const hasNavigation = slider.querySelector(`[${prefix}-navigation]`)
      const hasPagination = slider.querySelector(`[${prefix}-pagination]`)
      const autoHeight = slider.hasAttribute(`${prefix}-autoheight`)
      const fade = slider.hasAttribute(`${prefix}-fade`) ? 'fade' : null
      const autoplay = +slider.getAttribute(`${prefix}-autoplay`);
      const slidesPerView = +slider.getAttribute(`${prefix}-slides-per-view`);
      if (slidesPerView) {
        const slidesPerViewTablet = slidesPerView >= 3 ? Math.round(slidesPerView / 2) : 1;
        const slidesPerViewMobile = slidesPerView > 4 ? 2 : 1;
        const slidesResult = {
          slidesPerView: slidesPerViewMobile,
          breakpoints: {
            667: {
              slidesPerView: slidesPerViewTablet,
            },
            992: {
              slidesPerView: slidesPerView,
            },
          },
        }
        config = { ...config, ...slidesResult }
      }

      const modules = [];
      if (!hasNavigation) { config.navigation = false };
      if (!hasPagination) { config.pagination = false };

      if (config.pagination) modules.push(Pagination);
      if (config.navigation) modules.push(Navigation);
      if (autoplay) modules.push(Autoplay);
      if (fade) modules.push(EffectFade);

      new Swiper(slider, {
        ...config,
        modules: modules,
        loop: loopValue,
        effect: fade,
        autoHeight: autoHeight,
        autoplay: autoplay ? {
          delay: autoplay,
          pauseOnMouseEnter: true,
        } : false,
      });
    });
  }
}