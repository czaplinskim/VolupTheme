

export function accordionInit() {

  $('#faq-accordion').accordion({
    header: '.faq-accordion-item > .faq-accordion-header', // Wskazujemy nagłówki w zagnieżdżonej strukturze
    collapsible: true, // Pozwala zamknąć wszystkie sekcje
    heightStyle: 'content', // Dostosowanie wysokości do treści
    active: false, // Akordeon jest zamknięty na starcie
    icons: false, // Usuwa domyślne ikony
    beforeActivate: function (event, ui) {
      // Obrót strzałki w nowo otwieranej sekcji
      ui.newHeader
        .find('svg')
        .addClass('rotate-180 transition-transform duration-300');

      // Cofnij obrót w zamykanej sekcji
      ui.oldHeader.find('svg').removeClass('rotate-180');
    },
  });

}