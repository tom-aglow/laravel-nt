<template>
    <div>
        <div v-if="signedIn">
            <div class="input-field col l12">
                <textarea id="reply"
                          class="materialize-textarea validate"
                          rows="6"
                          name="body"
                          placeholder="Have something to say?"
                          required
                          v-model="body">
                </textarea>
                <label for="reply" data-error="wrong" data-success="right">Your reply</label>
            </div>
            <input type="submit" value="Leave a Reply" class="btn" @click="addReply">
        </div>

        <div v-else>
            <p>Please <a href="/login">sign in</a> to participate in this discussion </p>
        </div>
    </div>
</template>

<script>
    import Reply from './Reply.vue';

    export default {


        data () {
            return {
                body: ''
            }
        },

        computed: {
            signedIn () {
                return window.App.signedIn;
            },
        },

        methods: {
            addReply () {
                axios.post(location.pathname + '/replies', { body: this.body })
                    .then(response => {
                        //  clear the body
                        this.body = '';

                        //  show message
                        flash('Your reply has been posted!');

                        //  fire an event for Replies component
                        this.$emit('created', response.data);
                    });
            }
        }
    }
</script>