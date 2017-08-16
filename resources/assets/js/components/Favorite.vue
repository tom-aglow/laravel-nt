<template>
    <button type="submit" :class="classes" @click="toggle">
        <i class="material-icons left">favorite_border</i>
        <span v-text="count"></span>
    </button>
</template>

<script>
    export default {

        props: ['reply'],

        data () {
            return {
                count: this.reply.favouriteCounts,
                active: this.reply.isFavourited
            }
        },

        computed: {
            classes () {
                return ['waves-effect waves-light valign-wrapper btn', this.active ? 'pink darken-2' : 'grey lighten-1'];
            },

            endpoint () {
                return '/replies/' + this.reply.id + '/favourites';
            }
        },

        methods: {
            toggle () {
                this.active ? this.destroy() : this.create();
            },

            create () {
                axios.post(this.endpoint);
                this.active = true;
                this.count++;
            },

            destroy () {
                axios.delete(this.endpoint);
                this.active = false;
                this.count--;
            }
        }
    }
</script>