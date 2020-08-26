<template>
  <v-container>
    <v-form @submit.prevent="submit">
      <h1>Create Question</h1>
      <v-row no-gutters>
        <v-col class="create-form" md="6" offset="3">
          <v-row>
            <v-col cols>
              <v-text-field
                v-model="title"
                :error-messages="titleErrors"
                label="Title"
                required
                @blur="$v.title.$touch()"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-autocomplete
                :items="categories"
                :filter="customFilter"
                :error-messages="categoryErrors"
                required
                @blur="$v.category.$touch()"
                item-text="name"
                item-value="id"
                label="Category"
                v-model="category"
                :value="category"
              ></v-autocomplete>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <vue-simplemde
                :configs="configs"
                :error-messages="bodyErrors"
                @blur="$v.body.$touch()"
                v-model="body"
                ref="markdownEditor"
              />
              <span color="error" :error-messages="bodyErrors"></span>
            </v-col>
          </v-row>
          <v-row align="center">
            <v-col>
              <v-btn class="mr-4" type="submit" color="green">Create</v-btn>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-form>
  </v-container>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, maxLength, email } from "vuelidate/lib/validators";
import VueSimplemde from "vue-simplemde";
export default {
  components: {
    VueSimplemde: VueSimplemde,
  },
  mixins: [validationMixin],

  validations: {
    title: { required },
    category: { required },
    body: { required },
  },

  data: () => ({
    title: "",
    category: null,
    body: "",
    categories: [],
    configs: {
      status: false, // disable the status bar at the bottom
      spellChecker: false, // disable spell check
    },
  }),

  computed: {
    titleErrors() {
      const errors = [];
      if (!this.$v.title.$dirty) return errors;
      !this.$v.title.required && errors.push("Title is required");
      return errors;
    },
    categoryErrors() {
      const errors = [];
      if (!this.$v.category.$dirty) return errors;
      !this.$v.category.required && errors.push("Category must be selected");
      return errors;
    },
    bodyErrors() {
      const errors = [];
      if (!this.$v.body.$dirty) return errors;
      !this.$v.body.required && errors.push("Question Body must be set");
      return errors;
    },
  },

  methods: {
    customFilter(item, queryText, itemText) {
      const textOne = item.name.toLowerCase();
      const textTwo = item.abbr.toLowerCase();
      const searchText = queryText.toLowerCase();

      return (
        textOne.indexOf(searchText) > -1 || textTwo.indexOf(searchText) > -1
      );
    },
    submit() {
        this.$v.$touch();
        const slug = this.title.toLocaleLowerCase().replace(/ /g, "-").replace(".", "");
      axios
        .post("/api/questions", {
          title: this.title,
          body: this.body,
          category_id: this.category,
        })
        .then(res => this.$router.push({ path: 'showSingleQuestion', params: { slug }}))
        .catch(err => console.log('error is ', err));
    },
  },
  mounted() {
    axios
      .get("/api/categories")
      .then((res) => (this.categories = res.data.data))
      .catch((err) => console.log(err));
  },
};
</script>

<style lang="scss" scoped>
@import "~simplemde/dist/simplemde.min.css";
</style>

