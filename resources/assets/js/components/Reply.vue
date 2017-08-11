<template>
    <div class="card" :id="'reply-'+id">
        <div class="card-content blue-grey lighten-5">
            <strong><a class="light-blue-text text-darken-4" :href="'/profiles/'+data.owner.name" v-text="data.owner.name"></a> said {{ data.created_at }}...</strong>
            <hr>
            <div v-if="editing">
                <textarea class="materialize-textarea" cols="30" rows="5" v-model="body"></textarea>
                <button class="waves-effect waves-light btn deep-purple darken-1" @click="update">Save</button>
                <button class="waves-effect waves-light btn grey lighten-1" @click="editing = false">Cancel</button>

            </div>
            <div v-else v-text="body"></div>
        </div>

        <div v-if="signedIn">
            <div class="card-action card-action__group">
                <favorite :reply="data"></favorite>

                <div v-if="canUpdate">
                    <button class="waves-effect waves-light btn light-blue darken-3" @click="editing = true"><i class="material-icons">edit</i></button>
                    <button class="waves-effect waves-light btn red" @click="destroy"><i class="material-icons">delete_forever</i></button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Favorite from './Favorite.vue';

    export default {
        props: ['data'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            };
        },

        computed: {
            signedIn () {
                return window.App.signedIn;
            },

            canUpdate() {
                return this.authorize (user => this.data.user_id == user.id);
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });

                this.editing = false;

                flash('Updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);
            }
        }
    };
</script>

<style>

</style>