<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


###
Bank api
This  project is  based on docker consist of : 
1)Mysql 
2)app
3)Nginx

After  deployment , it will be accessible via  
http:://ip-addr:6090 
###
Deployment
```
docker-compose -f deployment/docker-compose.yml  -p bankapi up --build
```
###
Rest API List:
````angular2html
Customer Management:
    1) List all Customers:
        GET http://ip-addr:6090/api/v1/customers
    2)Add New  Customer:
        POST http://ip-addr:6090/api/v1/customer
        with JSON:
            {
                "mobile_number" : "02356822856",
                "name" : "user1"
            }

 Card Management: 
    1) List All Cards:
        GET http://ip-addr:6090/api/v1/cards
    2) List All Cards by customerID:
        GET http://ip-addr:6090/api/v1/card/{customerId}
    3) Add Card To customer
        POST http://ip-addr:6090/api/v1/addcard
        with JSON:
        {
            "card_number" : "6274121177836589",
            "mobile_number" : "09122345680",
            "balance" : "100001"
        }

Payment Management:
    1)Transfer
        POST http://ip-addr:6090/api/v1/transfer
        with JSON:
            {
                "origin_card" : "6221778369325896",
                "destination_card" : "6274121177836580",
                "payment_value" : "30000"
            }
    2) Get n last transaction 
        http://172.16.15.199:6090/api/v1/transfers/{count}   

````    

