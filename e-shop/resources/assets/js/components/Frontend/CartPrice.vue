<template>
    <div>
        {{ parseFloat(totalPrice).toFixed(2) }}ff
    </div>
</template>

<script>
    export default {
        name: "CartPrice",
        computed: {
            totalPrice: function(){
                return this.$store.getters.getTotal;
            }
        }
    }
</script>

<style scoped>

</style>
