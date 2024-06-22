<script setup>
defineProps({
    props: {
        type: Object,
    },
});
</script>

<template>
    <div class="demo_default">
        <span class="demo_default--ellipse"></span>
        <span class="demo_default--ellipse-top-right"></span>
        <img
            v-if="props.image.path"
            class="demo_default--image"
            :src="props.image.path"
            :alt="props.image.alt"
        />
        <div class="demo_default--overlay"></div>
        <div class="demo_default--content container">
            <div class="demo_default--head" v-html="props.title"></div>
            <!-- <img class="demo--head-icon" :src="props.projectp.icon.path }}" alt="{{ projectp.icon.alt }}" /> -->
            <div class="demo_default--body" v-html="props.text"></div>

            <video
                v-if="props.video.path"
                class="demo_default--video"
                :src="props.video.path"
                width="100%"
                no-controls
                autoplay
                muted
            >
                Tu navegador no soporta el elemento de video.
            </video>

            <div class="demo_default--text" v-html="props.subtext"></div>
            <a
                v-if="props.button.url"
                :href="props.button.url"
                class="demo_default--button"
                >{{ props.button.title ?? "See more" }}</a
            >
        </div>
    </div>
</template>

<style lang="scss">
.demo_default {
    background-color: #000000b8;
    display: grid;
    position: relative;
    // overflow: hidden;
    width: 100%;
    min-height: 100vh; /* Asegura que el contenedor cubra al menos toda la altura de la ventana */
    color: white; /* Color del texto en el contenedor */
    box-sizing: border-box;
    overflow: hidden;
}

.demo_default--ellipse {
    position: absolute;
    display: block;
    border-radius: 50%;
    width: 1087px;
    height: 1087px;
    background-color: #e5883b;
    opacity: 0.3;
    filter: blur(100px);
    right: -50%;
    bottom: -40%;
    pointer-events: none;
    z-index: 1;
}

.demo_default--ellipse-top-right {
    position: absolute;
    display: block;
    border-radius: 50%;
    width: 500px;
    height: 500px;
    background-color: #e5883b;
    opacity: 0.28; /* Reducida la intensidad */
    filter: blur(50px);
    top: -150px;
    left: -150px;
    pointer-events: none;
}

.demo_head--icon {
    width: 22.63px;
    height: 22.63px;
    background-image: linear-gradient(to bottom, #da6f17, #da6f1700);
    transform: rotate(45deg);
    margin-right: 10px;
}

.demo_default--image {
    grid-row-start: 1;
    grid-column-start: 1;
    grid-row-end: 2;
    grid-column-end: 1;
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -2; /* Asegura que la imagen esté detrás del contenido */
    filter: brightness(
        70%
    ); /* Ajusta el brillo de la imagen para hacerla más oscura */
}

.demo_default--overlay {
    position: absolute;
    background-color: #000000b8;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1; /* Asegura que el overlay esté entre la imagen y el contenido */
}

.demo_default--content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 2; /* Asegura que el contenido esté sobre la imagen y el overlay */
    padding: 20px;
    text-align: center;
}

.demo_default--head {
    color: #e5883b;
    font-size: 32px;
    font-family: "DM Sans", sans-serif;
    font-weight: 400;
    padding-top: 100px;
    @media (max-width: 992px) {
        font-size:28px;
    }
}

.demo_default--body h2 {
    font-size: 58px;
    font-family: "DM Sans", sans-serif;
    font-weight: 400;
    color: #ffffff;
    margin: 35px 0 100px 0;
    padding: 0 6%;
    -webkit-text-fill-color: transparent;
    background: linear-gradient(to bottom, #ffffff, #404040);
    -webkit-background-clip: text;
    background-clip: text;
    @media (max-width: 992px) {
        font-size: 32px;
        padding: 0;
    }
}

.demo_default--video {
    margin: auto;
}

.demo_default--text {
    font-family: "DM Sans", sans-serif;
    font-size: 24px;
    color: #ffffff;
    margin: 0 20%;
    padding: 70px;
    @media (max-width: 992px) {
        padding: 0;
        font-size: 18px;
        margin: 30px 0 0;
    }
}

.demo_default--button {
    margin: auto;
}

.demo_default--button {
    color: #ffffff;
    background-color: transparent;
    border-color: #70b22f;
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 20px;
    font-family: "DM sans", sans-serif;
    font-weight: 500;
    margin: 10px 10px 30px 10px;
    transition: all 500ms ease-in-out;
    &:hover {
        background-color: #51574b; /* Cambia el color de fondo al pasar el ratón */
    }
}
</style>
