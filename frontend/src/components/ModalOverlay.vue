<template>
  <div class="popup">
    <div class="popup-inner">
      <div class="popup-photo">
        <img src="../assets/img/shapes.jpeg" alt="" />
      </div>
      <div class="popup-text">
        <h1>User Data</h1>
        <table class="table table-bordered table-striped">
          <tr>
            <td>Name</td>
            <td>{{ user.name }}</td>
          </tr>
          <tr>
            <td>Latitude</td>
            <td>{{ user.latitude }}</td>
          </tr>
          <tr>
            <td>Longitude</td>
            <td>{{ user.longitude }}</td>
          </tr>
        </table>

        <h1>Weather Data</h1>
        <div class="alert alert-danger muted" v-if="!user.weather">
          No weather information was found for this location.
        </div>

        <table v-else class="table table-bordered table-striped">
          <tr>
            <td>Temperature (&#8451;)</td>
            <td>{{ Math.round(user.weather.temp_celsius) }}</td>
          </tr>
          <tr>
            <td>Temperature (&#8457;)</td>
            <td>{{ Math.round(user.weather.temp_fahrenheit) }}</td>
          </tr>
          <tr>
            <td>Condition</td>
            <td>
              {{ user.weather.condition_text }}
              <img :src="user.weather.condition_icon" />
            </td>
          </tr>
          <tr>
            <td>Humidity</td>
            <td>
              {{ user.weather.humidity }}
            </td>
          </tr>
          <tr>
            <td>Location</td>
            <td>
              {{ user.weather.location_name }}
            </td>
          </tr>
          <tr>
            <td>Region</td>
            <td>
              {{ user.weather.location_region }}
            </td>
          </tr>
          <tr>
            <td>Country</td>
            <td>
              {{ user.weather.location_country }}
            </td>
          </tr>
        </table>
      </div>
      <span class="popup-close" @click="closeModal"
        ><i class="fa fa-times-circle"></i
      ></span>
    </div>
  </div>
</template>
<script>
export default {
  name: "ModalOverlay",
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  methods: {
    closeModal() {
      this.$emit("closeModal");
    },
  },
};
</script>
