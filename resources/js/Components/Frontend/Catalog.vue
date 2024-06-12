<script setup>
defineProps({
    props: {
        type: Object,
    },
});
</script>

<template>
    <div class="list_options">
    <div class="list_options_title">
        <p v-if="props.catalog_header_left" class="list_options--headL">
            <i class="list_options--headL-icon"></i>
            <span v-html="props.catalog_header_left"></span>
        </p>
        <h2 v-if="props.catalog_header_right" v-html="props.catalog_header_right" class="list_options--headR"></h2>
    </div>
    <div class="list_options_body">
        <article v-for="(catalog,index) in props.elements_options" :key="index" class="list_container">
            <img :src="catalog.image.path" :alt="catalog.image.alt"/>
            <div class="text_container">
                <h2 class="title">{{catalog.title}}</h2>
                <p class="description">{{catalog.description}}</p>
                <button class="button">{{catalog.button}}</button>
            </div>
        </article>
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
}

.list_options_title {
    display: flex;
} 

.list_options_body {
    display: grid;
    grid-template-columns: 1fr 1fr;
    padding: 60px;
    gap: 50px 50px; /** separación o rellenos entre filas y columnas **/
}

.list_options--headL {
    flex: 0 0 30%;
    text-align: center;
    padding: 150px 0;
    font-size: 32px;
    font-family: "DM sans", sans-serif;
    font-weight: 400;
    color: #DA6F17;    
    position: relative; /* Establece el contexto de posición para el elipse */
}

.list_options--headL::before {
    content: '';
    position: absolute;
    width: 200px;
    height: 200px;
    background-color: #E5883B; /* Color naranja */
    border-radius: 50%;
    bottom: -100px; /* Ajusta la posición verticalmente */
    left: -100px; /* Ajusta la posición horizontalmente */
    z-index: -1; /* Asegura que esté detrás del texto */
}

.list_options--headL-icon {
    display: inline-block;
    width: 22.63px;
    height: 22.63px;
    background-image: linear-gradient(180deg, #70B22F, #70B22f00);
    transform: rotate(45deg);
    margin-right: 10px;
}

.list_options--headR {
    flex: 0 0 70%;
    text-align: justify;
    font-family: "DM sans", sans-serif;
    font-weight: 400;
    font-size: 67px;
    color: #FFFFFF;
    padding: 100px;

    /* degradado */
    -webkit-text-fill-color: transparent;
    background: linear-gradient(to bottom, #FFFFFF, #404040);
    -webkit-background-clip: text;
    background-clip: text;
}

.list_container {
    display: block;
    border-radius: 8px;
    overflow: hidden;
    position: relative; /* Establece el contexto de posición para el elipse */
}

.list_container::before {
    content: '';
    position: absolute;
    width: 200px;
    height: 200px;
    background-color: #E5883B; /* Color naranja */
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
}

.title {
    font-family: "DM Sans", sans-serif;
    font-size: 41px;
    font-weight: 400;
    color: #FFFFFF;
    margin-top: 0;
}

.description {
    padding-top: 20px;
    font-family: "DM Sans", sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #FFFFFF;
}

.button {
    font-size: 20px;
    font-weight: 500;
    font-family: "DM Sans", sans-serif;
    color: #FFFFFF;
    background: #DA6F17;
    padding: 16px 12px;
    border-radius: 50px;
    margin-top: 10px; /* Espacio entre la descripción y el botón */
    align-self: flex-end; /* Alinea el botón a la derecha */
}

</style>
