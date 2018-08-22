<template>
  <div class="dropdown-menu">
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
        notifications: [
          {
            data: {
              message: 'No tienes notificaciones'
            }
          }
        ],
      }
    },
    mounted() {
      axios.get(`api/notifications`)
        .then(res => {
          if (res.data.length > 0) {
            this.notifications = res.data
          }
        })
    }
  }
</script>