# rr-symfony-centrifugo

## Installation

```
composer require pordaksergey/rr-symfony-centrifugo
```
## Usage
1.
add centrifugo endpoint to .env
```
CENTRIFUGO=http://centrifugo:8000
```
2. enable grpc plugin to .rr
   ```
   grpc:
     listen: tcp://0.0.0.0:30000
     proto:
       - vendor/rr-symfony-centrifugo/proto/centrifugo.proto
   ```
3. exsample centrifugo config
   ```
   {
   "admin": true,
   "engine": "redis",
   "redis_address": [
       "redis:6379"
   ],
   "redis_db": 1,
   "api_key": "secret",
   "admin_password": "password",
   "admin_secret": "admin_secret",
   "allowed_origins": [
       "http://localhost:8080",
       "http://127.0.0.1:8080"
   ],
   "token_hmac_secret_key": "secret",
   "proxy_publish": true,
   "proxy_subscribe": true,
   "allow_subscribe_for_client": false,

   "grpc_api": {
       "enable": true,
       "port": 30000
   },

   "proxy_connect_endpoint": "grpc://php:30000",
   "proxy_connect_timeout": "10s",

   "proxy_publish_endpoint": "grpc://php:30000",
   "proxy_publish_timeout": "10s",

   "proxy_subscribe_endpoint": "grpc://php:30000",
   "proxy_subscribe_timeout": "10s",

   "proxy_refresh_endpoint": "grpc://php:30000",
   "proxy_refresh_timeout": "10s",

   "proxy_sub_refresh_endpoint": "grpc://php:30000",
   "proxy_sub_refresh_timeout": "1s",

   "proxy_rpc_endpoint": "grpc://php:30000",
   "proxy_rpc_timeout": "10s"
   }
   ```
    