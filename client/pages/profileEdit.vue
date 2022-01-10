<template>

  <div class="w-full max-w-xl">

    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mt-4">

      <div class="text-center mx-auto mb-4">
        <n-link to="/">
          <push-button theme="white" class="self-center"> Return Home </push-button>
        </n-link>
      </div>

      <div class="mb-4 flex justify-center">
        <img class="w-12 h-12 bg-gray-300 rounded-full flex-shrink-0" src="https://avatars.dicebear.com/api/human/fer@gmail.com.svg" alt="avatar">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Name
        </label>
        <input v-model="profiles.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Email
        </label>
        <input v-model="profiles.email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="Email">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="biography">
          Biography
        </label>
        <textarea v-model="profiles.biography" class="h-52 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="biography" type="text" placeholder="Biography"></textarea>
      </div>

      <div class="flex items-center justify-center">
        <button @click="save" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
          Save
        </button>
      </div>

    </form>
  </div>

</template>

<script lang="ts">
import Vue from 'vue'
import { Profiles } from '@/types/api'
export default Vue.extend({
  data () {
    const profiles:Profiles = []
    const count:number = 4

    return {
      profiles,
      count,
    }
  },
  mounted () {
    this.get(this.count)
  },
  methods: {
    async get (count: number): Promise<void> {
      this.profiles = (
        await this.$axios.get('profiles', { params: { count } })
      ).data.data.data[0] as Profiles
    },

    async save (): Promise<void> {
      const retorno = await this.$axios.post('profiles', this.profiles)
      console.log(retorno)
    },
  },
})
</script>
