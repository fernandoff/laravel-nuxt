<template>
  <div class="container p-2 lg:p-8 flex flex-col">
    <div class="m-8 flex items-center justify-center">
      <Logo />
    </div>

    <div class="text-center mx-auto mt-4">

      <span class="mr-4">Rimsys Test</span>

      <div class="mt-2 flex mx-auto">
        <n-link to="/profileEdit">
          <push-button theme="whiteLeft" class="-mr-px"> Profile </push-button>
        </n-link>

        <n-link to="/portfolioEdit">
          <push-button theme="whiteRight">
            Portfolio
          </push-button>
        </n-link>
      </div>
    </div>

    <ul v-if="users.length === 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full sm:grid-cols-2 lg:grid-cols-3">
      <contact-card-skeleton v-for="i in 9" :key="`skel-${i}`" />
    </ul>
    <ul v-if="users.length > 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full sm:grid-cols-2 lg:grid-cols-3">
      <contact-card v-for="(user, index) in users" :key="index" :user="user" />
    </ul>

  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Users } from '@/types/api'
export default Vue.extend({
  data () {
    const users:Users = []
    const count:number = 4

    return {
      users,
      count,
    }
  },
  mounted () {
    this.get(this.count)
    console.log('test')
  },
  methods: {
    async get (count: number): Promise<void> {
      await this.$sleep(2000)
      this.users = (
        await this.$axios.get('example', { params: { count } })
      ).data.data as Users
    },
    total (count: number): void {
      this.users = []
      this.count = count
      this.get(this.count)
    },
  },
})
</script>
