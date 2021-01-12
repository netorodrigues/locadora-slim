# Locadora Slim

#### Requirements

To setup this project locally you will need:

- **[Docker](https://www.docker.com/)** working in your machine.
- **[docker-compose](https://docs.docker.com/compose/)** already installed.

## Installation

#### Setting up the local environment:

```bash
# Clone the repository
$ git clone https://github.com/netorodrigues/locadora-slim.git && cd locadora-slim

# Rename .env.example to .env
$ cp .env.example .env

# Setup the containers
$ docker-compose up -d

# Install the dependencies using composer
$ docker exec -ti api.locadora composer install

# If you want, run the tests
$ docker exec -ti api.locadora composer test
```

If you want, download and open [this simple screen](https://github.com/netorodrigues/locadora-slim-frontend) to interact with locadora-slim 


![](img/mulan-success.gif)


