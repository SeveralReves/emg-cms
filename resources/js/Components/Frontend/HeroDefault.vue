<script setup>
defineProps({
    props: {
        type: Object,
    },
});
</script>

<template>
    <div class="hero__default">
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
                <span v-if="props.hero_title" v-html="props.hero_title"></span>
                <img
                    v-if="props.icon.path"
                    class="hero__default--icon"
                    :src="props.icon.path"
                    :alt="props.icon.alt"
                />
            </div>
            <p v-if="props.hero_text" class="hero__default--text" v-html="props.hero_text"></p>
        </div>
    </div>
</template>

<style lang="scss">
.hero__default {
    display: grid;
    position: relative;
    overflow: hidden;
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
    }

    &--text {
        max-width: 530px;
        font-family: "DM Sans", sans-serif;
        font-size: 20px;
        font-weight: 400;
        color: #fff;
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
    }
    &--ellipse {
      position: absolute;
      display: block;
      border-radius: 50%;
      width: 1087px;
      height: 1087px;
      background-color: #E5883B;
      opacity: 0.3;
      filter: blur(100px);
      right: calc(-50% );
      bottom: calc(-50% );
      pointer-events: none;
    }
    
    &--icon{
    //   position: absolute;
    //   top: 120%;
    //   left: 0;
    }
}

</style>