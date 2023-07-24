<template>
  <div class="col-sm-6 col-lg-3 m-15px-tb">
    <div class="user-box box-shadow-lg" @click="showDetails">
      <div class="d-flex justify-content-between">
        <div class="avatar">
          <img :src="getAvatar(user)" />
        </div>
        <div class="weather-icon">
          <img :src="user.weather.condition_icon" v-if="user.weather" />
          <span v-else class="icon-missing" style="font-size: 30px">
            <i class="fa fa-sticky-note"></i>
          </span>
        </div>
      </div>
      <div class="basic">
        <h5>{{ user.name }}</h5>
        <div class="basic-location">
          <p>Lat: <i class="fa fa-map-marker"></i> {{ user.latitude }}</p>
          <p>Long: <i class="fa fa-map-marker"></i> {{ user.longitude }}</p>
        </div>
      </div>
      <div class="weather-layer">
        <div v-if="!user.weather" class="no-weather">
          <i class="fa fa-times-circle" aria-hidden="true"></i> No weather
          information available for this location.
        </div>
        <div v-else>
          <div class="yes-weather">
            {{ Math.round(user.weather.temp_celsius) }}&#8451;
            {{ user.weather.condition_text }}
          </div>
          <div class="weather-location">
            <p>
              {{ user.weather.location_name }}
              {{ user.weather.location_region }},
              {{ user.weather.location_country }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "WeatherBox",
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  methods: {
    getAvatar(user) {
      const base_url = "https://ui-avatars.com/api/?";
      const params = new URLSearchParams({
        name: user.name,
        background: "ffffff",
        colour: "d9832e",
      });
      return base_url + params.toString();
    },
    showDetails() {
      this.$emit("showModal", this.user);
    },
  },
};
</script>
