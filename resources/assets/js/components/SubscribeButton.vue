<template>
    <button type="submit" class="waves-effect waves-light white-text" :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {

        props: ['active'],

        computed: {
            classes () {
                return ['btn', 'btn-subscribe', this.active ? 'deep-purple darken-1' : 'grey darken-1'];
            }
        },

        methods: {
            subscribe () {
                let requestType = this.active ? 'delete': 'post';

                axios[requestType](location.pathname + '/subscriptions');

                this.active = !this.active;
            }
        }
    };
</script>