<template>
    <div class="content-wrapper">
        <div class="content-header">
            <h2>Users</h2>
        </div>
        <div class="content">

        </div>
    </div>
</template>
<script>
// import { defineComponent } from '@vue/composition-api'

export default {
    setup() {
        console.log("Entered setup")
    },
    mounted(){
        axios.get('api/getUsers')
        .then(function(response){
            console.log(response.data)
        })
    }
}
</script>



