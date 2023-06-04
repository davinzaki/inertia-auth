<script>
import AuthLayout from "../../Layouts/Auth.vue";
export default {
    layout: AuthLayout,
};
</script>

<script setup>
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    errors: Object,
    route: Object,
    session: Object,
});

const form = reactive({
    email: props.route.query.email,
    password: "",
    password_confirmation: "",
    token: props.route.params.token,
});

//submit method
const submit = () => {
    //send data to server
    Inertia.post("/reset-password", {
        //data
        email: form.email,
        password: form.password,
        password_confirmation: form.password_confirmation,
        token: form.token,
    });
};
</script>

<template>
    <Head>
        <title>Change Password</title>
    </Head>
    <div class="col-md-4">
        <div class="card border-top border rounded-3 p-4">
            <div class="card-body">
                <div class="text-start mb-2">
                    <h5><strong>Change Password</strong></h5>
                </div>
                <div v-if="session.status" class="alert alert-success mt-2">
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
                    <div v-if="errors.password" class="alert alert-danger">
                        {{ errors.password }}
                    </div>
                    <div class="input-group mb-3">
                        <input
                            class="form-control"
                            v-model="form.password_confirmation"
                            :class="{
                                'is-invalid': errors.password_confirmation,
                            }"
                            type="password"
                            placeholder="Password Confirmation"
                        />
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button
                                class="btn btn-secondary shadow-sm rounded-sm px-4 w-100"
                                type="submit"
                            >
                                Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
