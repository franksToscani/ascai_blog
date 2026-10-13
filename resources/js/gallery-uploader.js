/**
 * Caricamento di più foto nella galleria, una richiesta per foto:
 * nessuna richiesta supera i limiti del server e un errore non blocca le altre.
 * Uso: <form x-data="galleryUploader('/admin/galleria', '/admin/galleria?album=1')" @submit.prevent="upload()">
 */
export default (uploadUrl, doneUrl) => ({
    items: [],
    uploading: false,
    finished: false,

    get doneCount() {
        return this.items.filter((item) => item.status === 'done').length;
    },

    get errorCount() {
        return this.items.filter((item) => item.status === 'error').length;
    },

    select(event) {
        this.items.forEach((item) => URL.revokeObjectURL(item.preview));
        this.items = Array.from(event.target.files).map((file) => ({
            file,
            name: file.name,
            preview: URL.createObjectURL(file),
            status: 'waiting', // waiting | uploading | done | error
            error: null,
        }));
        this.finished = false;
    },

    async upload() {
        if (this.uploading || this.items.length === 0) return;
        this.uploading = true;

        const form = this.$root;
        const token = form.querySelector('input[name="_token"]').value;

        for (const item of this.items) {
            if (item.status === 'done') continue;
            item.status = 'uploading';

            const data = new FormData();
            data.append('image', item.file);
            data.append(
                'album_id',
                form.querySelector('[name="album_id"]').value,
            );
            if (form.querySelector('[name="is_visible"]').checked)
                data.append('is_visible', '1');

            try {
                const response = await fetch(uploadUrl, {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: data,
                });

                if (response.ok) {
                    item.status = 'done';
                } else {
                    const body = await response.json().catch(() => ({}));
                    item.status = 'error';
                    item.error =
                        body.errors?.image?.[0] ??
                        body.message ??
                        (response.status === 413
                            ? 'File troppo grande'
                            : 'Errore ' + response.status);
                }
            } catch {
                item.status = 'error';
                item.error = 'Connessione interrotta';
            }
        }

        this.uploading = false;
        this.finished = true;

        if (this.errorCount === 0) window.location.href = doneUrl;
    },
});
