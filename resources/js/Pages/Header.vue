<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { defineComponent, reactive, ref, onMounted } from "vue";
import { useField, useForm, defineRule, ErrorMessage } from "vee-validate";
// import * as yup from 'yup';

// Definir reglas de validación
defineRule("required", (value) => (value ? true : "This field is required"));

const props = defineProps({
    options: {
        type: Object,
    },
    structure: {
        type: Object,
    },
});

const handleFileChange = (event, fieldName) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            formValues[fieldName].url = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        formValues[fieldName].url = "";
    }
};

const initializeFormValues = (structure) => {
    const formValues = {};
    structure.forEach((item) => {
        if (item.type === "array") {
            formValues[item.name] = [{}];
            //   item.structure.forEach(subItem => {
            //     formValues[item.name][0][subItem.name] = '';
            //   });
        } else if (item.type === "image") {
            formValues[item.name] = { url: "", alt: "" };
        } else if (item.type === "button") {
            formValues[item.name] = { url: "", title: "" };
        } else {
            formValues[item.name] = "";
        }
    });
    return formValues;
};
const formValues = reactive(initializeFormValues(props.structure));

const handleSubmit = () => {
    const formData = new FormData();
    buildFormData(props.structure, formData, formValues);

    // Aquí puedes enviar formData a tu API, por ejemplo con axios
    // axios.post('tu-api-url', formData);

    // Log para ver los resultados
    for (let pair of formData.entries()) {
        console.log(pair[0] + ": " + pair[1]);
    }
};

const buildFormData = (dataStructure, formData, formValues) => {
    dataStructure.forEach((item) => {
        const { type, name, structure } = item;
        if (type === "array") {
            formValues[name].forEach((subItem, index) => {
                structure.forEach((subField) => {
                    formData.append(
                        `${name}[${index}][${subField.name}]`,
                        subItem[subField.name]
                    );
                });
            });
        } else if (type === "image") {
            formData.append(
                name,
                JSON.stringify({
                    url: formValues[name].url,
                    alt: formValues[name].alt,
                })
            );
        } else if (type === "button") {
            formData.append(
                name,
                JSON.stringify({
                    url: formValues[name].url,
                    title: formValues[name].title,
                })
            );
        } else {
            formData.append(name, formValues[name]);
        }
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Header Custom
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form class="form__custom" @submit.prevent="handleSubmit">
                        <div class="form__custom--container">
                            <div
                                class="form__custom--column"
                                v-for="item in props.structure"
                                :key="item.name"
                            >
                                <label
                                    class="form__custom--label"
                                    :for="item.name"
                                    >{{ item.label }}</label
                                >
                                <div v-if="item.type === 'text'">
                                    <input
                                        type="text"
                                        :id="item.name"
                                        v-model="formValues[item.name]"
                                    />
                                    <ErrorMessage :name="item.name" />
                                </div>
                                <div v-if="item.type === 'image'">
                                    <input
                                        type="file"
                                        :id="item.name"
                                        @change="
                                            (e) =>
                                                handleFileChange(e, item.name)
                                        "
                                    />
                                    <img
                                        v-if="formValues[item.name].url"
                                        :src="formValues[item.name].url"
                                        alt="Image preview"
                                    />
                                    <input
                                        type="text"
                                        :id="item.name + '-alt'"
                                        v-model="formValues[item.name].alt"
                                        placeholder="Alt text"
                                    />
                                    <ErrorMessage :name="item.name" />
                                </div>
                                <div v-if="item.type === 'button'">
                                    <input
                                        type="text"
                                        :id="item.name + '-url'"
                                        v-model="formValues[item.name].url"
                                        placeholder="URL"
                                    />
                                    <input
                                        type="text"
                                        :id="item.name + '-title'"
                                        v-model="formValues[item.name].title"
                                        placeholder="Title"
                                    />
                                    <ErrorMessage :name="item.name" />
                                </div>
                                <div v-if="item.type === 'array'">
                                    <table class="form__custom--table">
                                        <tr class="form__custom--table-tr">
                                            <th
                                                v-for="(
                                                    column, c
                                                ) in item.structure"
                                                :key="`${c}-${item.name}`"
                                                class="form__custom--table-th"
                                            >
                                                {{ column.label }}
                                            </th>
                                        </tr>
                                    </table>
                                    <div
                                        v-for="(subItem, index) in formValues[
                                            item.name
                                        ]"
                                        :key="index"
                                    >
                                        <div
                                            v-for="subField in item.structure"
                                            :key="subField.name"
                                        >
                                            <input
                                                type="text"
                                                :id="
                                                    item.name +
                                                    '-' +
                                                    subField.name +
                                                    '-' +
                                                    index
                                                "
                                                v-model="subItem[subField.name]"
                                                :placeholder="subField.label"
                                            />
                                            <ErrorMessage
                                                :name="subField.name"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss">
.form__custom {
    &--container {
        padding: 10px 30px;
    }
    &--table {
        background-color: #ede9e9;
        width: 100%;
        &-tr {
        }
        &-th {
            padding: 5px 10px;
            text-align: left;
            background-color: #818cf8;
            border: 1px solid #000;
        }
    }
}
</style>
