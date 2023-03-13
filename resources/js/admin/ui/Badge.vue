<template>
    <span :class="'badge badge-' + data.class">
        <i class="fa" :class="data.icon" v-if="icon"></i>
        {{ data.display_name }}
    </span>
</template>

<script>
    export default {
        props: {
            data: {},
            icon: {
                default: true,
            }
        }
    }
</script>
