<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { defineComponent, reactive, ref, onMounted } from "vue";
import { useField, useForm, defineRule, ErrorMessage } from "vee-validate";
// import * as yup from 'yup';
import axios from "axios";
import Swal from "sweetalert2";
import Loader from "../../js/Components/Frontend/Loader.vue";

const loading = ref(false);
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
    const file = event?.target?.files[0] ?? undefined;
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
            formValues[item.name] = [];
        } else if (item.type === "image") {
            formValues[item.name] = {
                url: props.options[item.name].url ?? "",
                alt: props.options[item.name].alt ?? "",
            };
        } else if (item.type === "button") {
            formValues[item.name] = {
                url: props.options[item.name].url ?? "",
                title: props.options[item.name].title ?? "",
            };
        } else {
            formValues[item.name] = props.options[item.name] ?? "";
        }
    });
    return formValues;
};
const initializeFormArrays = (structure) => {
    const formArray = {};
    structure.forEach((item) => {
        if (item.type === "array") {
            formArray[item.name] = [];
            formValues[item.name] = props.options[item.name] ?? [];
        }
    });
    return formArray;
};
const initializeEditArrays = (structure) => {
    const editArray = {};
    structure.forEach((item) => {
        if (item.type === "array") {
            editArray[item.name] = false;
        }
    });
    return editArray;
};

const deleteElementArray = (name, data) => {
    formValues[name] = formValues[name].filter(item => item.id !== data.id);
};

const addNewEntry = (name) => {
    formArrays[name].push({});
};

const saveEntry = (name, index) => {
    // Implementación personalizada para guardar cada entrada si es necesario
    formValues[name].push(formArrays[name][index]);
    formArrays[name].splice([index], 1);
};

const removeImage = (name) => {
    formValues[name].url = "";
    formValues[name].alt = "";
    // Encuentra el input de archivo y resetea su valor
    const fileInput = document.getElementById(name);
    if (fileInput) {
        fileInput.value = null;
    }
};

const formValues = reactive(initializeFormValues(props.structure));
const formArrays = reactive(initializeFormArrays(props.structure));
const editArrays = reactive(initializeEditArrays(props.structure));

