<template>
  <v-container>
    <v-row>
      <v-col md="8" offset="2">
        <v-card class="sidebar">
          <v-card-title>
            <v-toolbar color="cyan" dense dark>
              <v-toolbar-title>Categories</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-dialog v-model="dialog" persistent max-width="290">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="success" dark v-bind="attrs" v-on="on">Add Category</v-btn>
                </template>
                <v-card>
                  <v-form @submit.prevent="submit">
                    <v-card-title class="headline">Create Category</v-card-title>
                    <v-card-text>
                      <v-row>
                        <v-col cols>
                          <v-text-field
                            v-model="name"
                            :error-messages="nameErrors"
                            label="Name"
                            required
                            @blur="$v.name.$touch()"
                          ></v-text-field>
                        </v-col>
                      </v-row>
                    </v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="green darken-1" text type="submit">Create</v-btn>
                      <v-btn color="green darken-1" text @click="dialog = false">Cancel</v-btn>
                    </v-card-actions>
                  </v-form>
                </v-card>
              </v-dialog>
            </v-toolbar>
          </v-card-title>
          <v-card-text v-if="categories">
            <v-list v-for="category in categories" :key="category.id">
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title>{{ category.name }}</v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                  <v-icon color="warning" @click="edit(category)">mdi-pencil</v-icon>
                  <v-icon color="red" @click="destroy(category)">mdi-delete</v-icon>
                </v-list-item-action>
              </v-list-item>
              <v-divider></v-divider>
            </v-list>
            <v-dialog v-if="selectedName" v-model="editDialog" persistent max-width="290">
              <v-card>
                <v-form @submit.prevent="editCategory">
                  <v-card-title class="headline">Edit Category</v-card-title>
                  <v-card-text>
                    <v-row>
                      <v-col cols>
                        <v-text-field
                          v-model="selectedName"
                          :value="selectedName"
                          :error-messages="selectedNameErrors"
                          label="Name"
                          required
                          @blur="$v.selectedName.$touch()"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" text type="submit">Update</v-btn>
                    <v-btn color="green darken-1" text @click="editDialog = false">Cancel</v-btn>
                  </v-card-actions>
                </v-form>
              </v-card>
            </v-dialog>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, maxLength } from "vuelidate/lib/validators";
export default {
  mixins: [validationMixin],

  validations: {
    name: { required },
    selectedName: { required },
  },
  mounted() {
    axios
      .get(`api/categories`)
      .then((res) => (this.categories = res.data.data))
      .catch((err) => console.log(err));
  },

  data: () => ({
    name: "",
    category: null,
    categories: null,
    dialog: false,
    editDialog: false,
    selectedName: ''
  }),

  computed: {
    nameErrors() {
      const errors = [];
      if (!this.$v.name.$dirty) return errors;
      !this.$v.name.required && errors.push("category name is required");
      return errors;
    },
    selectedNameErrors() {
      const errors = [];
      if (!this.$v.selectedName.$dirty) return errors;
      !this.$v.selectedName.required && errors.push("category name is required");
      return errors;
    },
  },

  methods: {
    edit(category) {
      this.editDialog = true;
      this.name = category.name;
      this.selectedName = category.name;
      console.log(` edit dialog is ${this.editDialog} selected category ${this.selectedName} `);
    },
    submit() {
      this.$v.$touch();
      const slug = this.name
        .toLocaleLowerCase()
        .replace(/ /g, "-")
        .replace(".", "");
      axios
        .post("/api/categories", {
          name: this.name,
        })
        // .then(res => this.$router.push({ name: 'forum', params: { slug }}))
        .then(res => window.location = "/category")
        .catch(err => console.log("error is ", err));
    },
    editCategory() {
      this.$v.$touch();
      this.editDialog = false;
      const slug = this.name.toLocaleLowerCase().replace(/ /g, "-").replace(".", "");
      const url = `/api/categories/${slug}`;
      console.log('url is ',url);
      axios
        .put(url, {
          name: this.selectedName,
        })
        // .then(res => this.$router.push({ name: 'forum', params: { slug }}))
        .then(res => this.categories.map(category=>{
          if (category.name == this.name) {
            category.name = this.selectedName;
          }
        }))
        // .then(res => window.location = "/category")
        .catch(err => console.log("error is ", err));
    },
    destroy(category){
      const slug = category.name.toLocaleLowerCase().replace(/ /g, "-").replace(".", "");

      const url = `/api/categories/${slug}`;

      axios.delete(url)
        .then(res => this.categories =  this.categories.filter(CategoryItem=>{
            return category.id !== CategoryItem.id;
        }))
        .catch(err => console.log('error is ', err));
    }
  },
};
</script>

<style lang="scss" scoped>
</style>

