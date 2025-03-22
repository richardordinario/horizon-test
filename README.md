# Simple Music Player

This is a simple music player application that allows you to:
- Play music
- Pause music
- Skip to the next track
- Go back to the previous track
- Play music in shuffle mode

## Features
- User-friendly interface
- Basic music controls
- Shuffle mode for random playback

## Setup Instructions

### Prerequisites
- PHP >= 8.0
- Composer
- Node.js and npm
- MySQL or any supported database

### Steps to Set Up the Laravel Project

1. **Clone the Repository**:
    ```bash
    git clone <repository-url>
    cd horizon-test
    ```

2. **Install Dependencies**:
    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Set Up Environment File**:
    Copy `.env.example` to `.env` and configure your database and other environment variables:
    ```bash
    cp .env.example .env
    ```

4. **Generate Application Key**:
    ```bash
    php artisan key:generate
    ```

5. **Run Migrations**:
    ```bash
    php artisan migrate
    php artisan db:seed
    ```

6. **Start the Development Server**:
    ```bash
    php artisan test --filter SongControllerTest
    php artisan serve
    ```

7. **Access the Application**:
    Open your browser and navigate to `http://localhost:8000`.

## Usage
- Use the interface to control playback and shuffle tracks.
