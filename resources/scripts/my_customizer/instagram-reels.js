jQuery(document).ready(function ($) {
    let mediaUploader

    // Specyficzna funkcja do otwierania Media Uploader dla Instagram Reels
    function mcInstagramReelsOpenUploader(button, container) {
        $(button)
            .off('click')
            .on('click', function (e) {
                e.preventDefault()

                mediaUploader = wp.media({
                    title: 'Wybierz Instagram Reel',
                    button: { text: 'Wybierz Reel' },
                    multiple: false,
                    library: { type: 'image', context: 'instagram_reels' }, // Tylko obrazy
                })

                mediaUploader.on('select', function () {
                    const attachment = mediaUploader
                        .state()
                        .get('selection')
                        .first()
                        .toJSON()
                    const imageUrl = attachment.url
                    const reelId = attachment.id

                    // Aktualizujemy tło oraz ustawiamy data-reel-id
                    container.css('background-image', `url('${imageUrl}')`)
                    container.attr('data-reel-id', reelId)

                    // Zastępujemy przyciski akcjami dla Reel
                    container.html(`
                    <div class="my-customizer-instagram-reels-actions">
                        <button type="button" class="my-customizer-instagram-reels-replace">Zmień post</button>
                        <button type="button" class="my-customizer-instagram-reels-remove">Usuń</button>
                    </div>
                `)

                    // Aktualizujemy ukryty input
                    mcInstagramReelsUpdateHiddenInput(
                        container
                            .closest('.my-customizer-instagram-reels-wrapper')
                            .data('unique-id')
                    )

                    // Inicjalizujemy akcje dla nowo dodanych przycisków
                    mcInstagramReelsInitActions(container)
                })

                mediaUploader.open()
            })
    }

    // Specyficzna funkcja do aktualizacji hidden input
    function mcInstagramReelsUpdateHiddenInput(uniqueId) {
        const selectedReelIds = []

        // Pobieramy ID wszystkich wybranych Reel z atrybutu data-reel-id
        $(
            `.my-customizer-instagram-reels-wrapper[data-unique-id="${uniqueId}"] .my-customizer-instagram-reels-preview`
        ).each(function () {
            const reelId = $(this).attr('data-reel-id')
            if (reelId) {
                selectedReelIds.push(reelId)
            }
        })

        // Aktualizujemy ukryty input z listą wybranych Reel
        $(`.my-customizer-instagram-reels-input[data-unique-id="${uniqueId}"]`)
            .val(selectedReelIds.join(','))
            .trigger('change')
    }

    // Funkcja do resetowania obrazu
    function mcInstagramReelsResetImage(container, uniqueId) {
        container.css('background-image', 'none')
        container.removeAttr('data-reel-id')
        container.html(
            '<button type="button" class="my-customizer-instagram-reels-select">Wybierz post</button>'
        )

        // Aktualizujemy hidden input po usunięciu
        mcInstagramReelsUpdateHiddenInput(uniqueId)

        // Ponownie inicjalizujemy akcję dla nowego przycisku "Wybierz post"
        mcInstagramReelsOpenUploader(
            container.find('.my-customizer-instagram-reels-select'),
            container
        )
    }

    // Inicjalizowanie akcji dla przycisków "Zmień" i "Usuń"
    function mcInstagramReelsInitActions(container) {
        container
            .find('.my-customizer-instagram-reels-replace')
            .on('click', function (e) {
                console.log(e)
                e.preventDefault()
                const uniqueId = $(this)
                    .closest('.my-customizer-instagram-reels-wrapper')
                    .data('unique-id')
                const container = $(this).closest(
                    '.my-customizer-instagram-reels-preview'
                )
                mcInstagramReelsOpenUploader($(this), container)
            })

        container
            .find('.my-customizer-instagram-reels-remove')
            .off('click')
            .on('click', function (e) {
                e.preventDefault()
                const uniqueId = $(this)
                    .closest('.my-customizer-instagram-reels-wrapper')
                    .data('unique-id')
                const container = $(this).closest(
                    '.my-customizer-instagram-reels-preview'
                )
                mcInstagramReelsResetImage(container, uniqueId)
            })
    }

    // Inicjalizacja dla istniejących przycisków na starcie
    $(
        '.my-customizer-instagram-reels-select, .my-customizer-instagram-reels-replace'
    ).each(function () {
        const container = $(this).closest(
            '.my-customizer-instagram-reels-preview'
        )
        mcInstagramReelsOpenUploader(this, container)
    })

    $('.my-customizer-instagram-reels-preview').each(function () {
        mcInstagramReelsInitActions($(this))
    })
})
