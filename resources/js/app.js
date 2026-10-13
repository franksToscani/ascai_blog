import '../css/app.css';

import Alpine from 'alpinejs';
import galleryUploader from './gallery-uploader';
import lightbox from './lightbox';

window.Alpine = Alpine;

Alpine.data('lightbox', lightbox);
Alpine.data('galleryUploader', galleryUploader);

Alpine.start();
