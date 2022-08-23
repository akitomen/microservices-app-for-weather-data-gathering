<template>
  <div style="margin: 5px; padding: 5px 15px; display: flex; background: #ddd; border-radius: 10px;">

    <button type="button" @click="$emit('update', city.id)" style="margin-right: 5px">Update</button>

    <p style="margin-right: 5px">{{ city.name }}</p>

    <template v-if="city.last_weather">
      <p style="margin-right: 5px">Temperature: {{ city.last_weather.temperature }} </p>
      <p>Wind Speed: {{ city.last_weather.wind_speed }} </p>
    </template>
    <p v-else style="margin-right: 5px">Please update</p>
  </div>
</template>

<script>
export default {
  name: "Row",
  props: {
    city: Object
  }
}
</script>