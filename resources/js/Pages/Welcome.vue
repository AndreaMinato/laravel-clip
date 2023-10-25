<script setup>
import { Head } from '@inertiajs/vue3';
import GuestLayout from '../Layouts/GuestLayout.vue';
import PrimaryButton from "../Components/PrimaryButton.vue"
import SecondaryButton from "../Components/SecondaryButton.vue"


import { useForm } from '@inertiajs/vue3'



const props = defineProps({
    slug: {
        type: String,
        required: true,
    },
    clip: {
        type: Object,
        required: false,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});


const form = useForm({
    body: props.clip?.body ?? "",
    slug: props.slug,
})



</script>

<template>
    <Head :title="slug" />

    <GuestLayout>
        <form @submit.prevent="form.post('/clip')">
            <div>
                <textarea class="w-full" v-model="form.body" @input="form.clearErrors()"></textarea>
                <div v-if="form.errors.body">{{ form.errors.body }}</div>
            </div>
            <div class="flex justify-end gap-2">
                <SecondaryButton type="button">Share</SecondaryButton>
                <PrimaryButton type="submit" :disabled="form.processing">Save</PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
