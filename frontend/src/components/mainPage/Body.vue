<template>
  <div class="crypto-table-container">
    <h2>Cryptocurrency Market</h2>

    <div v-if="loading" class="spinner"></div>

    <div v-else-if="error" class="error-message">
      {{ error }}
    </div>

    <table v-else class="crypto-table">
      <thead>
        <tr>
          <th>Ticker</th>
          <th>Price (USD)</th>
          <th>24h Change (%)</th>
          <th>Market Cap (USD)</th>
          <th>24h Volume (USD)</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="currency in currencies" :key="currency.ticker">
          <td>{{ currency.ticker }}</td>
          <td>${{ formatNumber(currency.price) }}</td>
          <td :class="{ negative: currency.change24h < 0, positive: currency.change24h > 0 }">
            {{ currency.change24h }}%
          </td>
          <td>${{ formatNumber(currency.marketCap) }}</td>
          <td>${{ formatNumber(currency.volume24h) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script setup>
import { ref, onMounted } from 'vue'
import { fetchCurrencies } from '../../js/currencyRequest.js'

const currencies = ref([])
const loading = ref(true)
const error = ref(null)

const formatNumber = (value) => {
  return Number(value).toLocaleString(undefined, { maximumFractionDigits: 2 })
}

onMounted(async () => {
  try {
    currencies.value = await fetchCurrencies()
  } catch (err) {
    error.value = 'Failed to load data. Please try again later.'
    console.error(err)
  } finally {
    loading.value = false
  }
})
</script>


<style scoped>
.crypto-table-container {
  padding: 1.5rem;
  font-family: Arial, sans-serif;
}

.error-message {
  color: red;
  text-align: center;
  margin-top: 2rem;
  font-weight: bold;
}

.crypto-table {
  width: 100%;
  border-collapse: collapse;
}

.crypto-table th,
.crypto-table td {
  padding: 0.75rem;
  text-align: left;
  border: 1px solid #242424;
}

.crypto-table thead {
  background-color: #242424;
}

.positive {
  color: green;
}

.negative {
  color: red;
}

/* Simple spinner styling */
.spinner {
  margin: 40px auto;
  border: 6px solid #f3f3f3; /* Light grey */
  border-top: 6px solid #242424; /* Dark color */
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
}

/* Animation */
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
