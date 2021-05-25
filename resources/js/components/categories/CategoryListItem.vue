<template>
    <li class="flex justify-between px-4">
        {{ category.name }}
        <button @click.prevent="">
            <span>
              
            </span>
        </button>
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
