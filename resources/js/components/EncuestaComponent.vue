<template >
  <v-row>
    <v-col>
      <v-card class="mx-auto" width="850 ">
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
            v-model="respuestas.respuesta_1"
            :counter="20"
            :rules="nameRules"
            label="Nombre mascota"
            required
          ></v-text-field>

          <v-select
            v-model="respuestas.respuesta_2"
            :items="items"
            :rules="[(v) => !!v || 'Item is required']"
            label="Cantidad de hermanos"
            required
          ></v-select>

          <v-select
            v-model="respuestas.respuesta_3"
            :items="items"
            :rules="[(v) => !!v || 'Item is required']"
            label="Cuantas veces come"
            required
          ></v-select>
          <v-text-field
            v-model="respuestas.respuesta_4"
            :rules="nameRules"
            :counter="50"
            label="Nombre Padre"
            required
          ></v-text-field>
          <v-text-field
            v-model="respuestas.respuesta_5"
            :rules="numberRule"
            label="Edad"
            required
          ></v-text-field>

          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="validate"
          >
            Validar y enviar
          </v-btn>

          <v-btn color="error" class="mr-4" @click="reset">
            Reiniciar respuestas
          </v-btn>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
export default {
  data: () => ({
    reveal: false,
    name: "",
    valid: true,
    preguntas: [],
    respuestas: {
      respuesta_1: "",
      respuesta_2: "",
      respuesta_3: "",
      respuesta_4: "",
      respuesta_5: "",
    },
    name: "",
    nameRules: [
      (v) => !!v || "Name is required",
      (v) => (v && v.length <= 50) || "Name must be less than 50 characters",
    ],
    email: "",
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
    numberRule: [
      (v) => !!v || "Item is required",
      (v) => {
        if (!v.trim()) return true;
        if (!isNaN(parseFloat(v)) && v >= 0 && v <= 999) return true;
        return "Number has to be between 0 and 999";
      },
    ],
    select: null,
    items: ["1", "2", "3", "4", "+4"],
    checkbox: false,
  }),

  created() {},

  methods: {
    validate() {
      var correo = window.location.href.split("/")[4];

      if (this.$refs.form.validate()) {
        axios.post("/respuesta", {
          correo: correo,
          respueta_1: this.respuestas.respuesta_1,
          respueta_2: this.respuestas.respuesta_2,
          respueta_3: this.respuestas.respuesta_3,
          respueta_4: this.respuestas.respuesta_4,
          respueta_5: this.respuestas.respuesta_5,
        }).then((response) => console.log(response.data));
        
        this.$swal("Bien hecho", "Gracias por responder ", "success");
        
        setTimeout(() => {
          window.open('http://app_encuesta.local/encuesta/'+correo+'/0');
        }, 1000);
        setTimeout(() => {
          window.close();
        }, 1100);
      } else {
        this.$swal("Oopss..", "Debes completar los campos", "error");
      }
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
  },
};
</script>

