## Standard Lumen API Template with Authentication

This is a barebones API starter-pack based on Lumen 5.7.*

To start using it, clone the repository to a desired location on your machine and run through the following steps.

- Do a "find and replace" from the root of the project, search for the word "DevProject" and replace it with your desired namespace root. The project is currently setup with `DevProject` being the Namespace root (`app/`).

- Run `composer install` to install required dependencies

- copy `.env.example` to `.env` and update the values as required.

- You can either run the project directly on your machine or use **docker**. There's a `docker-compose.yml` file in the root directory as well as supporing docker configuration to help setup your dev environment. By default, just running `docker-compose up` and waiting a few minutes should bring up 4 containers. The `api` container, `web` (nginx proxy) container, `redis` and `database` containers. You can tweak the values in `docker-compose.yml` to suite your needs.

- There are a number of endpoints already defined and documented using `swagger` (OpenApi 3.0).
