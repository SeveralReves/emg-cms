<template>
    <div class="">
        <Head :title="title_page" />
        <template v-for="(module, index) in modules" :key="index">
            <template v-if="module.title == 'HeroDefault'">
                <HeroDefault :props="module.props" />
            </template>
        </template>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HeroDefault from '../Components/Frontend/HeroDefault.vue'

defineProps({
    title_page: {
        type: String,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

import HeroImage from '../../images/Hero.png'
import IconArrow from '../../images/Icon-arrow.png'

const modules = [
    {
        title: 'HeroDefault',
        props: {
            hero_title: '<h2>We strive to deliver top-quality home remodels and renovations that <span>exceed your expectations</span></h2>',
            hero_text: 'Our team of experienced professionals takes pride in transforming your house into your dream home, and we’re dedicated to making your remodeling process stress-free and enjoyable.',
            hero_image: { 
                path: HeroImage, 
                alt: 'image' 
            },
            icon: { 
                path: IconArrow, 
                alt: 'image icon' 
            } 
        }
    }
]
</script>

<style>
</style>
