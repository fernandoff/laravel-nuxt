<template>
  <li class="col-span-1 bg-white rounded-lg shadow">
    <div class="w-full flex items-center justify-between p-6 space-x-6">
      <div class="flex-1 truncate">
        <div class="flex items-center space-x-3">
          <h3 class="text-gray-900 text-sm leading-5 font-medium truncate">
            {{ portfolio.company }}
          </h3>
<!--          <span-->
<!--            v-if="is_admin"-->
<!--            class="flex-shrink-0 inline-block px-2 text-teal-800 text-xs leading-4 font-medium bg-green-100 rounded-full py-0.5"-->
<!--          >-->
<!--            Admin-->
<!--          </span>-->
        </div>
        <p class="mt-1 text-gray-500 text-sm leading-5 truncate">
          {{ portfolio.role }}
        </p>

      </div>
      <a
        @click.prevent="deletePortfolio(portfolio)"
        class="object-right-top items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border-transparent transition ease-in-out duration-150 hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
        href="#"
      >
        <icon-trash class="w-5 h-5 "  />
      </a>
      <a
        @click.prevent="editPortfolio(portfolio)"
        class="object-right-top items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border-transparent transition ease-in-out duration-150 hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
        href="#"
      >
        <icon-edit class="w-5 h-5 "  />
      </a>
<!--      <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0" :src="user.avatar" alt="avatar">-->
    </div>
    <div class="border-t border-gray-200">
      <div class="-mt-px flex">
        <div class="w-0 flex-1 flex border-r border-gray-200">
          <a
            class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-bl-lg transition ease-in-out duration-150 hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
            href="#"
          >
            <small>Start</small>
            <icon-calendar class="w-5 h-5" />
            <span class="ml-3">{{portfolio.start}}</span>
          </a>
        </div>
        <div class="w-0 flex-1 flex border-r border-gray-200">
          <a
            class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-bl-lg transition ease-in-out duration-150 hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
            href="#"
          >
            <small>End</small>
            <icon-calendar class="w-5 h-5" />
            <span class="ml-3">{{portfolio.end}}</span>
          </a>
        </div>
      </div>
    </div>
  </li>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { Portfolio } from '@/client/types/api'
export default Vue.extend({
  props: {
    portfolio: {
      type: Object as PropType<Portfolio>,
      required: true,
    },
  },
  computed: {
    is_admin () {
      return Math.random() >= 0.5
    },
  },
  methods: {
    editPortfolio (porfolio: any) {
      this.$emit('edit', porfolio)
    },
    deletePortfolio (porfolio: any) {
      this.$emit('delete', porfolio)
    },
  },
})
</script>
