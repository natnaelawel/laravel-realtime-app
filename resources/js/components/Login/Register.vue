<template>
    <v-container >
        <v-form @submit.prevent="submit" v-model="isValid">
            <v-row  no-gutters>
                <v-col class="register-form" md="4" offset="4">
                    <v-row>
                        <v-col cols="">
                            <v-text-field
                                v-model="username"
                                :error-messages="usernameErrors"
                                label="Username"
                                required
                                @input="$v.username.$touch()"
                                @blur="$v.username.$touch()"
                            ></v-text-field
                        ></v-col>
                    </v-row>
                     <v-row>
                        <v-col cols="">
                            <v-text-field
                                v-model="email"
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
                                v-model.trim="password"
                                label="Enter password"
                                hint="Your password passed! Password rules are not meant to be broken!"
                                :error-messages="passwordErrors"
                                :append-icon="isHidden ? 'mdi-eye' : 'mdi-eye-off'"
                                @click:append="() => (isHidden = !isHidden)"
                                :type="isHidden ? 'password' : 'text'"
                                 @input="$v.password.$touch()"
                            ></v-text-field
                        ></v-col>
                    </v-row>
                       <v-row align="center">
                        <v-col>
                            <v-text-field
                                v-model.trim="confirm"
                                label="Confirm password"
                                :error-messages="confirmErrors"
                                :append-icon="isHidden ? 'mdi-eye' : 'mdi-eye-off'"
                                 @click:append="() => (isHidden = !isHidden)"
                                :type="isHidden ? 'password' : 'text'"
                                 @input="$v.confirm.$touch()"
                            ></v-text-field
                        ></v-col>
                    </v-row>
                    <v-row align="center">
                        <v-col>
                            <v-btn :disabled="!isValid" class="mr-4" color="success" @click="submit">Register</v-btn>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
            <v-alert v-if="error" type="warning" :value="true">
                <p>{{ error }}</p>
            </v-alert>
        </v-form>
    </v-container>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, maxLength, minLength, email, sameAs } from "vuelidate/lib/validators";
export default {
    mixins: [validationMixin],

    validations: {
        username: {
            required,
            minLength: minLength(4),
            maxLength: maxLength(20),
        },
        email: {
            required,
            email
        },
        password: {
            required,
            minLength: minLength(6)
        },
        confirm: {
            sameAsPassword: sameAs('password')
        }
    },

    data: () => ({
        username: "",
        email: "",
        password: "",
        confirm: "",
        valid: true,
        value: true,
        isValid: true,
        isHidden: true,
        error: '',
    }),

    computed: {
        usernameErrors() {
            const errors = [];
            if (!this.$v.username.$dirty) return errors;
            !this.$v.username.required && errors.push("Username is required");
            !this.$v.username.minLength && errors.push(`Username must have at least ${ this.$v.username.$params.minLength.min  } letters.`);

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

            if (!this.$v.password.$dirty) return errors;
            !this.$v.password.required && errors.push("Password is required");
            !this.$v.password.minLength && errors.push(`Password must have at least ${ this.$v.password.$params.minLength.min } letters.`);

            return errors;
        },
        confirmErrors() {
            const errors = [];
            !this.$v.confirm.sameAsPassword && errors.push("Passwords must be identical.");
            return errors;
        }

    },

    methods: {
        submit() {
            this.$v.$touch();
            if (this.$v.$invalid) {
            } else {
                // console.log(this.form);
                // User.register(this.form);
                axios.post('api/auth/register', {
                    name: this.username,
                    email: this.email,
                    password: this.password
                })
                .then(res =>{
                    User.responseAfterLogin(res.data);
                    this.$router.push({name: 'home'});
                    })
                .catch(err => this.error = err.response.data.error);
            }
        },


    }
};
</script>



<style lang="scss" scoped>
    // @import '~vuetify/src/styles/main.sass';

    .register-form{
        margin: 0 auto;
    }
</style>
