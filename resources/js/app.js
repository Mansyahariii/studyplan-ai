import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Lenis from 'lenis'

const lenis = new Lenis({
    duration: 1.1,
    smoothWheel: true,
    smoothTouch: false,
})

function raf(time) {
    lenis.raf(time)
    requestAnimationFrame(raf)
}

requestAnimationFrame(raf)