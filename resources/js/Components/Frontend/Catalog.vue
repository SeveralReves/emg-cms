<script setup>
defineProps({
    props: {
        type: Object,
    },
});
</script>

<template>
    <div id="services" class="list_options">
        <div class="container">
            <div class="list_options_title">
                <p v-if="props.catalog_header_left" class="list_options--headL">
                    <i class="list_options--headL-icon"></i>
                    <span v-html="props.catalog_header_left"></span>
                </p>
                <h2
                    v-if="props.catalog_header_right"
                    v-html="props.catalog_header_right"
                    class="list_options--headR"
                ></h2>
            </div>
            <div class="list_options_body" >
                <article
                    v-for="(catalog, index) in props.elements_options"
                    :key="index"
                    class="list_container"
                >
                    <img :src="catalog.image.path" :alt="catalog.image.alt" />
                    <div class="text_container">
                        <h2 class="title">{{ catalog.title }}</h2>
                        <p class="description">{{ catalog.description }}</p>
                        <a class="button" :href="catalog.button.url" target="_blank" rel="noopener noreferrer">{{ catalog.button.title }}</a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
/** OMITIR: Reseteo de estilos **/
body {
    margin: 0;
}

* {
    box-sizing: border-box;
}
/********************************/

/** Styles **/
.list_options {
    background: black;
    padding: 80px 30px;
    position: relative; /* Establece el contexto de posición para los elementos absolutos */
    @media (max-width: 992px) {
        padding-left: 0;
        padding-right: 0;
}
}

.list_options_title {
    display: flex;
    @media (max-width: 992px) {
        flex-direction: column;
    }
}

.list_options_body {
    display: grid;
    grid-template-columns: 1fr 1fr;
    padding: 60px;
    gap: 50px 50px; /** separación o rellenos entre filas y columnas **/
    @media (max-width: 992px) {
        padding: 40px 0;
        display: flex;
        flex-direction: column;
    }
}

.list_options--headL {
    flex: 0 0 30%;
    text-align: center;
    padding: 150px 0;
    font-size: 32px;
    font-family: "DM sans", sans-serif;
    font-weight: 400;
    color: #da6f17;
    position: relative; /* Establece el contexto de posición para el elipse */
    @media (max-width: 992px) {
        padding: 0;
        text-align: left;
    }
}

.list_options--headL::before {
    content: "";
    position: absolute;
    width: 200px;
    height: 200px;
    background-color: #e5883b; /* Color naranja */
    border-radius: 50%;
    bottom: -100px; /* Ajusta la posición verticalmente */
    left: -100px; /* Ajusta la posición horizontalmente */
    z-index: -1; /* Asegura que esté detrás del texto */
}

.list_options--headL-icon {
    display: inline-block;
    width: 22.63px;
    height: 22.63px;
    background-image: linear-gradient(180deg, #70b22f, #70b22f00);
    transform: rotate(45deg);
    margin-right: 10px;
}

.list_options--headR {
    flex: 0 0 70%;
    text-align: left;
    font-family: "DM sans", sans-serif;
    font-weight: 400;
    font-size: 67px;
    color: #ffffff;
    padding: 100px;

    /* degradado */
    -webkit-text-fill-color: transparent;
    background: linear-gradient(to bottom, #ffffff, #404040);
    -webkit-background-clip: text;
    background-clip: text;
    @media (max-width: 992px) {
        padding: 0;
        font-size: 32px;
    }
}

.list_container {
    display: block;
    border-radius: 8px;
    overflow: hidden;
    position: relative; /* Establece el contexto de posición para el elipse */
}

.list_container::before {
    content: "";
    position: absolute;
    width: 200px;
    height: 200px;
    background-color: #e5883b; /* Color naranja */
    border-radius: 50%;
    bottom: -100px; /* Ajusta la posición verticalmente */
    left: -100px; /* Ajusta la posición horizontalmente */
    z-index: -1; /* Asegura que esté detrás del contenido */
}

.list_container img {
    display: block;
    width: 100%;
    height: auto; /* Mantener la proporción de la imagen */
}

.text_container {
    padding: 20px;
    display: flex;
    flex-direction: column;
    @media (max-width: 992px) {
        padding-left: 0;
        padding-right: 0;
    }
}

.title {
    font-family: "DM Sans", sans-serif;
    font-size: 41px;
    font-weight: 400;
    color: #ffffff;
    margin-top: 0;
}

.description {
    padding-top: 20px;
    font-family: "DM Sans", sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #ffffff;
}

.button {
    font-size: 20px;
    font-weight: 500;
    font-family: "DM Sans", sans-serif;
    color: #ffffff;
    background: #da6f17;
    padding: 10px 25px;
    border-radius: 50px;
    margin-top: 10px; /* Espacio entre la descripción y el botón */
    align-self: flex-end; /* Alinea el botón a la derecha */
}
</style>
