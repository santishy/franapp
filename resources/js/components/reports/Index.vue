<template>
    <layout-component>
        <div class="px-2">

            <transaction-report :uri="uri" :name="name"> </transaction-report>
            <transaction-list :uri="uri" :name="name"> </transaction-list>
        </div>
    </layout-component>
</template>
<script>

export default {
    props: {
        uri: String,
        name: String,
    },
};
</script>
