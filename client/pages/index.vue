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

    <ul v-if="profile.name" class="mx-auto flex max-w-3xl bg-gray-100 rounded p-8 w-full sm:grid-cols-2 lg:grid-cols-3">
      <profile-card :profile="profile"/>
    </ul>

    <ul v-if="portfolios.length > 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full sm:grid-cols-2 lg:grid-cols-3">
      <portfolio-card
        v-for="(portfolio, index) in portfolios"
        :key="index"
        :portfolio="portfolio" />
    </ul>

  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Portfolios, Users } from '@/types/api'
import { Profile } from '@/types/api'
export default Vue.extend({
  data () {
    const users:Users = []
    const count:number = 4
    const portfolios:Portfolios = []
    const profile:Profile = {}

    return {
      profile,
      portfolios,
      users,
      count,
    }
  },
  mounted () {
    this.getPortfolios(this.count)
    this.getProfile()
  },
  methods: {
    async getPortfolios (count: number): Promise<void> {
      this.portfolios = (
        await this.$axios.get('portfolios', { params: { count } })
      ).data.data.data as Portfolios
    },
    async getProfile (): Promise<void> {
      this.profile = (
        await this.$axios.get('profiles')
      ).data.data.data[0] as Profile
    },
  },
})
</script>
