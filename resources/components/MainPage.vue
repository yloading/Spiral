<template>
    <h1>hi vue</h1>
</template>

<script>
export default {
    data() {
        return {
            randomData : [],
        }
    },
    
    async created() {
        
        const res = await this.callApi('get', '/get-data')

        if(res.response == 200) {
            this.randomData = res.data
            // spiral
            // update flag
        }
    }
}
</script>

