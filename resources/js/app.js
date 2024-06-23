import './bootstrap';
import '../css/app.css';
import '../scss/app.scss';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    // Configuración de AOS
    offset: 120, // distancia desde el borde del viewport para activar la animación
    delay: 0, // valores desde 0 a 3000, con paso de 50ms
    duration: 400, // valores desde 0 a 3000, con paso de 50ms
    easing: 'ease', // tipo de easing predeterminado para animaciones AOS
    once: false, // si la animación debe ocurrir solo una vez - mientras se desplaza hacia abajo
    mirror: false, // si la animación debe ocurrir cada vez que se desplaza hacia arriba/pabajo
    anchorPlacement: 'top-bottom', // define qué posición del elemento con respecto a la ventana debe activar la animación
  });

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});


import Headroom from "headroom.js";
// grab an element

window.addEventListener("load", (event) => {

    const myElement = document.querySelector(".header");
    if(myElement){
        // construct an instance of Headroom, passing the element
        const headroom  = new Headroom(myElement);
        // initialise
        headroom.init();
    }

    const buttonMobile = document.querySelector(".header__mobile--button");
    const menuMobile = document.querySelector(".header__mobile");
    if(buttonMobile && menuMobile){
        buttonMobile.addEventListener('click', () => {
            menuMobile.classList.toggle('is-active');
            buttonMobile.classList.toggle('is-active');
            if(buttonMobile.classList.contains('is-active')){
                document.body.style.overflow = "hidden";
            }else{
                document.body.style.overflow = "auto";
            }
        })
    }
  });