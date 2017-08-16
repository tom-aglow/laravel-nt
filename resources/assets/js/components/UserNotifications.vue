<template>
    <ul id="dropdown4" class="dropdown-content">
        <li v-for="notification in notifications">
            <a :href="notification.data.link" v-text="notification.data.message" @click="markAsRead(notification)">Foobar</a>
        </li>
    </ul>
</template>

<script>
    export default {
        data () {
            return {
                notifications: false,
            }
        },

        created () {
            axios.get("/profiles/" + window.App.username + "/notifications")
                .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead (notification) {
                axios.delete("/profiles/" + window.App.username + "/notifications/" + notification.id);
            }
        }
    }
</script>