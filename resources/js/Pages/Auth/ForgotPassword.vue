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
    session: Object,
});

const form = reactive({
    email: "",
});

const submit = () => {
    Inertia.post("/forgot-password", {
        email: form.email,
    });
};
</script>

<template>
    <Head>
        <title>Forgot Password</title>
    </Head>
    <div class="col-md-4">
        <div class="card border rounded-3 p-5">
            <div class="text-start">
                <h5><strong>Reset Password</strong></h5>
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
                <div class="row">
                    <div class="col-12">
                        <button
                            class="btn btn-secondary shadow-sm rounded-sm px-4 w-100"
                            type="submit"
                        >
                            <strong>Reset Password</strong>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
