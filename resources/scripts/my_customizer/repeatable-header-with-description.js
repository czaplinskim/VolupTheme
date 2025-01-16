jQuery(document).ready(function ($) {

  function initTinyMCE() {
    $('.my-customizer-repeatable-header-with-description-item textarea').each(
      function () {
        const field = $(this);
        const currentId = field.attr('id');

        // Sprawdź, czy edytor już istnieje, aby uniknąć konfliktów
        if (tinymce.get(currentId)) {
          return;
        }
        console.log(currentId);

        tinymce.init({
          selector: `#${currentId}`,
          menubar: false,
          plugins: 'lists',
          wpautop: false,
          forced_root_block: false,
          valid_elements: '*[*]', // Zezwala na wszystkie elementy
          extended_valid_elements: 'br', // Upewnia się, że <br> jest dozwolone
          toolbar:
            'bold italic underline | alignleft aligncenter alignright | bullist numlist',
          setup: (editor) => {
            editor.on('ExecCommand', function () {
              tinymce.triggerSave();
              mcUpdateHiddenInputRepeatableHeaderWithDescripton(
                field.closest(
                  '.my-customizer-repeatable-header-with-description-wrapper'
                )
              );
            });
            editor.on('change', function () {
              tinymce.triggerSave();
              mcUpdateHiddenInputRepeatableHeaderWithDescripton(
                field.closest(
                  '.my-customizer-repeatable-header-with-description-wrapper'
                )
              );
            });
          },
        });
      }
    );
  }

  function removeTinyMCE(instanceId) {
    const editor = tinymce.get(instanceId);
    if (editor) {
      editor.remove(); // Usuwa instancję TinyMCE
    }
  }

  function updateRemoveButtonState(container) {
    const items = container.find(
      '.my-customizer-repeatable-header-with-description-item'
    );
    if (items.length === 1) {
      items
        .find('.remove-repeatable-header-description')
        .addClass('disabled')
        .prop('disabled', true);
    } else {
      items
        .find('.remove-repeatable-header-description')
        .removeClass('disabled')
        .prop('disabled', false);
    }
  }

  function mcAddNewRepeatableHeaderWithDescripton(container) {
    let index = container.find(
      '.my-customizer-repeatable-header-with-description-item'
    ).length;
    let newItem = `
            <div class="my-customizer-repeatable-header-with-description-item">
                <input type="text" id="header_${index}" name="header_${index}" class="my-customizer-repeatable-header-with-description-header" placeholder="Nagłówek">
                <textarea id="description_${index}" name="description_${index}" class="my-customizer-repeatable-header-with-description-description" rows="5" placeholder="Opis"></textarea>
                <button type="button" class="button remove-repeatable-header-description">Usuń</button>
            </div>
        `;

    container
      .find('.my-customizer-repeatable-header-with-description-items')
      .append(newItem);
    initTinyMCE(); // Reinicjalizuj TinyMCE dla nowego elementu
    mcUpdateHiddenInputRepeatableHeaderWithDescripton(container);
    updateRemoveButtonState(container); // Aktualizuj stan przycisków usuwania
  }

  function mcUpdateHiddenInputRepeatableHeaderWithDescripton(container) {
    let items = [];
    container
      .find('.my-customizer-repeatable-header-with-description-item')
      .each(function () {
        let header = $(this)
          .find('.my-customizer-repeatable-header-with-description-header')
          .val();
        let description = $(this)
          .find('.my-customizer-repeatable-header-with-description-description')
          .val();
        items.push({ header: header, description: description });
      });

    let hiddenInput = container.find(
      '.my-customizer-repeatable-header-with-description-hidden'
    );
    hiddenInput.val(JSON.stringify(items)).trigger('change');
  }

  $(document).on(
    'click',
    '.add-new-repeatable-header-description',
    function () {
      let container = $(this).closest(
        '.my-customizer-repeatable-header-with-description-wrapper'
      );
      mcAddNewRepeatableHeaderWithDescripton(container);
    }
  );

  $(document).on('click', '.remove-repeatable-header-description', function () {
    let container = $(this).closest(
      '.my-customizer-repeatable-header-with-description-wrapper'
    );
    let item = $(this).closest(
      '.my-customizer-repeatable-header-with-description-item'
    );

    // Usuń instancję TinyMCE dla textarea w elemencie
    let textareaId = item
      .find('.my-customizer-repeatable-header-with-description-description')
      .attr('id');
    removeTinyMCE(textareaId);

    // Usuń element z DOM
    item.remove();

    mcUpdateHiddenInputRepeatableHeaderWithDescripton(container);
    updateRemoveButtonState(container);
  });

  $(document).on(
    'input',
    '.my-customizer-repeatable-header-with-description-header, .my-customizer-repeatable-header-with-description-description',
    function () {
      let container = $(this).closest(
        '.my-customizer-repeatable-header-with-description-wrapper'
      );
      mcUpdateHiddenInputRepeatableHeaderWithDescripton(container);
    }
  );

  function initSortable() {
    $('.my-customizer-repeatable-header-with-description-items').sortable({
      items: '.my-customizer-repeatable-header-with-description-item',
      cursor: 'move',
      placeholder: 'sortable-placeholder',
      forcePlaceholderSize: true,
      update: function (event, ui) {
        let container = ui.item.closest(
          '.my-customizer-repeatable-header-with-description-wrapper'
        );
        mcUpdateHiddenInputRepeatableHeaderWithDescripton(container);
      },
    });
  }

  function initializeRepeatableFieldSet() {
    $('.my-customizer-repeatable-header-with-description-wrapper').each(
      function () {
        let container = $(this);
        updateRemoveButtonState(container);
        initTinyMCE();
      }
    );
    initSortable();
  }

  initTinyMCE();

  initializeRepeatableFieldSet();
});
