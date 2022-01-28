<template>
    <div class="w-full max-w-7xl mx-auto bg-white shadow-sm rounded-sm border border-gray-200">

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


                    <!-- table header here -->
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <!-- show table header -->
                            <th v-for="header in headers" :key="header" class="p-2 whitespace-nowrap" @click="sort(header)">
                                <div class="font-semibold flex justify-between">{{header.name}} 
                                    
                                    <!-- header sort icon -->
                                    <span v-if="params.direction == 'asc' && params.field == header.name" class="bg-amber-500 rounded-lg text-white font-thin px-1">
                                        <div class="h-5 w-5"><SortAscendingIcon/></div>
                                    </span>
                                    <span v-if="params.direction == 'desc' && params.field == header.name" class="bg-amber-500 rounded-lg text-white font-thin px-1">
                                        <div class="h-5 w-5"><SortDescendingIcon/></div>
                                    </span>

                                </div>
                            </th>
                                                        
                        </tr>
                    </thead>

                    
                    <tbody class="text-sm divide-y divide-gray-100">
                        <!-- Content Row -->
                        <tr v-for="(item, index) in items" :key='item.id'>
                            <td class="p-2 whitespace-nowrap" v-for="header in headers" :key="header">
                                
                                <div class="flex items-center" v-if="header.name == 'action'">
                                    <div class="font-medium text-gray-800">
                                        <slot name='action' :item='item' :index='index'>
                                            put action here using template #action
                                        </slot>
                                    </div>
                                </div>

                                <div class="flex items-center" v-else>
                                    <div class="font-medium text-gray-800">{{item[header.name]}}</div>
                                </div>
                            </td>
                        </tr>

                        <!-- Empty Content Row -->
                        <tr v-if="items.length < 1">
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
        items: {
            type: Array,
            default: () => []
        },
        table: {
            type: Array,
            default: () => ['asd','dsa']
        },
        headers: {
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
            if(!field.sortable){
                return;
            }
            this.params.field = field.name
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
    
}
</script>