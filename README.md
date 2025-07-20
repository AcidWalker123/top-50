# 🪙 Top-50 Cryptocurrency Tracker

A full-stack web application for tracking the top 50 cryptocurrencies. Built with Symfony (PHP) on the backend, Vue.js on the frontend, and PostgreSQL for storage. All services are containerized with Docker.

---

## 📦 Tech Stack

- **Backend**: PHP 8.2 (Symfony)
- **Frontend**: Vue.js + Vite
- **Database**: PostgreSQL 15
- **Cache**: Redis
- **Web Server**: Nginx
- **Orchestration**: Docker + Docker Compose

---

## 🚀 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/AcidWalker123/top-50.git
cd top-50
```

### 2. Install Frontend Dependencies
```bash
cd frontend
npm i
npm run build
cd ..
```

### 3. Configure Backend Environment
```bash
cd backend
cp .env .env.local
```
Then, open .env.local and replace the following:
```bash
CMC_PRO_API_KEY=your_api_key_here
```
You can get your API key from CoinMarketCap API.

### 6. Set Executable Permissions (from project root)
```bash
chmod +x backend/entrypoint-scheduler.sh
chmod +x backend/entrypoint.sh
```

### 7. Start the Application
```bash
docker-compose up --build -d
```

### 8. After succesful setup visit http://localhost:8080

### 9. To stop the Application
```bash
docker-compose down
```

