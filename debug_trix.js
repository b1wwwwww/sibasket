document.addEventListener('livewire:navigated', () => {
    const trixEditor = document.getElementById('isi_editor');
    const hiddenInput = document.getElementById('isi_input');

    if (trixEditor && hiddenInput) {
        console.log('Trix initialized, initial value:', hiddenInput.value);
        
        // Coba load manual
        if (hiddenInput.value) {
            try {
                trixEditor.editor.loadHTML(hiddenInput.value);
                console.log('Content loaded into Trix');
            } catch (e) {
                console.error('Failed to load content:', e);
            }
        }
    }
});
