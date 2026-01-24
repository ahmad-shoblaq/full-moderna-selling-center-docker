# Selling Center – Dockerized PHP Application

This project is a PHP & MySQL web application deployed on a **Virtual Private Server (VPS)** using **Docker** and **Docker Compose**.

The application was deployed on a **DigitalOcean VPS** running **Ubuntu** and is publicly accessible using the server’s IP address.

---

## Requirements

Before deploying this project on a VPS, the following must be installed:

- Git
- Docker
- Docker Compose
- Ubuntu-based VPS (DigitalOcean)

---

## Deployment Instructions (VPS)

### 1. Connect to the VPS
ssh root@<VPS_IP>

### 2. Install Git
sudo apt update
sudo apt install git -y

### 3. Install Docker
sudo apt install docker.io -y
sudo systemctl start docker
sudo systemctl enable docker

### 4. Install Docker Compose
sudo apt install docker-compose -y

### 5. Clone the GitHub repository
git clone https://github.com/ahmad-shoblaq/full-moderna-selling-center-docker.git
cd full-moderna-selling-center-docker

### 6. Build and run the containers
docker-compose down -v
docker-compose up -d --build

### 7. Verify containers are running
docker-compose ps

---

## Production URL
http://64.226.83.12:8080/

---

## Docker Setup Overview
- PHP 8.2 + Apache container for the application

- MySQL 8.0 container for the database

- Docker Compose manages networking and startup order

- Environment variables are used for database credentials

- Port 8080 is mapped to port 80 inside the container

---

## Key Files
- Dockerfile – Builds the PHP/Apache image

- docker-compose.yml – Defines application and database services

- src/db.php – Handles database connection using environment variables

---

## Notes
- The project was deployed on a DigitalOcean VPS

- Containers were verified using docker-compose ps

- The application is publicly accessible via the VPS IP address

---

## Author
*Ahmad Monther Issa Shoblaq*
*120220369*