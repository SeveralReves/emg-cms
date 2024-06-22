<script setup>
defineProps({
    props: {
        type: Object,
    },
});
</script>

<template>
    <div class="container_page">
        <div class="card_container container">
            <h2 class="card_container--title">{{ props.title }}</h2>
            <div class="border_title"></div>
            <p class="card_container--text">{{ props.text }}</p>
            <div class="card_container--button">
                <a
                    v-for="(button, index) in props.buttons"
                    :key="index"
                    :href="button.url"
                    class="card_container--a"
                    >{{ button.title }}</a
                >
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.container_page {
    background-color: black;
    position: relative;
    width: 100%;
    padding: 100px 0;
    // min-height: 150vh; /* Incrementa la altura mínima para hacer el contenedor más alto */
    box-sizing: border-box; /* Asegura que el padding se incluya en el tamaño total del contenedor */
    overflow: hidden; /* Para asegurar que el elipse no se desborde */
    @media (max-width: 992px) {
        padding: 0;
    }
}

.container_page::before {
    // content: '';
    position: absolute;
    width: 800px;
    height: 800px;
    background-color: rgba(
        229,
        136,
        59,
        0.3
    ); /* Color naranja menos intenso con opacidad */
    border-radius: 50%;
    filter: blur(100px);
    bottom: -100px; /* Posiciona el elipse parcialmente fuera del contenedor */
    right: -200px; /* Posiciona el elipse parcialmente fuera del contenedor */
    pointer-events: none; /* Para que no interfiera con otros elementos */
    z-index: 0; /* Asegura que esté detrás de otros elementos */
}

.card_container {
    background: linear-gradient(90.55deg, #101217 -23.29%, #323640 95.58%);
    box-sizing: border-box; /* Asegura que el padding se incluya en el tamaño total del contenedor */
    overflow: hidden; /* Asegura que el elipse no se desborde del card container */
    z-index: 1; /* Asegura que esté sobre el elipse del contenedor padre */
    background-clip: padding-box; /* Evita que el color del elipse del contenedor padre afecte el card container */
    &--a {
        border: 1px solid #70b22f;
    }
    @media (max-width: 992px) {
        padding-top: 30px;
    }
}

.card_container::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 400px;
    background-color: rgba(
        229,
        136,
        59,
        0.3
    ); /* Color naranja menos intenso con opacidad */
    border-radius: 50%;
    filter: blur(100px);
    bottom: -200px; /* Posiciona el elipse parcialmente fuera del contenedor */
    left: -200px; /* Posiciona el elipse parcialmente fuera del contenedor */
    pointer-events: none; /* Para que no interfiera con otros elementos */
    z-index: 0; /* Asegura que esté detrás del contenido del card container */
}

.card_container--title {
    color: white;
    text-align: center;
    padding: 30px 100px;
    font-size: 60px;
    font-family: "DM sans", sans-serif;
    font-weight: 400;

    @media (max-width: 992px) {
        font-size: 38px;
        padding-left: 0;
        padding-right: 0;
        padding-bottom: 10px;
    }
}

.border_title {
    border-bottom: 2px solid green;
    justify-content: center;
    margin: 0 30%;
    @media (max-width: 992px) {
        padding-left: 0;
        padding-right: 0;
    }
}

.card_container--text {
    color: white;
    font-family: "DM sans", sans-serif;
    font-size: 20px;
    font-weight: 400;
    text-align: center;
    padding: 50px;
    @media (max-width: 992px) {
        padding-left: 0;
        padding-right: 0;
    }
}

.card_container--button {
    display: flex;
    margin: auto;
    justify-content: center;
    padding: 0 0 80px 0;
    @media (max-width: 992px) {
        flex-direction: column;
    }
}

.card_container--button a {
    color: #ffffff;
    background-color: transparent;
    border-color: #70b22f;
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 20px;
    font-family: "DM sans", sans-serif;
    font-weight: 500;
    margin: 10px;
    @media (max-width: 992px) {
        text-align: center;
    }
}
</style>
