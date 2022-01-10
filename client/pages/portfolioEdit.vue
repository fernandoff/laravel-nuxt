<template>

  <div class="container p-2 lg:p-8 flex flex-col items-center">

      <form class="w-full max-w-xl bg-white shadow-md rounded px-8 pt-6 pb-8 mt-4">

        <div class="flex flex-wrap mb-6">

          <div class="w-full text-center mx-auto mb-4">
            <n-link to="/">
              <push-button theme="white" class="self-center"> Return Home </push-button>
            </n-link>
          </div>

          <div class="w-full px-1 md:w-1/2 mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="company">
              Company
            </label>
            <input v-model="currentPortfolio.company" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company" type="text" placeholder="Company">
          </div>

          <div class="w-full px-1 md:w-1/2 mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
              Company Logo
            </label>
            <input v-model="currentPortfolio.company_logo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_logo" type="text" placeholder="Logo URL">
          </div>

          <div class="w-full px-1 mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
              Role
            </label>
            <input v-model="currentPortfolio.role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role" type="text" placeholder="Role">
          </div>

          <div class="w-full px-1 mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
              Description
            </label>
            <textarea v-model="currentPortfolio.description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text" placeholder="Description"></textarea>
          </div>

          <div class="w-full px-1 md:w-1/2 mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
              Start
            </label>
            <date-picker
              format="YYYY-MM-DD"
              value-type="format"
              v-model="currentPortfolio.start"/>
          </div>

          <div class="w-full px-1 md:w-1/2 mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
              End
            </label>
            <date-picker
              format="YYYY-MM-DD"
              value-type="format"
              v-model="currentPortfolio.end"/>
          </div>

          <div class="w-full flex items-center justify-center mt-5">
            <button @click="addExperience" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
              Save Experience
            </button>
          </div>

        </div>

      </form>

    <ul v-if="portfolios.length > 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full sm:grid-cols-2 lg:grid-cols-3">
      <portfolio-card
        @delete="deletePortfolio"
        @edit="editPortfolio"
        v-for="(portfolio, index) in portfolios"
        :key="index"
        :portfolio="portfolio"
        :isAdmin="true"/>
    </ul>

  </div>

</template>

<script lang="ts">
import Vue from 'vue'
import { Portfolios } from '@/types/api'
import { Portfolio } from '@/types/api'

export default Vue.extend({
  data () {
    const portfolios:Portfolios = []
    const currentPortfolio:Portfolio = {}
    const count:number = 4
    const dateToday:Date = new Date()

    return {
      currentPortfolio,
      portfolios,
      count,
      dateToday,
    }
  },
  mounted () {
    this.currentPortfolio = {
      id: 0,
      company: '',
      role: '',
      description: '',
      start: null,
      end: null,
    }
    this.get(this.count)
  },
  methods: {

    async deletePortfolio (portfolio: any) {
      if (window.confirm('Delete portfolio from company ' + portfolio.company + '?')) {
        await this.$axios.delete('portfolios/' + portfolio.id)
        await this.get(this.count)
      }
    },

    editPortfolio (portfolio: any) {
      this.currentPortfolio = portfolio
      // this.currentPortfolio = Object.assign({}, portfolio)
    },

    async get (count: number): Promise<void> {
      this.portfolios = (
        await this.$axios.get('portfolios', { params: { count } })
      ).data.data.data as Portfolios
    },

    async addExperience (): Promise<void|boolean> {
      if (!this.currentPortfolio.company || !this.currentPortfolio.role || !this.currentPortfolio.description || !this.currentPortfolio.start || !this.currentPortfolio.end) {
        alert('Complete form before send')
        return false
      }

      const retorno = await this.$axios.post('portfolios', this.currentPortfolio)
      console.log(retorno)

      this.currentPortfolio = {}

      this.get(this.count)
    },

    async edit (): Promise<void> {
      await this.$axios.post('portfolios', this.currentPortfolio)
    },

    total (count: number): void {
      this.portfolios = []
      this.count = count
      this.get(this.count)
    },
  },
})
</script>
