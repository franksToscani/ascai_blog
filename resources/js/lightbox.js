/**
 * Visualizzatore a schermo intero per le foto della galleria.
 * Uso: <div x-data="lightbox(photos)"> ... @click="open(index)" ... </div>
 * dove photos è un array di { url, title, caption }.
 */
export default (photos = []) => ({
    photos,
    index: null,
    touchStartX: null,

    get current() {
        return this.index === null ? null : this.photos[this.index];
    },

    open(index) {
        this.index = index;
        document.body.classList.add('overflow-hidden');
        this.preload(index + 1);
    },

    close() {
        this.index = null;
        document.body.classList.remove('overflow-hidden');
    },

    next() {
        if (this.index === null) return;
        this.index = (this.index + 1) % this.photos.length;
        this.preload(this.index + 1);
    },

    prev() {
        if (this.index === null) return;
        this.index = (this.index - 1 + this.photos.length) % this.photos.length;
        this.preload(this.index - 1);
    },

    // Scarica in anticipo la foto successiva: lo scorrimento è immediato
    preload(index) {
        const photo =
            this.photos[(index + this.photos.length) % this.photos.length];
        if (photo) new Image().src = photo.url;
    },

    onKeydown(event) {
        if (this.index === null) return;
        if (event.key === 'ArrowRight') this.next();
        if (event.key === 'ArrowLeft') this.prev();
        if (event.key === 'Escape') this.close();
    },

    onTouchStart(event) {
        this.touchStartX = event.changedTouches[0].clientX;
    },

    // Scorrimento col dito: almeno 50px per cambiare foto
    onTouchEnd(event) {
        if (this.touchStartX === null) return;
        const distance = event.changedTouches[0].clientX - this.touchStartX;
        if (Math.abs(distance) > 50) distance < 0 ? this.next() : this.prev();
        this.touchStartX = null;
    },
});
