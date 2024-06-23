<script setup>
import { onMounted, ref, reactive, toRefs } from "vue";

// Define props
const props = defineProps({
    logo: Object,
    menu: Array,
    button: Object,
});

// Make logo reactive
const logo = ref(props.logo);

// Set default URL if not present
onMounted(() => {
    logo.value.url = logo.value.url ?? "";
});
</script>

<template>
    <header class="header">
        <div class="header__container container">
            <a href="/" class="header__logo"
                ><img :src="logo.url" :alt="logo.alt" class="header__logo--img"
            /></a>
            <nav class="header__nav">
                <ul class="header__nav--ul">
                    <li
                        v-for="(link, i) in menu"
                        :key="i"
                        class="header__nav--li"
                    >
                        <a :href="link.url" class="header__nav--a">{{
                            link.title
                        }}</a>
                    </li>
                </ul>
            </nav>
            <a
                v-if="button?.url"
                :href="button.url"
                class="header__cta button__primary"
            >
                {{ button.title ?? "Get quote" }}
            </a>
            <button
                class="hamburger header__mobile--button hamburger--collapse"
                type="button"
            >
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </header>
    <div class="header__mobile">
        <div class="header__mobile--container container">
            <nav class="header__mobile--nav">
                <ul class="header__mobile--nav--ul">
                    <li
                        v-for="(link, i) in menu"
                        :key="i"
                        class="header__mobile--nav--li"
                    >
                        <a :href="link.url" class="header__mobile--nav--a">{{
                            link.title
                        }}</a>
                    </li>
                </ul>
            </nav>
            <a
                v-if="button?.url"
                :href="button.url"
                class="header__mobile--cta button__primary"
            >
                {{ button.title ?? "Get quote" }}
            </a>
        </div>
    </div>
</template>

<style lang="scss">
.header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 10;
    transition: all 500ms ease-in-out;
    &__container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        @media (max-width: 992px) {
            justify-content: space-between;
        }
    }
    &__nav {
        display: flex;
        justify-content: flex-end;
        flex: 1;
        @media (max-width: 992px) {
            display: none;
        }
        &--ul {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
            padding: 0;
            margin: 0;
        }
        &--a {
            font-family: "Dm sans", sans-serif;
            color: #fff;
            font-size: 20px;
        }
    }
    &__logo {
        &--img {
            max-width: 150px;
            max-height: 100px;
        }
    }
    &__cta {
        @media (max-width: 992px) {
            display: none;
        }
    }
    &__mobile {
        position: fixed;
        background-color: #071826;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9;
        transition: all 400ms ease-in-out;
        &:not(.is-active) {
            transform: translateX(100%);
        }
        &--container {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding-top: 140px;
            padding-bottom: 40px;
            justify-content: space-between;
        }
        &--button {
            @media (min-width: 992px) {
                display: none;
            }
        }
        &--nav {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            @media (min-width: 992px) {
                display: none;
            }
            &--ul {
                display: flex;
                justify-content: flex-end;
                flex-direction: column;
                align-items: flex-end;
                gap: 35px;
                padding: 0;
                margin: 0;
            }
            &--a {
                font-family: "Dm sans", sans-serif;
                color: #fff;
                font-size: 20px;
            }
        }
        &--cta {
            display: flex;
            width: fit-content;
            @media (min-width: 992px) {
                display: none;
            }
        }
    }
    .hamburger--collapse .hamburger-inner,
    .hamburger--collapse .hamburger-inner::before,
    .hamburger--collapse .hamburger-inner::after {
        background-color: #fff;
    }
}

.headroom {
    will-change: transform;
    transition: all 500ms ease-in-out, transform 200ms linear;
}
.headroom--pinned {
    transform: translateY(0%);
}
.headroom--unpinned {
    // @include mq($from: large) {
    transform: translateY(-100%);
    // }
}
.headroom--not-top{
    background-color: #071826;
    box-shadow: #071826 0px 10px 10px;
}
</style>
