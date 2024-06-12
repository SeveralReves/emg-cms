<script setup>
defineProps({
    props: {
        type: Object,
    },
});
</script>

<template>
    <div class='container_pagec'>
    <div class='card_containerc'>
        <div class='card_container--titlec' v-html="props.card_titlec"></div>
        <div class='border_titlec'></div>
        <p class='card_container--textc'>{{ props.card_textc }}</p>
        <div class='card_container--buttonc' v-html="props.card_buttonc"></div>
    </div>

</div>

</template>

<style lang="scss">

.card_containerc{
    background: linear-gradient(90.55deg, #101217 -23.29%, #323640 95.58%);
    position: absolute bottom;

}

.card_container--titlec > h1{
    color:white;
    text-align: center;
    padding: 30px 40px;
    font-size: 60px;
    font-family: "DM sans", sans serif;
    font-weight: 400;
    
}
.border_titlec{
    border-bottom: 2px solid green ;
    justify-content: center;
    margin: 0 20%;
    

}

.card_container--textc{
    color: white;
}
.card_container--textc{
    font-family: "DM sans", sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #FFFFFF;
    text-align: center;
    padding: 50px;

}
.card_container--buttonc{
    display: flex;
    margin: auto;
    justify-content: center;
    padding: 0 0 80px 0;


}
.card_container--buttonc > button{
    color: #FFFFFF;
    background-color: #E5883B;
    border-color: #70B22F ;
    border-radius: 30px  ;
    padding: 10px 20px;
    font-size: 20px;
    font-family: 'DM sans', sans-serif;
    font-weight: 500;
    margin: 10px;
}


</style>
