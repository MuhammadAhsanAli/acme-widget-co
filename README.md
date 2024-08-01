# Acme Widget Co

## Overview

This project is a simple PHP application designed to demonstrate the use of Composer, PHPUnit,  Docker, Dependency Injection, Strategy Pattern, and best practices such as good separation/encapsulation and small accurate interfaces. The main functionality includes applying offers to a shopping cart and calculating delivery costs.

### Assumptions

- The application is intended to be run in a Docker container for consistency and isolation.
- PHPUnit is used for unit and integration testing.
- The project is self-contained and does not require a web server like Nginx or Apache as it only runs command-line scripts for testing purposes.

## Installation Steps

###Prerequisites
- Docker
- Docker Compose

###Steps
1. Clone the repository:
 ```
https://github.com/MuhammadAhsanAli/acme-widget-co.git
 ```

2. Navigate to the directory
```
cd acme-widget-co
```

3. Build the Docker Image:

This command will build the Docker image based on the Dockerfile.
 ```
docker-compose build
 ```

##Running PHPUnit Tests
After setting up the project as described above, you can run the tests using Docker Compose:
```
docker-compose up
```
This command will start the Docker container and run the PHPUnit tests. You should see output from PHPUnit indicating the results of the tests.

##Additional Notes

- The Dockerfile uses the official PHP CLI image and installs necessary dependencies.
- The `docker-compose.yml` file defines a single service `app` that builds the Docker image and runs PHPUnit tests.
- The source code is located in the `src` directory.
- Unit tests and integration tests are separated into their respective directories under `tests`.

By following the above instructions, you should be able to set up and run the project successfully, demonstrating the application of various software engineering principles and best practices.




