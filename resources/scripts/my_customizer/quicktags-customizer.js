jQuery(document).ready(function ($) {
    $('.quicktags-customizer-editor').each(function () {
        let editorId = $(this).attr('id')

        // Jeśli element ma ID, zainicjuj quicktags dla tego pola tekstowego
        if (editorId) {
            // Inicjalizacja Quicktags (WordPress'owego edytora HTML)
            QTags({
                id: editorId, // Przekazujemy ID elementu textarea
            })
            QTags._buttonsInit() // Inicjalizacja przycisków
        }
    })
})
