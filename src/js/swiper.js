import "../scss/plugins/_swiper.scss";

import Swiper from "swiper";
import { Navigation, Pagination, EffectFade, Autoplay } from "swiper/modules";

const swiperPrefix = 'data-swiper';
const swiperSliders = document.querySelectorAll(`[${swiperPrefix}]`);
if (swiperSliders.length) {
  const paginationEl = `[${swiperPrefix}-pagination]`;
  const navigationEl = (direction = '') => {
    direction = direction ? `='${direction}'` : '';
    return `[${swiperPrefix}-navigation${direction}]`;
  };

  const defaultSwiperOptions = {
    modules: [Navigation, Pagination, EffectFade, Autoplay],
    spaceBetween: 20,
    pagination: {
      el: paginationEl,
      type: 'fraction',
      clickable: true,
    },
    navigation: {
      nextEl: navigationEl('next'),
      prevEl: navigationEl('prev'),
    },
  };

  swiperSliders.forEach(swiperSlider => {
    let customSwiperOptions = swiperSlider.getAttribute(swiperPrefix);
    customSwiperOptions = customSwiperOptions ? JSON.parse(customSwiperOptions) : null;

    const swiperOptions = customSwiperOptions ? {
      ...defaultSwiperOptions,
      ...customSwiperOptions
    } : defaultSwiperOptions;
    
    if (swiperSlider.hasAttribute(`${swiperPrefix}-custom-pagination`)) {
      swiperOptions.pagination = {
        el: `[${swiperPrefix}-pagination]`,
        type: "progressbar",
      }
      swiperOptions.on = {
        init: function () {
          document.querySelector('.current-slide').textContent = (this.realIndex + 1).toString().padStart(2, '0');
          document.querySelector('.total-slides').textContent = this.slides.length.toString().padStart(2, '0');
        },
        slideChange: function () {
          document.querySelector('.current-slide').textContent = (this.realIndex + 1).toString().padStart(2, '0');
        }
      }
    }


    if (!swiperSlider.querySelector(navigationEl())) swiperOptions.navigation = false;
    if (!swiperSlider.querySelector(paginationEl)) swiperOptions.pagination = false;

    new Swiper(swiperSlider, swiperOptions);
  });
}
