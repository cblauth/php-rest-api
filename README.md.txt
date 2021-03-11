# PHP REST API

## Running application using docker

* Clone the repositry
* Create the Docker Image
```
docker build -t api .
```
* Run the image using port 80
```
docker run  -p 80:80 api
```
 * Open your browser
```
http://localhost/api/src/grade_process.php
```
** If you read "invalid requetst" it means the API is runnig

## Testing

* Execute test.php in your command line
```
php test/test.php
```
