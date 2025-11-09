# coding-theory-2025

![PHP Version](https://img.shields.io/badge/PHP-8.3-brightgreen.svg)
![Composer](https://img.shields.io/badge/Composer-Compatible-orange.svg)
![PHPUnit](https://img.shields.io/badge/PHPUnit-12.1-blueviolet.svg)
![Docker](https://img.shields.io/badge/Docker-✓-blue?logo=docker&logoColor=white&style=flat)
![Docker Compose](https://img.shields.io/badge/Docker_Compose-✓-blue?logo=docker&logoColor=white&style=flat)
![License](https://img.shields.io/badge/License-MIT-blue.svg)

Implementations of coding algorithms for a university course with PHP 8.3

## Implemented coding algorithms:

| Algorithm |
|-----------|
| Shannon   |

## Requirements:
1. Docker version >= 25.0.3
2. Docker Compose version >= v2.24.5-desktop.1

## Installation:
```bash
git@github.com:forest-chan/coding-theory-2025.git
cd coding-theory-2025
make build
make up
```

## Usage:
1. Run all coding algorithms test cases:
```bash
make run-all
```
2. Run Shannon algorithm test cases:
```bash
make run-shannon
```
