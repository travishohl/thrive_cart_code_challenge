# travishohl/thrift_cart_code_challenge

An implementation of the solution to Thrift Cart's developer code challenge.

## Prerequisites

Before running PHPUnit or PHPStan, make sure you have the following:

- Docker
- An Internet connection (to download Docker images initially)

There are shell scripts located in the `bin` directory of this project which
will invoke various `docker run` commands. This avoids the need to install
project dependencies locally, and helps ensure that this project runs the same
way on different machines.

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/travishohl/thrift_cart_code_challenge.git
    ```

2. Navigate to the project directory:

    ```bash
    cd thrift_cart_code_challenge
    ```

3. Install dependencies using Composer:

    ```bash
    ./bin/composer install
    ```

## Running PHPUnit Tests

PHPUnit is a testing framework for PHP. To run tests, use the following command:

```bash
./bin/composer test
```

This will execute PHPUnit and run the tests located in the `tests` directory.

## Running PHPStan for Static Analysis

PHPStan is a static analysis tool for finding errors in the code without running it. To perform static analysis, run the following command:

```bash
./bin/composer analyze
```

This command will execute PHPStan and analyze the project code, providing feedback on potential issues.
