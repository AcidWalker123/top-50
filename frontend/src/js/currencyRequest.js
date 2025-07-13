export async function fetchCurrencies() {
  try {
    const response = await fetch(`${import.meta.env.VITE_API_URL}/currency`);
    const data = await response.json();
    return data.data ?? data;
  } catch (error) {
    console.error('Failed to fetch currencies:', error);
    return [];
  }
}