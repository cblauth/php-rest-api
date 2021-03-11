# PHP REST API

## Running the application using docker

* Clone the repositry
```
git clone https://github.com/cblauth/php-rest-api.git
```
* Create the Docker Image
```
docker build -t api .
```
* Run the image using port 80
```
docker run -p 80:80 api
```
 * Open the endpoint in your browser
```
http://localhost/grade_process.php
```
** If you read "error: invalid requetst", the API is running

## Testing

* Execute test.php in your command line
```
php test/test.php
```
