jQuery(document).ready(function ($) {
  // Dodaj nowe pole
  $(document).on('click', '.my-customizer-repeatable-add', function (e) {
    e.preventDefault();

    let $container = $(this).closest('.my-customizer-repeatable-container');
    let $items = $container.find('.my-customizer-repeatable-items');
    let index = $items.children('.my-customizer-repeatable-item').length;

    // Pobierz szablon nowego pola z pustym markupiem
    let $template = $container.find('.my-customizer-template').html();

    if (!$template) {
      console.error('Szablon dla nowego pola nie został znaleziony.');
      return;
    }

    // Zamień placeholdery __INDEX__ na aktualny indeks
    $template = $template.replace(/__INDEX__/g, index);

    // Dodaj nowe pole
    $items.append($template);

    // Zaktualizuj ukryte pole
    updateHiddenField($container);
  });

  // Usuń pole
  $(document).on('click', '.my-customizer-repeatable-remove', function (e) {
    e.preventDefault();

    let $container = $(this).closest('.my-customizer-repeatable-container');
    let $item = $(this).closest('.my-customizer-repeatable-item');

    // Nie usuwaj ostatniego pola
    if ($container.find('.my-customizer-repeatable-item').length > 1) {
      $item.remove();
    }

    // Zaktualizuj ukryte pole
    updateHiddenField($container);
  });

  // Aktualizuj dane w ukrytym polu przy każdej zmianie
  $(document).on(
    'input change',
    '.my-customizer-repeatable-item input, .my-customizer-repeatable-item textarea',
    function () {
      let $container = $(this).closest('.my-customizer-repeatable-container');
      updateHiddenField($container);
    }
  );

  function updateHiddenField($container) {
    let data = [];

    $container.find('.my-customizer-repeatable-item').each(function () {
      let item = {};
      $(this)
        .find('[data-field]')
        .each(function () {
          let fieldName = $(this).data('field');
          item[fieldName] = $(this).val();
        });
      data.push(item);
    });

    let jsonData = JSON.stringify(data);

    // Zapisz dane w ukrytym polu
    $container
      .find('.my-customizer-repeatable-data')
      .val(jsonData)
      .trigger('change');

    // Aktywuj przycisk publikowania w Customizerze
    let settingId = $container.data('setting-id');
    if (typeof wp !== 'undefined' && wp.customize) {
      wp.customize(settingId, function (setting) {
        setting.set(jsonData);
      });
    }
  }
});
