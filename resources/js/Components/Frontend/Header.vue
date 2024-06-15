<script setup>
import { onMounted, ref, reactive, toRefs } from "vue";

// Define props
const props = defineProps({
    logo: Object,
    menu: Array,
    button: Object
});

// Make logo reactive
const logo = ref(props.logo);

// Set default URL if not present
onMounted(() => {
    logo.value.url = logo.value.url ?? '';
});
</script>

<template>
   <header class="header">
    <div class="header__container container">
        <a href="/" class="header__logo"><img :src="logo.url" :alt="logo.alt" class="header__logo--img"></a>
        <nav class="header__nav">
            <ul class="header__nav--ul">
                <li v-for="(link,i) in menu" :key="i" class="header__nav--li">
                    <a :href="link.url" class="header__nav--a">{{link.title}}</a>
                </li>
            </ul>
        </nav>
        <a v-if="button?.url" :href="button.url" class="header__cta button__primary">
            {{button.title ?? 'Get quote'}}
        </a>
    </div>
   </header>
</template>

<style lang="scss">
    .header{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10;
        transition: all 500ms ease-in-out;
        &__container{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }
        &__nav{
            display: flex;
            justify-content: flex-end;
            flex: 1;
            &--ul{
                display: flex;
                justify-content: flex-end;
                align-items: center;
                gap: 15px;
                padding: 0;
                margin: 0;
            }
            &--a{
                font-family: 'Dm sans', sans-serif;
                color: #fff;
                font-size: 20px;
            }
        }
        &__logo{
            &--img{
                max-width: 150px;
                max-height: 100px;
            }
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
</style>
