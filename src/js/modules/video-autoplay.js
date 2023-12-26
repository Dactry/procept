export function videoAutoplay() {
  const videoSources = document.querySelectorAll("source");

  videoSources.forEach((source) => {
    const dataSrc = source.dataset.src;
    const grandParent = source.parentElement ? (source.parentElement.parentElement || null) : null;
    const hasPrevMobileBg = grandParent.querySelector('.background-item-mobile') !== null;

    if (hasPrevMobileBg && window.innerWidth < 768) {
      return; 
    }
    const currentSrcUrl = new URL(source.src, window.location.href);
    const dataSrcUrl = new URL(dataSrc, window.location.href);

    if (dataSrc && currentSrcUrl.href !== dataSrcUrl.href) {
        source.src = dataSrc;
        source.parentElement.load();
    }
  });
}
