<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { defineComponent, reactive, ref, onMounted } from "vue";
import { format } from "date-fns";

const props = defineProps({
    quotes: {
        type: Array,
        required: true,
    },
});

const formatDate = (dateString) => {
    return format(new Date(dateString), "yyyy-MM-dd");
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Quotes
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="quotes__table--container">
                        <table class="quotes__table--table">
                            <thead>
                                <tr class="quotes__table--table-tr">
                                    <th class="quotes__table--table-th">ID</th>
                                    <th class="quotes__table--table-th">
                                        Name
                                    </th>
                                    <th class="quotes__table--table-th">
                                        Phone
                                    </th>
                                    <th class="quotes__table--table-th">
                                        Email
                                    </th>
                                    <th class="quotes__table--table-th">
                                        Description
                                    </th>
                                    <th class="quotes__table--table-th">
                                        Created At
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="quotes.length">
                                    <tr
                                        v-for="quote in quotes"
                                        :key="quote.id"
                                        class="quotes__table--table-tr"
                                    >
                                        <td class="quotes__table--table-td">
                                            {{ quote.id }}
                                        </td>
                                        <td class="quotes__table--table-td">
                                            {{ quote.name }}
                                        </td>
                                        <td class="quotes__table--table-td">
                                            {{ quote.phone }}
                                        </td>
                                        <td class="quotes__table--table-td">
                                            {{ quote.email }}
                                        </td>
                                        <td class="quotes__table--table-td">
                                            {{ quote.description }}
                                        </td>
                                        <td class="quotes__table--table-td">
                                            {{ formatDate(quote.created_at) }}
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td class="text-center font-semibold text-md text-gray-500 leading-tight p-2" COLSPAN="6">
                                            No hay registros aun
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss">
.quotes__table {
    &--container {
        padding: 10px 30px;
    }
    &--table {
        background-color: #ede9e9;
        width: 100%;
        border-collapse: collapse;
        &-tr {
        }
        &-th,
        &-td {
            padding: 5px 10px;
            text-align: left;
            border: 1px solid #000;
        }
        &-th {
            background-color: #818cf8;
            color: #fff;
        }
    }
}
</style>
