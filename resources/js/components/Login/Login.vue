<template>
  <div style="background-image: url('/img/question-mark-2.jpg')">
    <v-form @submit.prevent="submit">
      <v-row no-gutters>
        <v-col class="login-form justify-content-center " md="4" offset="4">
    <v-card>
          <v-row>
            <v-col cols>
              <v-text-field
                class="white--text"
                v-model="email"
                :error-messages="emailErrors"
                label="E-mail"
                required
                @blur="$v.email.$touch()"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row align="center">
            <v-col>
              <v-text-field
                class="white--text"
                autocomplete="current-password"
                v-model="password"
                label="Enter password"
                hint="Your password passed! Password rules are not meant to be broken!"
                :error-messages="passwordErrors"
                :append-icon="password ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="() => (isHidden = !isHidden)"
                :type="isHidden ? 'password' : 'text'"
                @blur="$v.password.$touch()"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row align="center">
            <v-col>
              <v-checkbox v-model="remember" class="white--text" label="Remember me?"></v-checkbox>
            </v-col>
          </v-row>
          <v-row align="center">
            <v-col>
              <v-btn class="mr-4" color="green" @click="submit">Login</v-btn>
            </v-col>
          </v-row>
    </v-card>
        </v-col>

      </v-row>
    </v-form>
  </div>
</template>

<script>
// if (!this.$v.email.$dirty) return errors;

import { validationMixin } from "vuelidate";
import { required, maxLength, email } from "vuelidate/lib/validators";
export default {
  mixins: [validationMixin],

  validations: {
    email: { required, email },
    password: { required },
    // remember: {
    //     remember(val) {
    //         return val;
    //     }
    // }
  },

  data: () => ({
    email: "",
    password: "",
    remember: false,
    isHidden: true,
    valid: true,
    value: true,
  }),

  computed: {
    // rememberErrors() {
    //     const errors = [];
    //     if (!this.$v.remember.$dirty) return errors;
    //     !this.$v.remember.checked && errors.push("Remb");
    //     return errors;
    // },
    emailErrors() {
      const errors = [];
      if (!this.$v.email.$dirty) return errors;
      !this.$v.email.email && errors.push("Must be valid e-mail");
      !this.$v.email.required && errors.push("E-mail is required");
      return errors;
    },
    passwordErrors() {
      const errors = [];
      if (!this.$v.password.$dirty) return errors;
      !this.$v.password.required && errors.push("Password is required");
      return errors;
    },
  },

  methods: {
    submit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
      } else {
        User.login({
          email: this.email,
          password: this.password,
        });
      }
    },
  },
};
</script>

<style scoped>
.login-form {
  margin: 50px auto;
}
</style>>
