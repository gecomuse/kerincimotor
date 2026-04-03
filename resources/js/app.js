import './bootstrap';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import Swiper from 'swiper';
import { Navigation, Pagination, Thumbs, Autoplay } from 'swiper/modules';
import GLightbox from 'glightbox';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'glightbox/dist/css/glightbox.css';

// ── Alpine setup ──────────────────────────────────────────────────────
Alpine.plugin(intersect);
window.Alpine = Alpine;
Alpine.start();

// ── Swiper: Hero / Testimonial carousel ──────────────────────────────
document.addEventListener('DOMContentLoaded', () => {

    // Testimonial Swiper
    if (document.querySelector('.testimonial-swiper')) {
        new Swiper('.testimonial-swiper', {
            modules: [Navigation, Pagination, Autoplay],
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            breakpoints: {
                768:  { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });
    }

    // PDP Photo Swiper
    if (document.querySelector('.pdp-swiper')) {
        const thumbsSwiper = new Swiper('.pdp-thumbs', {
            modules: [Navigation],
            slidesPerView: 4,
            spaceBetween: 8,
            freeMode: true,
            watchSlidesProgress: true,
        });

        new Swiper('.pdp-swiper', {
            modules: [Navigation, Pagination, Thumbs],
            spaceBetween: 0,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: { el: '.swiper-pagination', clickable: true },
            thumbs: { swiper: thumbsSwiper },
        });
    }

    // GLightbox for PDP
    if (document.querySelector('.glightbox')) {
        GLightbox({ selector: '.glightbox' });
    }

    // Sticky CTA bar on PDP (appears after 300px scroll)
    const stickyCta = document.getElementById('sticky-cta');
    if (stickyCta) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                stickyCta.classList.remove('translate-y-full', 'opacity-0');
                stickyCta.classList.add('translate-y-0', 'opacity-100');
            } else {
                stickyCta.classList.remove('translate-y-0', 'opacity-100');
                stickyCta.classList.add('translate-y-full', 'opacity-0');
            }
        });
    }

    // Navbar scroll effect
    const navbar = document.getElementById('main-navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-brand-black/95', 'backdrop-blur-md', 'shadow-lg', 'shadow-black/50');
            } else {
                navbar.classList.remove('bg-brand-black/95', 'backdrop-blur-md', 'shadow-lg', 'shadow-black/50');
            }
        });
    }

    // Livewire event: redirect to WhatsApp after form submit
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('redirect-to-wa', (event) => {
            if (event[0] && event[0].url) {
                setTimeout(() => { window.location.href = event[0].url; }, 1000);
            }
        });
    });
});

// ── GA4 event helper ──────────────────────────────────────────────────
window.trackWA = function(location, carName, carPrice) {
    if (typeof gtag !== 'undefined') {
        const eventName = 'wa_click_' + location;
        const params = { location };
        if (carName)  params.car_name  = carName;
        if (carPrice) params.car_price = carPrice;
        gtag('event', eventName, params);
    }
};

window.trackFilter = function(filterType, filterValue) {
    if (typeof gtag !== 'undefined') {
        gtag('event', 'filter_applied', { filter_type: filterType, filter_value: filterValue });
    }
};
