<template >
  <v-row>
    <v-col>
      <v-card class="mx-auto" width="850 ">
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
            disabled
            v-model="respuestas.respuesta_1"
            :counter="20"
            label="Nombre mascota"
          ></v-text-field>

          <v-text-field
            disabled
            v-model="respuestas.respuesta_2"
            label="Cantidad de hermanos"
            required
          ></v-text-field>

          <v-text-field
            disabled
            v-model="respuestas.respuesta_3"
            label="Cuantas veces come"
          ></v-text-field>
          <v-text-field
            disabled
            v-model="respuestas.respuesta_4"
            :counter="50"
            label="Nombre Padre"
          ></v-text-field>
          <v-text-field
            disabled
            v-model="respuestas.respuesta_5"
            label="Edad"
          ></v-text-field>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
export default {
  data: () => ({
    reveal: false,
    valid: true,
    respuestas: [],
  }),

  created() {
    this.listarId();
  },

  methods: {
    listarId() {
      var id = window.location.href.split("/")[4];
      console.log(id);
      axios;
      axios
        .get("/informacion/" + id)
        .then((response) => (this.respuestas = response.data))
        .catch((error) => console.log(error));
    },
  },
};
</script>

