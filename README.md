# Remote

## To start a demo project

Clone repo:
```shell script
cd ^
git clone git@github.com:Chrazee/remote-docker.git
```

Edit the app service user UID and GID in 'docker-compose.yml, which is the same with your host user:
```shell script
cd ~/remote-docker/app

args:
  APACHE_UID: 1000
  APACHE_GID: 1000
```

Start services:
```shell script
cd ~/remote-docker/app
docker-compose up -d
```

Database migration & app key (only for first start):
```shell script
cd ~/remote-docker/docker/helpers
./artisan.sh migrate:fresh --seed
./artisan.sh key:generate
```

Open up the web UI via browser:
```shell script
 http://127.0.0.1:62080
```

Log In
```shell script
Default username: remote
Default password: remote
```



