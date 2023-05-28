# Copy .env.example to .env
There are some test env variables that have to work

```cp .env.example .env```

# Get free token to use Forex api

https://console.fastforex.io/#
add it to .env FAST_FOREX_TRIAL_API_KEY

# Build image

``` docker build -t genesis-test . ```

# Run container

``` docker run -d -p 8000:80 -v .:/var/www/html genesis-test ```