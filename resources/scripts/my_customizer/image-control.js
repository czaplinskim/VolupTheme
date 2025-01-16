jQuery(document).ready(function ($) {
    let mediaUploaderInstance

    // Funkcja do otwierania Media Uploader
    function openSingleImageUploader(callback) {
        if (!mediaUploaderInstance) {
            mediaUploaderInstance = wp.media({
                title: 'Wybierz obraz',
                button: {
                    text: 'Użyj tego obrazu',
                },
                multiple: false,
            })
        }

        // Usuń poprzedni callback
        mediaUploaderInstance.off('select')

        // Przypisz nowy callback
        mediaUploaderInstance.on('select', function () {
            const attachment = mediaUploaderInstance
                .state()
                .get('selection')
                .first()
                .toJSON()
            if (callback) {
                callback(attachment.url)
            }
        })

        mediaUploaderInstance.open()
    }

    // Funkcja do aktualizacji obrazka i ukrytego pola input
    function setSingleImage(container, imageUrl, uniqueId) {
        console.log(container)
        const previewContainer = container.find('.my-customizer-image-preview')
        console.log(previewContainer)
        previewContainer.css('background-image', `url(${imageUrl})`)
        previewContainer.addClass('my-customizer-image-has-preview')

        const buttonsHTML = `
            <button type="button" class="my-customizer-image-replace">Zmień obraz</button>
            <button type="button" class="my-customizer-image-remove">Usuń</button>
        `
        previewContainer.html(buttonsHTML)

        // Aktualizuj hidden input
        updateSingleImageInput(uniqueId, imageUrl)
    }

    // Funkcja do resetowania obrazka
    function resetSingleImage(container, uniqueId) {
        const previewContainer = container.find('.my-customizer-image-preview')
        previewContainer.css('background-image', 'none')
        previewContainer.removeClass('my-customizer-image-has-preview')

        const selectButtonHTML = `
            <button type="button" class="my-customizer-image-select">Wybierz obraz</button>
        `
        previewContainer.html(selectButtonHTML)

        // Zresetuj hidden input
        updateSingleImageInput(uniqueId, '')
    }

    // Funkcja do aktualizacji hidden input i wywołania zmiany w Customizerze
    function updateSingleImageInput(uniqueId, imageUrl) {
        const inputField = $(
            `.my-customizer-single-image-input[data-unique-id="${uniqueId}"]`
        )

        // Ustaw nową wartość w ukrytym polu
        inputField.val(imageUrl).trigger('change')

        // Informacja dla Customizera o zmianie
        const settingId = inputField.attr('name') // Pobieramy ID ustawienia
        wp.customize(settingId, function (setting) {
            setting.set(imageUrl) // Ustawienie nowej wartości w Customizerze
        })
    }

    // Obsługa kliknięcia przycisku "Wybierz obraz"
    $(document).on('click', '.my-customizer-image-select', function () {
        console.log($(this))
        const container = $(this).closest('.my-customizer-image-container')
        console.log(container)

        const uniqueId = container.data('unique-id')

        openSingleImageUploader((url) => {
            setSingleImage(container, url, uniqueId)
        })
    })

    // Obsługa kliknięcia przycisku "Zmień obraz"
    $(document).on('click', '.my-customizer-image-replace', function () {
        const container = $(this).closest('.my-customizer-image-container')
        const uniqueId = container.data('unique-id')

        openSingleImageUploader((url) => {
            setSingleImage(container, url, uniqueId)
        })
    })

    // Obsługa kliknięcia przycisku "Usuń obraz"
    $(document).on('click', '.my-customizer-image-remove', function () {
        const container = $(this).closest('.my-customizer-image-container')
        const uniqueId = container.data('unique-id')

        resetSingleImage(container, uniqueId)
    })
})
