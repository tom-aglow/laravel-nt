<template>
    <ul class="pagination" v-if="shouldPaginate">
        <li class="disabled" v-show="prevUrl"><a href="#!" @click.prevent="page--"><i class="material-icons">chevron_left</i></a></li>
        <li class="active"><a href="#!">1</a></li>
        <li class="waves-effect"><a href="#!">2</a></li>
        <li class="waves-effect"><a href="#!">3</a></li>
        <li class="waves-effect"><a href="#!">4</a></li>
        <li class="waves-effect"><a href="#!">5</a></li>
        <li class="waves-effect" v-show="nextUrl"><a href="#!" @click.prevent="page++"><i class="material-icons">chevron_right</i></a></li>
    </ul>
</template>

<script>
    export default {
        props: ['dataSet'],

        data () {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false
            };
        },

        watch: {
            dataSet () {
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },

            page () {
                this.broadcast().updateUrl();
            }
        },

        computed: {
            shouldPaginate () {
                return !! this.prevUrl || !! this.nextUrl;
            }
        },

        methods: {
            broadcast () {
                return this.$emit('changed', this.page);
            },

            updateUrl () {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
</script>