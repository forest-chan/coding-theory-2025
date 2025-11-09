# project containers manipulation
build:
	docker-compose build
up:
	docker-compose up -d
down:
	docker-compose down

# run test cases
run-all: run-shannon

run-shannon:
	php vendor/bin/phpunit ./tests/CodingAlgorithm/Shannon/ShannonTest.php --testdox