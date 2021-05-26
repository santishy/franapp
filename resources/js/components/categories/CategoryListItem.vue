<template>
    <li class="px-4 py-1 text-center">
        {{ category.name }}
    </li>
</template>
<script>
export default {
    props: {
        category: {
            type: Object,
            required: true
        }
    },
    created() {
        
    },
    data() {
        return {
            fill: false
        };
    },
    methods: {
        
    },
    computed: {
      
    }
};
</script>
