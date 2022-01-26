<template>
    <div class="w-full max-w-7xl mx-auto bg-white shadow-sm rounded-sm border border-gray-200">

        <p v-for="header in table" :key="header">
            {{header}}
        </p>

        <header class="px-5 py-4 border-b border-gray-100 block sm:flex-1 sm:flex sm:items-center sm:justify-between">
            
            <!-- Header Slot -->
            <slot name='header'> </slot>
            <!-- Header Old -->
            <!-- <h2 class="font-semibold text-gray-800 inline"><slot name='header'>Table #header Slot</slot></h2>

            <Input @keyup.enter='findName' v-model="params.name" placeholder='Find Name' id="search" type="text" class=""></Input> -->

            <!-- <slot name='button'></slot> -->

        </header>
        <div class="p-3">
            <div class="overflow-x-auto">
                <table class="table-auto w-full">


                    
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            
                            <th v-for="header in header" :key="header" class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">{{header.name}}</div>
                            </th>

                            
                        </tr>
                    </thead>

                    <!-- Table Head Here -->
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <th class="p-2 whitespace-nowrap" @click="sort('name')">
                                <div class="font-semibold flex justify-between">Name 
                                    <span v-if="params.direction == 'asc' && params.field == 'name'" class="">
                                        <div><SortAscendingIcon/></div>
                                    </span>
                                    <span v-if="params.direction == 'desc' && params.field == 'name'" class="bg-amber-500 rounded-lg text-white font-thin px-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                        </svg>
                                    </span>
                                    
                                </div>
                            </th>
                            <th class="p-2 whitespace-nowrap" @click="sort('email')">
                                <div class="font-semibold flex justify-between">Email   
                                    <div v-if="params.direction == 'asc' && params.field == 'email'" 
                                        class="bg-amber-500 text-white rounded-lg px-1">
                                        <SortAscendingIcon class="w-2 h-2"/>
                                    </div>
                                    
                                    <span v-if="params.direction == 'desc' && params.field == 'email'" 
                                        class="bg-amber-500 text-white rounded-lg px-1">
                                        <SortDescendingIcon/>
                                    </span>
                                    
                                </div>
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
                        <tr v-if="users.length < 1">
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
import { SortAscendingIcon, SortDescendingIcon } from '@heroicons/vue/outline'
import Input from '@/Components/Input.vue';
import Button from './Button.vue';
export default {
    data() {
        return {
            params: { // for querying
                name: this.getParameterByName('name'),
                field: this.getParameterByName('field'), // field to sort
                direction: this.getParameterByName('direction'), // direction, asc || dsc
            },
            
        }
    },
    components: {
        Input,
        Button,
        SortAscendingIcon,
        SortDescendingIcon
    },
    props:{
        users: {
            type: Array,
            default: () => []
        },
        table: {
            type: Array,
            default: () => ['asd','dsa']
        },
        header: {
            type: Array
        },
        pField: {
            type: String,
            default: null,
        },
        pDirection: {
            type: String,
            default: null,
        }

    },
    methods: {
        sort(field){
            this.params.field = field
            this.params.direction = (this.params.direction === 'asc' ? 'desc' : 'asc')
            this.$inertia.get(this.$page.url, this.params, {
                replace: true,
                preserveState: true,
            })
        },
        getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }
    },
    
    computed: {
        routeQuery(){
            return $route.query.name;
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
    
}
</script>