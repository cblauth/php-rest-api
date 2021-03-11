# PHP REST API

## Running the application using docker

* Clone the repositry
* Create the Docker Image
```
docker build -t api .
```
* Run the image using port 80
```
docker run -p 80:80 api
```
 * Open in your browser the endpoint
```
http://localhost/grade_process.php
```
** If you read "invalid requetst" it means the API is runnig

## Testing

* Execute test.php in your command line
```
php test/test.php
```
