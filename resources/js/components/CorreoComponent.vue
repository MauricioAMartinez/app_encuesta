<template>
  <v-data-table
    :headers="headers"
    :items="correo"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>Correos Encuesta</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              Agregar Correo Manual
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="12" md="12">
                    <v-text-field
                      v-model="editedItem.correo"
                      label="Correo"
                      :rules="emailRules"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close"> Cancel </v-btn>
              <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5"
              >Are you sure you want to delete this item?</v-card-title
            >
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete"
                >Cancel</v-btn
              >
              <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                >OK</v-btn
              >
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-tooltip bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-icon
            small
            @click="editItem(item)"
            color="blue lighten-3"
            dark
            v-bind="attrs"
            v-on="on"
          >
            mdi-pencil
          </v-icon>
        </template>
        <span>Editar</span>
      </v-tooltip>
      <v-tooltip bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-icon
            small
            @click="deleteItem(item)"
            color="red darken-3"
            dark
            v-bind="attrs"
            v-on="on"
          >
            mdi-delete
          </v-icon>
        </template>
        <span>Eliminar</span>
      </v-tooltip>
      <v-tooltip bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-icon
            small
            @click="reenviarCorreo(item)"
            color="primary"
            dark
            v-bind="attrs"
            v-on="on"
          >
            mdi-send
          </v-icon>
        </template>
        <span>Reenviar</span>
      </v-tooltip>

      <v-dialog transition="dialog-bottom-transition" max-width="600">
        
        <template v-slot:activator="{ on, attrs }">
          <v-icon
            small
            @click="listarRespuestas(item)"
            color="light-green accent-2"
            dark
            v-bind="attrs"
            v-on="on"
          >
            mdi-eye-outline
          </v-icon>
        </template>
        <span>Respuestas</span>

        <template v-slot:default="dialog">
          <v-card>
            <v-toolbar color="primary" dark>Respuestas por fecha</v-toolbar>
            <div>
              <div v-for="respuesta in respuestas">
                <v-col>
                  <v-btn color="primary" @click="direccionar(respuesta.id)">{{
                    respuesta.created_at
                  }}</v-btn>
                </v-col>
              </div>
            </div>

            <v-card-actions class="justify-end">
              <v-btn text @click="dialog.value = false">Close</v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </v-dialog>
    </template>
  </v-data-table>
</template>

<script>
export default {
  data: () => ({
    
    dialog: false,
    dialogDelete: false,
    correo: [],
    respuestas: [],
    idEdit: 0,
    headers: [
      {
        text: "#",
        align: "start",
        sortable: false,
        value: "id",
      },
      { text: "Correo", value: "correo" },
      { text: "Acciones", value: "actions", sortable: false },
    ],
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      correo: "",
    },
    defaultItem: {
      correo: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo correo" : "Editar correo";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.listarCorreo();
  },

  methods: {
    listarCorreo() {
      axios.get("correo").then((response) => (this.correo = response.data));
    },
 

    editItem(item) {
      this.editedIndex = 1;
      this.idEdit = item.id;
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.idEdit = item.id;
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      axios.delete("correo/" + this.idEdit);
      this.desserts.splice(this.editedIndex, 1);
      this.closeDelete();
      this.$swal(
        "Correcto",
        "Se a eliminado el correco correctamente ",
        "success"
      );
    },
    reenviarCorreo(item) {
      axios.put("correo/" + item.id, {
        id: item.id,
        correo: item.correo,
      }); //.then((response) => console.log(response.data));
      this.$swal(
        "Correcto",
        "Se a reenviado el correo a " + item.correo,
        "success"
      );
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
        this.listarCorreo();
      });
    },

    listarRespuestas(item) {
      axios
        .get("respuesta/" + item.id)
        .then((response) => (this.respuestas = response.data));
     

    },
    direccionar(item) {
      console.log(item);
      window.open("pregunta/" + item, "blank");
    },
    save() {
      if (this.editedIndex > -1) {
        axios
          .put("correo/" + this.idEdit, {
            id: this.idEdit,
            correo: this.editedItem.correo,
          })
          .then((response) => console.log(response.data));
        this.listarCorreo();
        this.$swal(
          "Correcto",
          "Se han editado los datos,la encuesta se a reenviado ",
          "success"
        );
      } else {
        axios.post("correo", {
          correo: this.editedItem.correo,
        });
        this.$swal("Correcto", "Correo agregado, encuesta enviada", "success");
        this.listarCorreo();
      }
      this.close();
    },
  },
};
</script>