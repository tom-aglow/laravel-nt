<template>
      <div class="orange darken-1 card__flash white-text" v-show="show">
        <strong>Success!</strong> <span>{{ body }}</span>
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data () {
            return {
                body: '',
                show: false
            }
        },

        created() {
            if (this.message) {
               this.flash(this.message);
            }

            window.events.$on('flash', message => {
                this.flash(message);
            });
        },

        methods: {
            flash (message) {
                this.body = message;
                this.show = true;

                this.hide();
            },

            hide () {
                setTimeout(() => {
                    this.show = false
                }, 3000)
            }
        }
    };
</script>

<style>
    .card__flash {
        position: fixed;
        bottom: 125px;
        right: 25px;
        padding: 10px 20px;
        font-weight: 200;
    }
</style>