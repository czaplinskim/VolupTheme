jQuery(document).ready(function ($) {
    const dragIconUrl = $('#my-customizer-repeatable-image-dragicon').attr(
        'src'
    )

    const openMediaUploader = (callback) => {
        const frame = wp.media({
            title: 'Wybierz obraz',
            button: {
                text: 'Użyj tego obrazu',
            },
            multiple: false,
        })

        frame.on('select', () => {
            const attachment = frame.state().get('selection').first().toJSON()
            if (callback) {
                callback(attachment.url)
            }
        })

        frame.open()
    }

    const setImage = (container, imageUrl, uniqueId) => {
        const thumbnailHTML = `
            <button type="button" class="my-customizer-repeatable-image-remove">Usuń</button>
            <button type="button" class="my-customizer-repeatable-image-replace">Zmień obraz</button>
        `
        container.css('background-image', `url('${imageUrl}')`)
        container.addClass('my-customizer-repeatable-image-has-image')
        container.html(thumbnailHTML)

        // Dodaj nowy pusty kontener na końcu
        const outerContainer = container.closest(
            '.my-customizer-repeatable-image-outer-container'
        )
        const emptyContainers = outerContainer.find(
            '.my-customizer-repeatable-image-container:has(button.my-customizer-repeatable-image-select)'
        ).length

        if (emptyContainers === 0) {
            addNewImageField(outerContainer, uniqueId)
        }

        updateHiddenInput(uniqueId)
    }

    const resetImage = (container, uniqueId) => {
        const containerCount = container
            .closest('.my-customizer-repeatable-image-outer-container')
            .find('.my-customizer-repeatable-image-container').length

        if (containerCount > 1) {
            container
                .closest('.my-customizer-repeatable-image-container')
                .remove()
        } else {
            const emptyHTML = `
                <button type="button" class="my-customizer-repeatable-image-select">Wybierz obraz</button>
            `
            container.css('background-image', 'none')
            container.removeClass('my-customizer-repeatable-image-has-image')
            container.html(emptyHTML)
        }

        updateHiddenInput(uniqueId)
    }

    const addNewImageField = (outerContainer, uniqueId) => {
        const newImageHTML = `
            <div class="my-customizer-repeatable-image-container" data-unique-id="${uniqueId}">
                <div class="my-customizer-repeatable-image-preview" style="background-image: none;">
                    <button type="button" class="my-customizer-repeatable-image-select">Wybierz obraz</button>
                </div>
            </div>
        `
        outerContainer.append(newImageHTML)
    }

    const updateHiddenInput = (uniqueId) => {
        const imageUrls = []
        $(
            `.my-customizer-repeatable-image-outer-container[data-unique-id="${uniqueId}"] .my-customizer-repeatable-image-preview`
        ).each(function () {
            const imageUrl = $(this)
                .css('background-image')
                .replace(/^url\(['"](.+)['"]\)$/, '$1')
            if (imageUrl !== 'none') {
                imageUrls.push(imageUrl)
            }
        })
        $(`.my-customizer-repeatable-image-input[data-unique-id="${uniqueId}"]`)
            .val(imageUrls.join(','))
            .trigger('change')
    }

    $(document).on(
        'click',
        '.my-customizer-repeatable-image-select, .my-customizer-repeatable-image-replace',
        function () {
            const uniqueId = $(this)
                .closest('.my-customizer-repeatable-image-outer-container')
                .data('unique-id')
            const container = $(this).closest(
                '.my-customizer-repeatable-image-preview'
            )
            openMediaUploader((url) => {
                setImage(container, url, uniqueId)
            })
        }
    )

    $(document).on(
        'click',
        '.my-customizer-repeatable-image-remove',
        function () {
            const uniqueId = $(this)
                .closest('.my-customizer-repeatable-image-outer-container')
                .data('unique-id')
            const container = $(this).closest(
                '.my-customizer-repeatable-image-preview'
            )
            resetImage(container, uniqueId)
        }
    )

    // Dodaj pierwszy pusty kontener po załadowaniu strony
    $('.my-customizer-repeatable-image-outer-container').each(function () {
        const uniqueId = $(this).data('unique-id')

        if (
            $(this).find('.my-customizer-repeatable-image-container').length >=
            1
        ) {
            addNewImageField($(this), uniqueId)
        }
    })

    // Implementacja drag and drop
    $('.my-customizer-repeatable-image-outer-container').sortable({
        items: '.my-customizer-repeatable-image-container', // Wszystkie elementy są potencjalnie przeciągane
        update: function () {
            const uniqueId = $(this).data('unique-id')
            updateHiddenInput(uniqueId)
        },
    })
})
