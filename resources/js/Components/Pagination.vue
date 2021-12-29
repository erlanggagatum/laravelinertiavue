<template>

    <div class="max-w-7xl mx-auto py-3">
        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between work-sans">
            <!-- w-full max-w-7xl mx-auto my-5 px-5 -->
            <div> 
                <p class="text-sm leading-5 text-blue-700">
                    Showing
                    <span class="font-medium">{{users.from}}</span>
                    to
                    <span class="font-medium">{{users.to}}</span>
                    of
                    <span class="font-medium">{{users.total}}</span>
                    results
                </p>
            </div>

            <div>
                <nav class="relative z-0 inline-flex shadow-sm">
                    <!-- Previous -->
                    <button @click="loadPage(users.current_page - 1)"
                    :disabled='noPreviousPage'
                    :class="{'opacity-50': noPreviousPage}">
                        <a class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg> Previous
                        </a>
                    </button>
                    <div>
                        <div class="inline" v-for="n in users.links" v-bind:key="n">
                            <button v-if="isNum(n.label)" 
                                :disabled="n.active"
                                @click="loadPage(n.label)" 
                                class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary"
                                :class="{'bg-gray-100 text-gray-400' : n.label == users.current_page}"
                                
                                >
                                {{n.label}}
                            </button>
                        </div>
                    <!-- <div class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue" disabled>
                            ...
                        </div> -->
                    </div>
                    <!-- Next -->
                    <button @click="loadPage(users.current_page + 1)"
                    :disabled='noNextPage'
                    :class="{'opacity-50': noNextPage}"
                    >
                        <a class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next">
                            Next
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </button>
                </nav>
            </div>

        </div>

    </div>

</template>

<script>
export default {
    props: {
        users: Object
    },
    methods:{
        isNum(val){
            return !isNaN(val)
        },
        loadPage(page){
            this.$inertia.get(this.$page.url, {page: page}, {
                preserveState: true
            })
        }
    },
    computed: {
        noPreviousPage(){
            return this.users.current_page - 1 <= 0;
        },
        noNextPage(){
            return this.users.current_page + 1 > this.users.last_page
        }
    }
}
</script>