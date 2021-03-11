# PHP REST API

## Running the application using docker

* Clone the repositry
```
git clone https://github.com/cblauth/php-rest-api.git
```
* Open project folder
```
cd php-rest-api
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


## How to use the API
* Send a JSON request to the endpoint http://localhost/grade_process.php, using method POST, with the following structure: 
```
[
  { "name": "John", "grade": 53 },
  { "name": "Jane", "grade": 68 }

]
```
* grade must be an integer between 0 and 100
* name must have at least 2 characters
* response JSON informs if the student has passed or not
* example of response:
```
[
  { "name": "John", "grade": 55, "pass": true },
  { "name": "Jane", "grade": 70, "pass": true }
]
```

## Testing

* Execute test.php in your command line
```
php test/test.php
```
