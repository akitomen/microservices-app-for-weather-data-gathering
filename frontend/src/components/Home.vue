<template>
  <div class="container">

    <header v-if="!!content">
      <h3>{{ content }}</h3>
    </header>

    <div style="margin-top: 20px">
      <row v-for="city in cities"
           :key="city.id"
           :city="city"
           @update="update"
      />
    </div>
  </div>
</template>

<script>
import CityService from "../services/city.service";
import Row from "@/components/include/Row";

export default {
  name: "Home",
  components: {Row},
  data() {
    return {
      cities: [],
      content: ''
    };
  },
  methods: {
    update(city_id) {
      CityService.update(city_id).then(
          () => this.getContent(),
          (error) => {
            this.content =
                (error.response &&
                    error.response.data &&
                    error.response.data.message) ||
                error.message ||
                error.toString();
          }
      );
    },
    getContent() {
      CityService.getContent().then(
          (response) => {
            this.cities = response.data.result.cities;
          },
          (error) => {
            this.content =
                (error.response &&
                    error.response.data &&
                    error.response.data.message) ||
                error.message ||
                error.toString();
          }
      );
    }
  },
  mounted() {
    this.getContent();
  },
};
</script>
