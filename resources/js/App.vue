<script setup>
import axios from "axios"
import Errors from './components/Errors.vue'
import { ref, reactive } from "vue"
const urlInput = ref("")
const urlsList = reactive([])
const errors = ref({})

const generateShortUrl = async () => {
    let dataForm = {
        short_url: urlInput.value,
        _token: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
    };

    errors.value = {}

    try {
        const { data } = await axios.post("/urls", dataForm)        
        urlsList.push(data.short_url)
    } catch (e) {
        if (e.response.status === 422) {
            errors.value = e.response.data.errors;
        }
    }
};
</script>
<template>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-4xl text-center">Short Url Generator</h1>
        <p class="text-center">Just copy a url and get a short url</p>
        <div class="p-2 text-center">
            <form
                @submit.prevent="generateShortUrl"
                name="url_form"
                id="url_form"
                action="/urls"
                method="post"
                class="flex flex-col"
            >
                <input
                    name="url"
                    v-model="urlInput"
                    required
                    class="w-80 border border-cyan-500 h-5 p-5 outline-cyan-600 rounded-md"
                />
                <button
                    type="submit"
                    class="bg-cyan-500 hover:bg-cyan-600 my-2 h-5 p-5 rounded-md flex items-center justify-center text-white font-bold"
                >
                    Generate
                </button>
                <Errors :errors="errors" />
            </form>
        </div>
        <div>
            <ul>
                <li v-for="(urlItem, index) in urlsList" :key="index">
                    <a :href="urlItem">{{ urlItem }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>
