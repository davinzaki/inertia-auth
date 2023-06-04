<script>
import AuthLayout from "../../Layouts/Auth.vue";
export default {
    layout: AuthLayout,
};
</script>

<script setup>
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    errors: Object,
    session: Object,
});

const form = reactive({
    email: "",
    password: "",
});

const submit = () => {
    Inertia.post("/login", {
        email: form.email,
        password: form.password,
    });
};
</script>

<template>
    <Head>
        <title>Login Account</title>
    </Head>
    <div class="col-md-4">
        <div class="border rounded-xl p-5">
            <div class="text-start">
                <h5><strong>Login Account</strong></h5>
                <p class="text-muted">Sign In to your account</p>
            </div>
            <div v-if="session.status" class="alert alert-success mt-3">
                {{ session.status }}
            </div>
            <form @submit.prevent="submit">
                <div class="mb-3">
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
                <div class="mb-3">
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
                <div class="row">
                    <div class="col-15 mb-3 text-end">
                        <Link href="/forgot-password">Forgot Password?</Link>
                    </div>
                    <div class="col-15">
                        <button
                            class="btn btn-secondary shadow-sm rounded-sm px-4 w-100"
                            type="submit"
                        >
                            <strong>Login</strong>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
