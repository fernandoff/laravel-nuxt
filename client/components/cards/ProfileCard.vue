<template>
  <li class="col-span-1 bg-white rounded-lg shadow">
    <div class="mt-4 flex justify-center">
      <img class="w-12 h-12 bg-gray-300 rounded-full flex-shrink-0" src="https://avatars.dicebear.com/api/human/fer@gmail.com.svg" alt="avatar">
    </div>
    <div class="w-full flex items-center justify-between p-6 space-x-6">
      <div class="flex-1">
        <div class="flex items-center space-x-3">
          <h3 class="text-gray-900 text-sm leading-5 font-medium truncate">
            {{ profile.name }}
          </h3>
        </div>
        <p class="mt-1 text-gray-500 text-sm leading-5 truncate">
          {{ profile.email }}
        </p>

        <p class="mt-5 text-gray-700 whitespace-pre-line">
          {{ profile.biography }}
        </p>

      </div>
    </div>
  </li>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { Profile } from '@/client/types/api'
export default Vue.extend({
  props: {
    profile: {
      type: Object as PropType<Profile>,
      required: true,
    },
  },
  computed: {
  },
  methods: {
  },
})
</script>
