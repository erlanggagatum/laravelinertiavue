<template>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2>Datatable Example</h2>
        </template>
        
        <!-- Body Here -->
        <div class="py-6">

            <!-- TABLE HERE -->
            
            <!-- Pagination Here -->
            <Pagination :users='users' :header='header'></Pagination>

            <!-- Table -->
            <DataTable 
            :users='users.data'
            :header='header'
            >
                <template #header>
                    <h2 class="font-semibold text-gray-800 inline">Header Here</h2>
                    <Input @keyup.enter='findName' v-model="params.name" placeholder='Find Name' id="search" type="text" class=""></Input>
                </template>
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
import BButton from '@/Components/Button.vue'
import Input from '@/Components/Input.vue'

import { Head } from '@inertiajs/inertia-vue3';


export default {
    data() {
        return {
            params: {
                name: null
            },
            header: [
                {
                    name: 'name',
                    sortable: true
                },
                {
                    name: 'email',
                    sortable: false,
                },
                {
                    name: 'id',
                    sortable: false,
                },
                {
                    name: 'created_at',
                    as: 'created at',
                    sortable: false,
                }
            ]
        }
    },
    components: {
        BreezeAuthenticatedLayout, Head, DataTable,
        Pagination, BButton, Input
    },
    props: {
        users: Object,
    },
    methods: {
        slotButton(){
            alert('tertekan')
        },
        
        findName(){
            console.log(this.params.name + "from parent with slot");
            this.$inertia.get(this.$page.url, {name: this.params.name}, {
                preserveState: true
            });
        },
    },
}
</script>