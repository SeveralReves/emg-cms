<script setup>
defineProps({
    props: {
        type: Object,
    },
});
</script>

<template>
    <ul class="features">
        <div class="container features__container">
            <li
                v-for="(feature, index) in props.items"
                :key="index"
                class="features__item"
            >
                <img :src="feature.icon.path" :alt="feature.icon.alt" />
                <h2 class="title">{{ feature.title }}</h2>
                <br />
                <p class="text">{{ feature.text }}</p>
            </li>
        </div>
    </ul>
</template>

<style lang="scss">
.features {
    display: flex;
    flex-direction: row;
    align-content: center;
    justify-content: space-around;
    padding: 80px 30px;
    background: linear-gradient(90.55deg, #031a39 -23.29%, #071826 95.58%);
    color: #ffffff;
    list-style: none;
    &__container {
        display: flex;
        justify-content: space-between;
        @media (max-width: 992px) {
            gap: 60px;
            flex-direction: column;
        }
    }

    &__item {
        width: 30%;
        min-height: 60px;
        padding-left: 3rem;
        box-sizing: border-box;
        &:not(:first-child) {
            @media (min-width: 992px) {
                border-left: 1px solid white;
            }
        }
        @media (max-width: 992px) {
            width: 100%;
            padding: 0;
        }
        & > img {
            border: 1px solid orange;
            min-height: 20px;
            min-width: 20px;
        }
        .title {
            font-family: "DM sans", sans-serif;
            font-size: 40px;
            // width: 900px;
            padding: 0;
            border: red;
            font-weight: 500;
            margin: 70px 0 0 0;
            @media (max-width: 992px) {
                margin-top: 20px;
            font-size: 28px;
        }
        }

        .text {
            color: #ffffff;
            font-weight: 400;
            font-size: 20px;
            font-family: "DM sans", sans-serif;
        }
    }
}
</style>
