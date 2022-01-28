<template>
<BreezeAuthenticatedLayout>

    <div class="py-6 w-full max-w-7xl mx-auto">
        <BButton class="bg-red-600 text-white hover:test-white hover:bg-red-700 active:bg-red-900 border-0" @click="openModalWarning(true)">
            Show Modal Warning
        </BButton>
    </div>

    <modal-danger v-model:isOpen='isOpenModalWarning'>
        
    </modal-danger>

    <p>
        parent {{isOpenModalWarning}}
    </p>
</BreezeAuthenticatedLayout>
</template>

<script>

import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Input from '@/Components/Input.vue'
import BButton from '@/Components/Button.vue'
import ModalDanger from '@/Components/ModalDanger.vue'
import {ref, toRef} from 'vue'

export default {
    components: {
        ModalDanger,
        BreezeAuthenticatedLayout,
        BButton,
        Input,
    },

    setup(props) {

        const isOpenModalWarning = ref(false)

        return {
            isOpenModalWarning,

            openModalWarning(value){
                isOpenModalWarning.value = value
                console.log(isOpenModalWarning.value)
            }
        }
    },
}
</script>