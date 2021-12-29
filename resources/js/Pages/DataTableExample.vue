<template>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2>Datatable Example</h2>
        </template>
        
        <!-- Body Here -->
        <div class="py-6">

            <!-- TABLE HERE -->
            
            <!-- Pagination Here -->
            <Pagination :users='users'></Pagination>

            <!-- Table -->
            <DataTable :users='users.data'>
                <template #header>Users (#header)</template>

            </DataTable>

            <!-- Pagination Here -->
            <Pagination :users='users'></Pagination>


            
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>

import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import DataTable from '@/Components/DataTable.vue'
import Pagination from '@/Components/Pagination.vue'
import { Head } from '@inertiajs/inertia-vue3';


export default {
    components: {
        BreezeAuthenticatedLayout, Head, DataTable,
        Pagination
    },
    props: {
        users: Object,
    }
}
</script>