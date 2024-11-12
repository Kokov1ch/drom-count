## Sum Count

Необходимо пройти по всем подкаталогам указанной директории и суммировать все числа, содержащиеся в файлах с именем count. Возвратить общую сумму всех чисел.

## Usage
Для развёрки локального окружения требуется Docker.
### 1. Запустить контейнер 
```bash
make build
```
### 2. Запустить скрипт
```bash
make count path=<path/to/directory>
```
или
```bash
docker compose exec php php src/main.php --directory=<path/to/directory>
```
Для запуска с использованием предварительной очистки от невалидных символов запусать:
```bash
make count-sanitie path=<path/to/directory>
```