const handleSubmit = async () => {
    const formData = new FormData();
    buildFormData(props.structure, formData, formValues);
    try {
        // Aquí puedes enviar formData a tu API, por ejemplo con axios
        const response = await axios.post("/api/header", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        console.log("response", response);
        if (response.data?.success) {
            Swal.fire({
                title: "OK!",
                text: response?.data?.message,
                icon: "success",
                confirmButtonText: "OK",
            });
        }
    } catch (error) {
        console.log("error", error);
        Swal.fire({
            title: "Error!",
            text: error?.message ?? "A error ocurred",
            icon: "error",
            confirmButtonText: "OK",
        });
    } finally {
        loading.value = false;
        document.body.style.overflow = "auto";
    }
    // // Log para ver los resultados
    // for (let pair of formData.entries()) {
    //     console.log(pair[0] + ": " + pair[1]);
    // }
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
                if (subItem.id) {
                    formData.append(`${name}[${index}][id]`, subItem.id);
                }
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

        <loader :loading="loading" />
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
                                        class="form__custom--input"
                                        v-model="formValues[item.name]"
                                    />
                                    <ErrorMessage :name="item.name" />
                                </div>
                                <div
                                    v-if="item.type === 'image'"
                                    class="form__custom--container-image"
                                >
                                    <input
                                        type="file"
                                        class="form__custom--input"
                                        :id="item.name"
                                        @change="
                                            (e) =>
                                                handleFileChange(e, item.name)
                                        "
                                    />
                                    <div
                                        v-if="formValues[item.name].url"
                                        class="form__custom--preview"
                                    >
                                        <button
                                            class="form__custom--preview-button bg-red-600 hover:bg-red-700 text-gray-800 font-bold rounded inline-flex items-center"
                                            type="button"
                                            @click="removeImage(item.name)"
                                        >
                                            <svg
                                                fill="#ffffff"
                                                height="200px"
                                                width="200px"
                                                version="1.1"
                                                id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                viewBox="0 0 460.775 460.775"
                                                xml:space="preserve"
                                                stroke="#ffffff"
                                            >
                                                <g
                                                    id="SVGRepo_bgCarrier"
                                                    stroke-width="0"
                                                ></g>
                                                <g
                                                    id="SVGRepo_tracerCarrier"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                ></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55 c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55 c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505 c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55 l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719 c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"
                                                    ></path>
                                                </g>
                                            </svg>
                                        </button>
                                        <img
                                            :src="formValues[item.name].url"
                                            alt="Image preview"
                                        />
                                    </div>
                                    <input
                                        type="text"
                                        :id="item.name + '-alt'"
                                        class="form__custom--input"
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
                                        class="form__custom--input"
                                    />
                                    <input
                                        type="text"
                                        :id="item.name + '-title'"
                                        class="form__custom--input"
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
                                        <tr
                                            v-for="(dataItem, d) in formValues[
                                                item.name
                                            ]"
                                            :key="`${d}-${dataItem.name}`"
                                            class="form__custom--table-tbody"
                                        >
                                            <th
                                                v-for="(
                                                    key, k
                                                ) in item.structure"
                                                :key="`${k}-${item.name}-${d}`"
                                                class="form__custom--table-th"
                                            >
                                                <template
                                                    v-if="editArrays[item.name]"
                                                >
                                                    <input
                                                        class="form__custom--input"
                                                        type="text"
                                                        v-model="
                                                            dataItem[key.name]
                                                        "
                                                    />
                                                </template>
                                                <template v-else>
                                                    {{ dataItem[key.name] }}
                                                </template>
                                            </th>
                                            <th
                                                class="form__custom--table-th"
                                                v-if="editArrays[item.name]"
                                            >
                                                <button
                                                    type="button"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-3 rounded form__custom--button-add my-4"
                                                    @click="deleteElementArray(item.name, dataItem)"
                                                >
                                                    X
                                                </button>
                                            </th>
                                        </tr>
                                    </table>
                                    <div class="form__custom--array">
                                        <div
                                            v-for="(
                                                subItem, index
                                            ) in formArrays[item.name]"
                                            :key="index"
                                            class="form__custom--array-item"
                                        >
                                            <div
                                                class="form__custom--array-item-container"
                                            >
                                                <div
                                                    v-for="subField in item.structure"
                                                    :key="subField.name"
                                                >
                                                    <label
                                                        class="form__custom--label"
                                                        :for="subField.name"
                                                        >{{
                                                            subField.label
                                                        }}</label
                                                    >
                                                    <input
                                                        v-if="
                                                            subField.type ===
                                                            'text'
                                                        "
                                                        type="text"
                                                        :id="`${item.name}[${index}][${subField.name}]`"
                                                        class="form__custom--input"
                                                        v-model="
                                                            subItem[
                                                                subField.name
                                                            ]
                                                        "
                                                    />
                                                    <ErrorMessage
                                                        :name="`${item.name}[${index}][${subField.name}]`"
                                                    />
                                                </div>
                                            </div>
                                            <button
                                                type="button"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded form__custom--button-add my-4 form__custom--button-save"
                                                @click="
                                                    saveEntry(item.name, index)
                                                "
                                            >
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                    <button
                                        type="button"
                                        class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 mr-3 rounded form__custom--button-add my-4"
                                        @click="
                                            () =>
                                                (editArrays[item.name] =
                                                    !editArrays[item.name])
                                        "
                                    >
                                        {{
                                            editArrays[item.name]
                                                ? "Save"
                                                : "Edit"
                                        }}
                                    </button>
                                    <button
                                        type="button"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded form__custom--button-add my-4"
                                        @click="addNewEntry(item.name)"
                                    >
                                        Add New
                                    </button>
                                </div>
                            </div>
                            <button
                                class="form__custom--button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                type="submit"
                            >
                                Submit
                            </button>
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
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
        &-image {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    }
    &--preview {
        position: relative;
        width: fit-content;
        max-width: 400px;
        padding: 0 20px;
        &-button {
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            right: 0;
            svg {
                width: 10px;
            }
        }
    }
    &--table {
        background-color: #ede9e9;
        width: 100%;
        &-tr {
            .form__custom--table-th {
                padding: 5px 10px;
                text-align: left;
                background-color: #818cf8;
                border: 1px solid #000;
            }
        }
        &-tbody {
            .form__custom--table-th {
                padding: 5px 10px;
                text-align: left;
                background-color: #fff;
                border: 1px solid #000;
            }
        }
    }
    &--button {
        margin: auto;
    }
    &--input {
        border: 1px solid #d2d2d2;
    }
    &--array {
        padding: 20px 0 10px;
        &-item {
            &-container {
                display: flex;
                gap: 10px;
            }
        }
    }
}
</style>
