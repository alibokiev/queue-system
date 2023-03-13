<template>
    <div>
        <!-- SOURCE -->
        <div id="printMe">
            <h1>Print me!</h1>
        </div>
        <!-- OUTPUT -->
        <button class="btn btn-danger" @click="print"></button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                output: null
            }
        },
        methods: {
            print() {
                // Pass the element id here
                this.$htmlToPaper('printMe');
            }
        }
    }
</script>