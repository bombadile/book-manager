# Simple book manager API
The project was developed in PHP using best practices, design patterns, methodology TDD and PSR standards.

Technology stack: PHP 7.4, Xdebug 2.9, GraphQL, MySql 8.0, Doctrine, Docker, Nginx.

## Installation

To install the project you need to clone the files from the repository. And in the root directory of the project, run the following commands:

    docker-compose build
    docker-compose up -d
    docker-compose run --rm php-cli composer install
    cat db/dump.sql | docker exec -i PROJECT_FOLDER_mysql_1 /usr/bin/mysql -u root --password=root book_manager
    sudo chmod -R 777 var
    docker-compose run --rm php-cli composer test
**PROJECT_FOLDER** - this is the root directory of the project. The default is **book-manager**.

After installing and configuring the project, the database will be filled with a set of test data.

http://localhost:8080/graphql - URL for query execution.
