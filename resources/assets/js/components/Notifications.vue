<template>
  <div class="dropdown-menu">
    <p v-if="notifications.length == 0" class="dropdown-item"> No tienes notificaciones </p>
    <a :href="notification.data.link" class="dropdown-item" v-for="notification in notifications" :key='notification.id' >
      {{ notification.data.message }}
    </a>
  </div>
</template>

<script>
  export default {
    props: ['user'],
    data() {
      return {
        notifications: [],
      }
    },
    mounted() {
      axios.get(`api/notifications`)
        .then(res => {
          if (res.data.length > 0) {
            this.notifications = res.data
          }

          Echo.private(`App.User.${this.user}`)
					.notification(notification => {
						this.notifications.unshift(notification);
					});
        })
    }
  }
</script>