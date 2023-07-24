<script>
import WeatherBox from "./WeatherBox.vue";
import ModalOverlay from "./ModalOverlay.vue";

export default {
  data: () => ({
    apiResponse: null,
    errorMessage: "",
    status: false,
    processing: true,
    modalData: {},
    modal: false,
  }),

  components: {
    WeatherBox,
    ModalOverlay,
  },

  created() {
    this.fetchData();
  },

  methods: {
    async fetchData() {
      try {
        const url = "http://localhost/";
        const req = await fetch(url);
        if (req.ok) {
          this.apiResponse = await req.json();
        } else {
          this.errorMessage = req.statusText;
        }
      } catch (error) {
        this.errorMessage = error.message;
      }
      this.processing = false;
    },
    showModal(user) {
      this.modalData = user;
      this.modal = true;
    },
    closeModal() {
      this.modal = false;
    },
  },
};
</script>

<template>
  <div>
    <modal-overlay
      v-if="modal"
      :user="modalData"
      @closeModal="closeModal"
    ></modal-overlay>

    <div class="page-header d-flex justify-content-end">
      <div class="sticky-img">
        <img src="../assets/img/logo.png" />
      </div>
    </div>

    <header class="sticky-bar">
      <div class="navbar-brand">
        <a class="logo-text" href="/"> The Weather Index </a>
      </div>
    </header>

    <main class="main-section">
      <section>
        <div class="container">
          <div class="row">
            <div class="col-md-12 title-note">
              <h4>OUR USERS</h4>
              <span>...and their weather indexes </span>
            </div>
          </div>

          <div class="weather-wrapper">
            <div class="small muted" v-if="processing">
              Loading...please wait
            </div>
            <div v-else>
              <div v-if="errorMessage != ''" class="alert alert-danger">
                {{ errorMessage }}
              </div>
              <div v-else class="row">
                <weather-box
                  v-for="(user, key) in apiResponse.users"
                  :key="key"
                  :user="user"
                  @showModal="showModal"
                ></weather-box>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>
