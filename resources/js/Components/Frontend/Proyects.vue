<script setup>
defineProps({
    props: {
        type: Object,
    },
});
</script>

<template>
    <div class="projectsp">
    <img
    v-if="props.proyectImage.path"
        class="projectsp--image"
        :alt="props.proyectImage.alt"
        :src="props.proyectImage.path"
    />
    <div class="projectsp--overlay"></div>
    <div class="header-containerp">
        <div class="header_leftp" v-html="props.header_leftp">
        </div>
        <div class="header_rightp" v-html="props.header_rightp">
        </div>
    </div>
    <div class="project_listp">
        <article v-for="projectp,index in props.projects_optionsp" :key="index" class="list_containerp">
            <img :src="projectp.image.path" :alt="projectp.image.alt" />
            <div>
                <h2 class="titlep">{{ projectp.title }}</h2>
                <img class="list_container--iconp" :src="projectp.icon.path" :alt="projectp.icon.alt" />
                <p class="descriptionp">{{ projectp.description }}</p>
                <div class="buttonp" v-html="projectsp?.button ?? 'Lean More'"></div>
            </div>
        </article>
    </div>
</div>
</template>

<style lang="scss">
/* Regla global */

.header-containerp {
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin-bottom: 20px; /* Espacio entre los headers y la lista de proyectos */
}
.projectsp{
        background-color: #000000b8;
        display: grid;
        position: relative;
        overflow: hidden;
        width: 100%;
        min-height: 100vh; /* Asegura que el contenedor cubra al menos toda la altura de la ventana */
        color: white; /* Color del texto en el contenedor */
        box-sizing: border-box;
}

.projectsp--image{
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -2; /* Asegura que la imagen esté detrás del contenido */
    filter: brightness(70%); /* Ajusta el brillo de la imagen para hacerla más oscura */
}
.projectsp--overlay{
    position: absolute;
    background-color: #000000b8;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1; /* Asegura que el overlay esté entre la imagen y el contenido */
}


/* Header izquierdo */
.header_leftp {
    flex: 2;
    padding: 2.5%; /* Espacio entre los headers */

}

/* Header derecho */
.header_rightp {
    flex: 1;
    padding: 120px 70px; /* Espacio entre los headers */

}

/* Estilos para h4 en header izquierdo */
.header_leftp > h4 {
    display: flex;
    align-items: center;
    text-align: justify;
    color: #DA6F17;
}

/* Estilos para h2 en header izquierdo */
.header_leftp > h2 {
    font-size: 67.12px;
    font-weight: 400;
    -webkit-text-fill-color: transparent;
    -webkit-background-clip: text;
    background-clip: text;
    background-image: linear-gradient(180deg, #FFFFFF, #404040);
}

/* Icono en header izquierdo */
.header_left--iconp {
    width: 22.63px;
    height: 22.63px;
    background-image: linear-gradient(to bottom, #DA6F17, #DA6F1700);
    transform: rotate(45deg);
    margin-right: 10px;
}

/* Contenedor de lista de proyectos */
.project_listp {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(9, 219.33px) auto;
    gap: 5px 70px;
    width: 50%;
    margin: 5% 25%;
}

/* Estilos para el tercer hijo de .project_listp */
.project_listp .list_containerp:nth-child(3) {
    grid-column: 2;
    grid-row-start: 2;
}

/* Contenedor de cada proyecto */
.list_containerp {
    border: 2px solid orange;
    grid-row: auto / span 3;
    width: 500px;
}

/* Imagen dentro de .list_containerp */
.list_containerp > img {
    height: 76%;
    width: 100%;
    object-fit: cover;
}

/* Div dentro de .list_containerp */
.list_containerp > div {
    color: white;
    border: 2px solid purple;
    background-image: linear-gradient(to right, #323640, #101217);
    height: 24%;
    position: relative;
}

/* Icono dentro de .list_containerp > div */
.list_container--iconp {
    width: 29px;
    height: 29px;
    top: 35.8%;
    left: 92%;
    position: absolute;
}
.description{
    font-size: 20px;
    color: #FFFFFF;
    font-weight: 400;
    text-align: justify
    ;
}

.buttonp{
    color: #FFFFFF;
    background-color: transparent;
    border-color: #70B22F;
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 20px;
    font-family: 'DM sans', sans-serif;
    font-weight: 500;
    margin: 10px;
}


</style>
