<template>
    <div class="w-full max-w-7xl mx-auto bg-white shadow-sm rounded-sm border border-gray-200">
        <header class="px-5 py-4 border-b border-gray-100 block sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <!-- px-5 py-4 border-b border-gray-100 justify-between -->
            <h2 class="font-semibold text-gray-800 inline"><slot name='header'></slot></h2>
            <!-- <h2 class="font-semibold text-gray-800 inline">Customers</h2> -->
            <Input @keyup.enter='findName' v-model="params.name" placeholder='Find Name' id="search" type="text" class=""></Input>
        </header>
        <div class="p-3">
            <div class="overflow-x-auto">
                <table class="table-auto w-full">

                    <!-- Table Head Here -->
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <th class="p-2 whitespace-nowrap" @click="sort('name')">
                                <div class="font-semibold text-left">Name</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Email</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Spent</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Country</div>
                            </th>
                        </tr>
                    </thead>

                    <!-- Table Body Here -->
                    <tbody class="text-sm divide-y divide-gray-100">
                        <!-- Content Row -->
                        <tr v-for="user in users" :key='user.id'>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <!-- <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg" width="40" height="40" alt="Alex Shatov"></div> -->
                                    <div class="font-medium text-gray-800">{{user.name}}</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{user.email}}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">$2,890.66</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-lg text-center">🇺🇸</div>
                            </td>
                        </tr>

                        <!-- Empty Content Row -->
                        <tr v-if="userIsEmpty">
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="font-medium text-gray-800">Data not found</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

import Input from '@/Components/Input.vue';
export default {
    data() {
        return {
            params: { // for querying
                name: null,
                field: null, // field to sort
                direction: null, // direction, asc || dsc
            },
        }
    },
    components: {
        Input
    },
    props:{
        users: Object
    },
    methods: {
        findName(){
            console.log(this.params.name);
            this.$inertia.get(this.$page.url, {name: this.params.name}, {
                preserveState: true
            });
        },
        
        userIsEmpty(){
            return this.users.data.count == 0
        },

        sort(field){
            this.params.field = field
            this.params.direction = (this.params.direction === 'asc' ? 'desc' : 'asc')
            this.$inertia.get(this.$page.url, this.params, {
                replace: true,
                preserveState: true,
            })
        }
    },
    // watch([this.params.field, this.params.direction], () => {

    // })
    
    // watch: {
    //     sortChange() {
    //         this.$inertia.get(this.$page.url, this.params, {
    //             replace: true,
    //             preserveState: true,
    //         })
    //     }
    // },
    // computed: {
    //     sortChange() {
    //         return this.params.field;    
    //     }
    // },
    
}
</script>