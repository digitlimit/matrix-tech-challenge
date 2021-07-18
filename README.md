# League Backend Challenge

Extend the webservice with the ability to perform the following operations

Given an uploaded csv file
```
1,2,3
4,5,6
7,8,9
```

1. Echo (given)
    - Return the matrix as a string in matrix format.
    
    ```
    // Expected output
    1,2,3
    4,5,6
    7,8,9
    ``` 
2. Invert
    - Return the matrix as a string in matrix format where the columns and rows are inverted
    ```
    // Expected output
    1,4,7
    2,5,8
    3,6,9
    ``` 
3. Flatten
    - Return the matrix as a 1 line string, with values separated by commas.
    ```
    // Expected output
    1,2,3,4,5,6,7,8,9
    ``` 
4. Sum
    - Return the sum of the integers in the matrix
    ```
    // Expected output
    45
    ``` 
5. Multiply
    - Return the product of the integers in the matrix
    ```
    // Expected output
    362880
    ``` 

The input file to these functions is a matrix, of any dimension where the number of rows are equal to the number of columns (square). Each value is an integer, and there is no header row. matrix.csv is example valid input.  

Run web server
```
go run .
```

Send request
```
curl -F 'file=@/path/matrix.csv' "localhost:8080/echo"
```

# Instruction:

1. Extract the project 
2. Go to the root of the project and run `composer install`
3. Start PHP Server by running `php -S localhost:8080`
4. Run PHPUnit test `./vendor/bin/phpunit`

You can test the application using postman, curl etc

```
curl -F 'file=@matrix.csv' "localhost:8080/echo"
curl -F 'file=@matrix.csv' "localhost:8080/invert"
curl -F 'file=@matrix.csv' "localhost:8080/flatten"
curl -F 'file=@matrix.csv' "localhost:8080/sum"
curl -F 'file=@matrix.csv' "localhost:8080/multiply"
```
