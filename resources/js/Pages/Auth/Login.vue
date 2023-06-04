<template>
    <Head>
        <title>Login Account</title>
    </Head>
    <div class="col-md-4">
        <div class="fade-in">
            <div class="card-group">
                <div class="card border-top border-0 shadow-sm rounded-xl p-4">
                    <div class="card-body">
                        <div class="text-start">
                            <h5><strong>Login Account</strong></h5>
                            <p class="text-muted">Sign In to your account</p>
                        </div>
                        <div
                            v-if="session.status"
                            class="alert alert-success mt-3"
                        >
                            {{ session.status }}
                        </div>
                        <form @submit.prevent="submit">
                            <div class="input-group mb-3">
                                <input
                                    class="form-control"
                                    v-model="form.email"
                                    :class="{ 'is-invalid': errors.email }"
                                    type="email"
                                    placeholder="Email Address"
                                />
                            </div>
                            <div v-if="errors.email" class="alert alert-danger">
                                {{ errors.email }}
                            </div>
                            <div class="input-group mb-3">
                                <input
                                    class="form-control"
                                    v-model="form.password"
                                    :class="{ 'is-invalid': errors.password }"
                                    type="password"
                                    placeholder="Password"
                                />
                            </div>
                            <div
                                v-if="errors.password"
                                class="alert alert-danger"
                            >
                                {{ errors.password }}
                            </div>
                            <div class="row">
                                <div class="col-15 mb-3 text-end">
                                    <Link href="/forgot-password"
                                        >Forgot Password?</Link
                                    >
                                </div>
                                <div class="col-15">
                                    <button
                                        class="btn btn-secondary shadow-sm rounded-sm px-4 w-100"
                                        type="submit"
                                    >
                                        <strong>LOGIN</strong>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutAuth from "../../Layouts/Auth.vue";

//import reactive
import { reactive } from "vue";

//import inertia adapter
import { Inertia } from "@inertiajs/inertia";

//import Heade and useForm from Inertia
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    //layout
    layout: LayoutAuth,

    //register component
    components: {
        Head,
        Link,
    },

    props: {
        errors: Object,
        session: Object,
    },

    //define composition API
    setup() {
        //define form state
        const form = reactive({
            email: "",
            password: "",
        });

        //submit method
        const submit = () => {
            //send data to server
            Inertia.post("/login", {
                //data
                email: form.email,
                password: form.password,
            });
        };

        //return form state and submit method
        return {
            form,
            submit,
        };
    },
};
</script>

<style></style>
