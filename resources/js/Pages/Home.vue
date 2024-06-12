<template>
    <div class="">
        <Head :title="title_page" />
        <template v-for="(module, index) in modules" :key="index">
            <template v-if="module.title == 'HeroDefault'">
                <HeroDefault :props="module.props" />
            </template>
            <template v-else-if="module.title == 'Features'">
                <Features :props="module.props" />
            </template>
            <template v-else-if="module.title == 'Demostration'">
                <Demostration :props="module.props" />
            </template>
            <template v-else-if="module.title == 'CardOption'">
                <CardOption :props="module.props" />
            </template>
            <template v-else-if="module.title == 'Catalog'">
                <Catalog :props="module.props" />
            </template>
            <template v-else-if="module.title == 'Proyects'">
                <Proyects :props="module.props" />
            </template>
            <template v-else-if="module.title == 'ContactCard'">
                <ContactCard :props="module.props" />
            </template>
        </template>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import HeroDefault from "../Components/Frontend/HeroDefault.vue";
import Features from "../Components/Frontend/Features.vue";
import Demostration from "../Components/Frontend/Demostration.vue";
import CardOption from "../Components/Frontend/CardOption.vue";
import Catalog from "../Components/Frontend/Catalog.vue";
import Proyects from "../Components/Frontend/Proyects.vue";
import ContactCard from "../Components/Frontend/ContactCard.vue";


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
import IconFeat from "../../images/feat.jpg";
import Feat2 from "../../images/feat-2.jpg";
import Frame1 from "../../images/Frame-1.png";
import Frame2 from "../../images/Frame-2.png";
import Frame3 from "../../images/Frame-3.png";
import Frame4 from "../../images/Frame-4.png";
import Frame5 from "../../images/Frame-5.png";
import Frame6 from "../../images/Frame-6.png";
import Frame7 from "../../images/Frame-6.png";
import Frame8 from "../../images/Frame-6.png";
import Frame9 from "../../images/Frame-6.png";
import Frame10 from "../../images/Frame-6.png";

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
                        alt: "icon feature",
                    },
                },

                {
                    title: "Licensed Contractor",
                    text: "Lorem ipsum dolor sit amet consecte. Bibendum tempus aliquam sed.",
                    icon: {
                        path: IconFeature,
                        alt: "icon feature",
                    },
                },

                {
                    title: "Quality Guaranteed",
                    text: "Lorem ipsum dolor sit amet consecte. Bibendum tempus aliquam sed.",
                    icon: {
                        path: IconFeature,
                        alt: "icon feature",
                    },
                },
            ],
        },
    },
    {
        title: "Demostration",
        props: {
            title: '<p><i class="header_left--iconp"></i>Who We Are</p>',
            text: "<h2>WELCOME TO BITWOOD BUILD, WHERE WE STRIVE TO DELIVER TOP-QUALITY HOME REMODELS. AND RENOVATIONS THAT EXCEED YOUR EXPECTATIONS.</h2>",
            image: { path: IconFeat, alt: "image" },
            video: { path: "assets/images/poli.mp4", alt: "video" },
            subtext:
                "Whether you’re looking for a small renovation or a full-scale remodel, we’re here to make your dreams a reality. Contact us today to schedule your consultation and take the first step towards your dream home.",
            button: {
                title: "Learn More",
                url: "#",
            },
        },
    },
    {
        title: "CardOption",
        props: {
            title: "Start The Process Now!",
            text: "Lorem ipsum dolor sit amet consectetur. Iaculis ac vitae a rutrum in non nullam viverra. Est mattis dolor eget sociis quam nunc. Malesuada eget non pretium aliquet. Imperdiet id amet pulvinar eleifend mauris",
            buttons: [
                {
                    title: "Get Started on Your Dream Bathroom!",
                    url: "#",
                },
                {
                    title: "Get Started on Your Basement",
                    url: "#",
                },
                {
                    title: "Get Started on Your Dream Kitchen",
                    url: "#",
                },
            ],
        },
    },
    {
        title: "Catalog",
        props: {
            catalog_header_left: "Our Sevices",
            catalog_header_right:
                "Nulla neque lorem aliquam lectus consequat scelerisque fermentum.",
            elements_options: [
                {
                    image: {
                        path: Frame1,
                    },
                    title: "Kitchen Remodeling",
                    description:
                        "Nulla neque lorem aliquam lectus consequat scelerisque fermentum sit justo. ",
                    button: "Learn More",
                },
                {
                    image: {
                        path: Frame2,
                    },
                    title: "Bathroom Remodeling",
                    description:
                        "Nulla neque lorem aliquam lectus consequat scelerisque fermentum sit justo. ",
                    button: "Learn More",
                },
                {
                    image: {
                        path: Frame3,
                    },
                    title: "Basement Remodeling",
                    description:
                        "Nulla neque lorem aliquam lectus consequat scelerisque fermentum sit justo. ",
                    button: "Learn More",
                },
                {
                    image: {
                        path: Frame4,
                    },
                    title: "Tile & Flooring",
                    description:
                        "Nulla neque lorem aliquam lectus consequat scelerisque fermentum sit justo. ",
                    button: "Learn More",
                },
                {
                    image: {
                        path: Frame5,
                    },
                    title: "Investor Services",
                    description:
                        "Nulla neque lorem aliquam lectus consequat scelerisque fermentum sit justo. ",
                    button: "Learn More",
                },
                {
                    image: {
                        path: Frame6,
                    },
                    title: "Handyman Services",
                    description:
                        "Nulla neque lorem aliquam lectus consequat scelerisque fermentum sit justo. ",
                    button: "Learn More",
                },
            ],
        },
    },
    {
        title: "Proyects",
        props: {
            header_leftp:
                '<h4><i class="header_left--iconp"></i>Our Projects</h4><h2>Est mattis dolor eget sociis quam nunc. Malesuada eget non</h2>',
            header_rightp:
                "<p>Lorem ipsum dolor sit amet consectetur. Iaculis ac vitae a rutrum in non nullam viverra. Est mattis dolor eget sociis quam nunc. Malesuada eget non pretium aliquet. Imperdiet id amet pulvinar eleifend mauris</p><button>Learn More</button>",
            proyectImage: {
                path: Feat2,
                alt: "image",
            },
            projects_optionsp: [
                {
                    image: {
                        path: Frame7,
                        alt: "imagen 1",
                    },
                    title: "Foerster St.",
                    icon: {
                        path: IconArrow,
                        alt: "image icon",
                    },
                    description:
                        "Bathroom Remodel, Kitchen Remodel, Tile & Flooring",
                },
                {
                    image: {
                        path: Frame8,
                        alt: "imagen 2",
                    },
                    title: "Foerster St.",
                    icon: {
                        path: IconArrow,
                        alt: "image icon",
                    },
                    description:
                        "Bathroom Remodel, Kitchen Remodel, Tile & Flooring",
                },
                {
                    image: {
                        path: Frame9,
                        alt: "imagen 3",
                    },
                    title: "Foerster St.",
                    icon: {
                        path: IconArrow,
                        alt: "image icon",
                    },
                    description:
                        "Bathroom Remodel, Kitchen Remodel, Tile & Flooring",
                },
                {
                    image: {
                        path: Frame10,
                        alt: "imagen 4",
                    },
                    title: "Foerster St.",
                    icon: {
                        path: IconArrow,
                        alt: "image icon",
                    },
                    description:
                        "Bathroom Remodel, Kitchen Remodel, Tile & Flooring",
                },
            ],
        },
    },
    {
        title: "ContactCard",
        props: {
            card_titlec:
                '<h1>Call The Leading Home Remodeling Contractor Today!</h1>',
            card_textc:
                "Lorem ipsum dolor sit amet consectetur. Iaculis ac vitae a rutrum in non nullam viverra. Est mattis dolor eget sociis quam nunc. Malesuada eget non pretium aliquet. Imperdiet id amet pulvinar eleifend mauris",
            card_buttonc: "<button>Contact Now</button>",
        },
    },
];
</script>

<style></style>
