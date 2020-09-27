# JAGAAD Wishlist API

This is a sample project. It implements a Wishlist API with docker-friendly environment, JWT authentication, database migrations & seeds, Feature tests and Unit tests

## Running the development environment

```
docker-compose up
```

It runs Laravel8 + MariaDb + Webserver

http://localhost:3000

## Setup


To run the "artisan" command

```
docker-compose exec myapp php artisan
```

*Suggestion*: define the previous command in your .bash_profile as an ALIAS to speed things up

```
alias artisan="docker-compose exec myapp php artisan"
```

## Run the tests

```
artisan test
```

## Api

The api uses this base address:

```
http://localhost:3000/api/[endpoint]
```

## Endpoints list

#Authentication

* POST api/login email/password based authentication 

Query parameters:
```
email: fake@email.com
password: 12345678
```

Success authentication response:
```
{
    "status": "OK",
    "message": null,
    "data":{
       "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6NDAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYwMTIyODIyOCwiZXhwIjoxNjAxMzE0NjI4LCJuYmYiOjE2MDEyMjgyMjgsImp0aSI6Ik5VdUdiVHgxbkI2VU1PYUciLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.cnw_mNWkbIl4IpeffS4nkiFsG-TxbMTQj-BckTfbBA8"
    }
}
```

Wrong authentication response:
```
{
    "status": "ERROR",
    "message": "Wrong email or password",
    "data": null
}
```

* GET api/me gets the logged user data

Headers
```
Authorization: Bearer TOKEN
Accept: application/json
```

Success response:
```
{
    "status": "OK",
    "message": null,
    "data":{
        "id": 1,
        "name": "yzLlzGTuAP",
        "email": "fake@email.com",
        "email_verified_at": "2020-09-27T14:01:30.000000Z",
        "created_at": "2020-09-27T14:01:29.000000Z",
        "updated_at": "2020-09-27T14:01:29.000000Z"
    }
}
```

Error response:
```
{
    "message": "Unauthenticated."
}
```


* GET api/logout 
Headers
```
Authorization: Bearer TOKEN
Accept: application/json
```

Successful response:
```
{
    "status": "OK",
    "message": null,
    "data": null
}
```

Error response:
```
{
    "message": "Unauthenticated."
}
```




* GET api/refresh refresh the jwt token (default token expire 24h)
Headers
```
Authorization: Bearer TOKEN
Accept: application/json
```

Successful response:
```
{
    "status": "OK",
    "message": null,
    "data":{
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6NDAwMFwvYXBpXC9yZWZyZXNoIiwiaWF0IjoxNjAxMjI5NTA5LCJleHAiOjE2MDEzMTYwMTYsIm5iZiI6MTYwMTIyOTYxNiwianRpIjoiNEFuQUhnSTYwZll5dmgwUyIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.mca9_hHFeaaIZ-CNXiTDk9iHk419hC7jmtRf9r1RF7U"
    }
}
```

Error response:
```
{
    "message": "Unauthenticated."
}
```

* GET api/respond returns the current token basic informations
Headers
```
Authorization: Bearer TOKEN
Accept: application/json
```

Successful response:
```
{
    "status": "OK",
    "message": null,
    "data":{
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6NDAwMFwvYXBpXC9yZXNwb25kIiwiaWF0IjoxNjAxMjMwMDgwLCJleHAiOjE2MDEzMTY0ODAsIm5iZiI6MTYwMTIzMDA4MCwianRpIjoiS09hREI4aVZyMmQ2Sm1aVyIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.iZIJ-mVBdK5HbBPQjQVjHBBpVD7pJU9SSP-pl_b80g8",
        "token_type": "bearer",
        "expires_in": 86400
    }
}
```

Error response:
```
{
    "message": "Unauthenticated."
}
```


#Wishlist

One wishlist is linked to the user. A user can have any number of wishlists each of them has a title

* GET wishlist






## Command line

To export the wishlists simply run this command

```
artisan wishlist:export
```

Expected result (depending on database data):
```
1,"User 1 wishlist",1
2,"User 2 wishlist",1
```

The format used is CSV with:

user_id,wishlist title,number of products in the wishlist

## Usage

## Contributing

## License
[MIT](https://choosealicense.com/licenses/mit/)