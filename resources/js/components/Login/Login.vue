<template>
    <v-container >
        <v-form @submit.prevent="submit">
            <v-row  no-gutters>
                <v-col class="login-form" md="4" offset="4">
                    <v-row>
                        <v-col cols="">
                            <v-text-field
                                v-model="form.email"
                                :error-messages="emailErrors"
                                label="E-mail"
                                required
                                @input="$v.email.$touch()"
                                @blur="$v.email.$touch()"
                            ></v-text-field
                        ></v-col>
                    </v-row>
                    <v-row align="center">
                        <v-col>
                            <v-text-field
                                autocomplete="current-password"
                                v-model="form.password"
                                label="Enter password"
                                hint="Your password passed! Password rules are not meant to be broken!"
                                :error-messages="passwordErrors"
                                :append-icon="
                                    form.password ? 'mdi-eye' : 'mdi-eye-off'
                                "
                                @click:append="() => (form.password = !form.password)"
                                :type="form.password ? 'password' : 'text'"
                                 @input="$v.password.$touch()"
                            ></v-text-field
                        ></v-col>
                    </v-row>
                    <v-row align="center">
                        <v-col>
                            <v-checkbox
                                v-model="form.remember"
                                :error-messages="rememberErrors"
                                label="Remember me?"
                                required
                                @change="$v.remember.$touch()"
                                @blur="$v.remember.$touch()"
                            ></v-checkbox
                        ></v-col>
                    </v-row>
                    <v-row align="center">
                        <v-col>
                            <v-btn class="mr-4" color="green" @click="submit">Login</v-btn>
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
export default {
    mixins: [validationMixin],

    validations: {
        email: { required, email },
        password: { required},
        remember: {
            remember(val) {
                return val;
            }
        }
    },

    data: () => ({
        form:{
            email: "",
            password: "",
            remember: false
        },
        valid: true,
        value: true,
    }),

    computed: {
        rememberErrors() {
            const errors = [];
            if (!this.$v.remember.$dirty) return errors;
            !this.$v.remember.checked &&
                errors.push("You must agree to continue!");
            return errors;
        },
        emailErrors() {
            const errors = [];
            if (!this.$v.email.$dirty) return errors;
            !this.$v.email.email && errors.push("Must be valid e-mail");
            !this.$v.email.required && errors.push("E-mail is required");
            return errors;
        },
        passwordErrors() {
            const errors = [];
            !this.$v.password.required && errors.push("Password is required");
            return errors;
        }

    },

    methods: {
        submit() {
            this.$v.$touch();
            // console.log(this.form);
            User.login(this.form);
        }
    }
};
</script>

<style scoped>
    .login-form{
        margin: 0 auto;
    }
</style>>
