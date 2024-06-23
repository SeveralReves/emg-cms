<script setup>
import { useField, useForm, defineRule, ErrorMessage } from "vee-validate";
import { onMounted, ref, reactive, toRefs } from "vue";
import Loader from "../Frontend/Loader.vue";
import axios from "axios";
import Swal from "sweetalert2";
import * as yup from "yup";

// Definir reglas de validación
defineRule("required", (value) => {
    console.log("Validando required para:", value); // Log de validación
    return value ? true : "This field is required";
});
defineRule("email", (value) => {
    console.log("Validando email para:", value); // Log de validación
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(value) ? true : "This must be a valid email";
});
const phoneRegExp = /^(?:\+1)?\s*\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/;


const validationSchema = yup.object({
    name: yup.string().required("Name is required"),
    phone: yup
    .string()
    .matches(phoneRegExp, 'Phone number is not valid')
    .required('Phone number is required'),
    email: yup
        .string()
        .email("This must be a valid email")
        .required("Email is required"),
    description: yup.string().required("Description is required"),
});

const { handleSubmit, resetForm } = useForm({
    validationSchema,
});

defineProps({
    props: {
        type: Object,
    },
});

const loading = ref(false);

const formValues = ref({
    phone: "",
    email: "",
    name: "",
    description: "",
});

// Definir campos de validación
const { value: nameField, errorMessage: nameError } = useField("name");
const { value: phoneField, errorMessage: phoneError } = useField("phone");
const { value: emailField, errorMessage: emailError } = useField("email");
const { value: descriptionField, errorMessage: descriptionError } =
    useField("description");

const onSubmit = handleSubmit(async (values) => {
    try {
        loading.value = true;
        document.body.style.overflow = "hidden";
        const response = await axios.post("/api/quote", values);
        if (response.data?.success) {
            console.log(response.data);
            Swal.fire({
                title: "SUCCESS!",
                text: response.data?.message,
                icon: "success",
                confirmButtonText: "OK",
                confirmButtonColor: "#e5883b",
            });
            resetForm();
        }
    } catch (error) {
        console.log("error", error);
        Swal.fire({
            title: "Error!",
            text: error?.message ?? 'A error ocurred',
            icon: "error",
            confirmButtonText: "OK",
            confirmButtonColor: "#e5883b",
        });
    } finally {
        loading.value = false;
        document.body.style.overflow = "auto";
    }
});
</script>

<template>
    <div id="quote"  class="container_pagec">
        <loader :loading="loading" />
        <div class="card_containerc">
            <div class="container">
                <div
                    class="card_container--titlec"
                    v-html="props.card_titlec"
                ></div>
                <div class="border_titlec"></div>
                <p class="card_container--textc">{{ props.card_textc }}</p>
                <form class="contact__form" @submit.prevent="onSubmit">
                    <div class="contact__form--container">
                        <div class="contact__form--column">
                            <label class="contact__form--label">{{
                                props.form.name.label
                            }}</label>
                            <input
                                type="text"
                                v-model="nameField"
                                class="contact__form--input"
                                :placeholder="props.form.name.placeholder"
                            />
                            <ErrorMessage
                                name="name"
                                class="contact__form--error"
                            />
                        </div>
                        <div class="contact__form--column">
                            <label class="contact__form--label">{{
                                props.form.phone.label
                            }}</label>
                            <input
                                type="text"
                                class="contact__form--input"
                                :placeholder="props.form.phone.placeholder"
                                v-model="phoneField"
                            />
                            <ErrorMessage
                                name="phone"
                                class="contact__form--error"
                            />
                        </div>
                        <div class="contact__form--column">
                            <label class="contact__form--label">{{
                                props.form.email.label
                            }}</label>
                            <input
                                type="text"
                                class="contact__form--input"
                                :placeholder="props.form.email.placeholder"
                                v-model="emailField"
                            />
                            <ErrorMessage
                                name="email"
                                class="contact__form--error"
                            />
                        </div>
                        <div class="contact__form--column">
                            <label class="contact__form--label">{{
                                props.form.description.label
                            }}</label>
                            <textarea
                                class="contact__form--textarea"
                                :placeholder="
                                    props.form.description.placeholder
                                "
                                v-model="descriptionField"
                            />
                            <ErrorMessage
                                name="description"
                                class="contact__form--error"
                            />
                        </div>
                        <button
                            class="button__primary contact__form--button"
                            type="submit"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.card_containerc {
    background: linear-gradient(90.55deg, #101217 -23.29%, #323640 95.58%);
    padding: 40px 0;
}

.card_container--titlec > h1,
.card_container--titlec > h2 {
    color: white;
    text-align: center;
    padding: 30px 40px;
    font-size: 60px;
    font-family: "DM sans", sans serif;
    font-weight: 400;
    @media (max-width: 992px) {
        font-size: 32px;
        padding: 32px 0 10px;
    }
}
.border_titlec {
    border-bottom: 2px solid green;
    justify-content: center;
    margin: 0 20%;
}

.card_container--textc {
    color: white;
    font-family: "DM sans", sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #ffffff;
    text-align: center;
    padding: 50px;
    @media (max-width: 992px) {
        font-size: 16px;
        padding-left: 0;
        padding-right: 0;
    }
}
.card_container--buttonc {
    display: flex;
    margin: auto;
    justify-content: center;
    padding: 0 0 80px 0;
}
.card_container--buttonc > button {
    color: #ffffff;
    background-color: #e5883b;
    border-color: #70b22f;
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 20px;
    font-family: "DM sans", sans-serif;
    font-weight: 500;
    margin: 10px;
}
.contact__form {
    &--container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        padding-bottom: 30px;
    }
    &--column {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    &--label {
        font-family: "DM sans", sans serif;
        color: #fff;
    }
    &--input {
        max-width: 90vw;
        width: 500px;
        border-radius: 5px;
        border: 2px solid #fff;
        transition: all 300ms ease-in-out;
        &:focus {
            border: 2px solid #e5883b;
        }
    }
    &--textarea {
        max-width: 90vw;
        width: 500px;
        border-radius: 5px;
        height: 100px;
        transition: all 500ms ease-in-out;
        &:focus {
            border: 2px solid #e5883b;
        }
    }
    &--button {
        margin-top: 20px;
    }
    &--error {
        color: #e53b3b;
    }
}
</style>
