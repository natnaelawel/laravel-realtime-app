<template>
    <div>
        <h1>new reply</h1>
        <v-form v-if="slug" v-model="valid" ref="form" lazy-validation>
            <v-textarea
                background-color="transparent"
                outlined
                v-model="reply"
                filled
                auto-grow
                label="Reply"
                :rules="replyRules" 
                :counter="100" 
                required
                rows="2"
                row-height="20"
                >
            </v-textarea>
            <v-btn
                @click="submit"
                :disabled="!valid"
            > submit
            </v-btn>
        </v-form>
    </div>
</template>
<script>    
    export default {
        props: ['slug'],
        data: () => ({
            valid: true,
            reply: "",
            replyRules: [v => !!v || "Name is required", v => (v && v.length <= 100) || "Name must be less than 10 characters"],
        }),
        methods: {
            submit() {
                if (this.$refs.form.validate()) {
                    axios.post(`/api/questions/${this.slug}/replies`, {
                        body: this.reply,
                    })
                    .then(res=> {
                        this.$emit('created', res.data);
                        this.clear();
                    });
                }
            },
            clear() {
                this.$refs.form.reset();
            }
        }
    };
</script>

<style scoped>
</style>