import { toggleVisibility } from "./toggle-visibility";

export function accordion() {
  const accordionsTriggers = document.querySelectorAll("[data-accordion-trigger]");

  const accordionHandler = (clickedAccordion) => {
    accordionsTriggers.forEach(accordion => {
      const accordionAriaControls = accordion.getAttribute("aria-controls");
      const accordionItem = accordion.closest("[data-accordion-item]");
      const isClickedAccordion = accordion === clickedAccordion;

      if (!isClickedAccordion && accordion.getAttribute("aria-expanded") === "true") {
        accordion.setAttribute("aria-expanded", "false");
        accordionItem.classList.remove("active");
        toggleVisibility(document.getElementById(accordionAriaControls));
      }
    });

    const clickedAccordionControls = clickedAccordion.getAttribute("aria-controls");
    const clickedAccordionItem = clickedAccordion.closest("[data-accordion-item]");
    const isExpanded = clickedAccordion.getAttribute("aria-expanded") === "true";

    clickedAccordion.setAttribute("aria-expanded", !isExpanded);
    clickedAccordionItem.classList.toggle("active");
    toggleVisibility(document.getElementById(clickedAccordionControls));
  };

  accordionsTriggers.forEach(accordionTrigger => {
    accordionTrigger.addEventListener("click", () => {
      accordionHandler(accordionTrigger);
    });
  });
}
