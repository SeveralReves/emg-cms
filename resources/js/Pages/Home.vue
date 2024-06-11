<template>
    <div class="">
        <Head :title="title_page" />
        <template v-for="(module, index) in modules" :key="index">
            <template v-if="module.title == 'HeroDefault'">
                <HeroDefault :props="module.props" />
            </template>
            <template v-if="module.title == 'Features'">
                <Features :props="module.props" />
            </template>
        </template>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import HeroDefault from "../Components/Frontend/HeroDefault.vue";
import Features from "../Components/Frontend/Features.vue";

defineProps({
    title_page: {
        type: String,
    },
    canRegister: {
        type: Boolean,
    },
});

import HeroImage from "../../images/Hero.png";
import IconArrow from "../../images/Icon-arrow.png";
import IconFeature from "../../images/k.png";

const modules = [
    {
        title: "HeroDefault",
        props: {
            hero_title:
                "<h2>We strive to deliver top-quality home remodels and renovations that <span>exceed your expectations</span></h2>",
            hero_text:
                "Our team of experienced professionals takes pride in transforming your house into your dream home, and we’re dedicated to making your remodeling process stress-free and enjoyable.",
            hero_image: {
                path: HeroImage,
                alt: "image",
            },
            icon: {
                path: IconArrow,
                alt: "image icon",
            },
        },
    },
    {
        title: "Features",
        props: {
            items: [
                {
                    title: "Reliable Experts",
                    text: "Lorem ipsum dolor sit amet consecte. Bibendum tempus aliquam sed.",
                    icon: {
                        path: IconFeature,
                        alt: 'icon feature'
                    },
                },

                {
                    title: "Licensed Contractor",
                    text: "Lorem ipsum dolor sit amet consecte. Bibendum tempus aliquam sed.",
                    icon: {
                        path: IconFeature,
                        alt: 'icon feature'
                    },
                },

                {
                    title: "Quality Guaranteed",
                    text: "Lorem ipsum dolor sit amet consecte. Bibendum tempus aliquam sed.",
                    icon: {
                        path: IconFeature,
                        alt: 'icon feature'
                    },
                },
            ],
        },
    },
];
</script>

<style></style>
