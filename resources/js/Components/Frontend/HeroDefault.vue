<script setup>
defineProps({
    props: {
        type: Object,
    },
});
</script>

<template>
    <div id="home" class="hero__default">
        <span class="hero__default--ellipse"></span>

        <img
            v-if="props.hero_image.path"
            class="hero__default--image"
            :src="props.hero_image.path"
            :alt="props.hero_image.alt"
        />
        <div class="hero__default--overlay"></div>
        <div class="hero__default--content container">
            <div class="hero__default--title">
                <span v-if="props.hero_title" v-html="props.hero_title"  data-aos="fade-up" data-aos-duration="1000"></span>
                <img
                    v-if="props.icon.path"
                    class="hero__default--icon"
                    :src="props.icon.path"
                    :alt="props.icon.alt"
                />
            </div>
            <p
                v-if="props.hero_text"
                class="hero__default--text"
                v-html="props.hero_text"
                data-aos="fade-up"
                data-aos-delay="200"
                data-aos-duration="1000"
            ></p>
        </div>
    </div>
</template>

<style lang="scss">
.hero__default {
    display: grid;
    position: relative;
    overflow: hidden;
    @media (max-width: 992px) {
        min-height: 85vh;
    }
    &--title {
        display: flex;
        flex-direction: column;
        max-width: 540px;
        align-items: flex-start;
        gap: 20px;
        h2 {
            font-family: "DM Sans", sans-serif;
            font-size: 48px;
            font-weight: 400;
            color: #fff;
            span {
                color: #e5883b;
            }
            @media (max-width: 992px) {
                font-size: 32px;
            }
        }
    }
    &--content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 100px;
        grid-row-start: 1;
        grid-column-start: 1;
        grid-row-end: 2;
        grid-column-end: 1;
        position: relative;
        height: fit-content;
        margin: auto;
        @media (max-width: 992px) {
            flex-direction: column;
            padding-top: 120px;
            padding-bottom: 60px;
            justify-content: flex-end;
            gap: 30px;
            height: 100%;
        }
    }

    &--text {
        max-width: 530px;
        font-family: "DM Sans", sans-serif;
        font-size: 20px;
        font-weight: 400;
        color: #fff;
        @media (max-width: 992px) {
            font-size: 16px;
        }
    }
    &--overlay {
        background-color: #000000b8;
        grid-row-start: 1;
        grid-column-start: 1;
        grid-row-end: 2;
        grid-column-end: 1;
    }
    &--image {
        grid-row-start: 1;
        grid-column-start: 1;
        grid-row-end: 2;
        grid-column-end: 1;
        height: 100%;
        object-fit: cover;
    }
    &--ellipse {
        position: absolute;
        display: block;
        border-radius: 50%;
        width: 1087px;
        height: 1087px;
        background-color: #e5883b;
        opacity: 0.3;
        filter: blur(100px);
        right: calc(-50%);
        bottom: calc(-50%);
        pointer-events: none;
        @media (max-width: 992px) {
            max-width: 70%;
            right: 0;
        }
    }

    &--icon {
        //   position: absolute;
        //   top: 120%;
        //   left: 0;
    }
}
</style>
