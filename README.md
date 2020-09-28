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

# Api descripion

The api uses this base address:

```
http://localhost:3000/api/[endpoint]
```


# Authentication

* POST api/login email/password based authentication 

Query parameters:
```
email: fake@email.com
password: 12345678
```

## Success authentication response:
```
{
    "status": "OK",
    "message": null,
    "data":{
       "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6NDAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYwMTIyODIyOCwiZXhwIjoxNjAxMzE0NjI4LCJuYmYiOjE2MDEyMjgyMjgsImp0aSI6Ik5VdUdiVHgxbkI2VU1PYUciLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.cnw_mNWkbIl4IpeffS4nkiFsG-TxbMTQj-BckTfbBA8"
    }
}
```

## Wrong authentication response:
```
{
    "status": "ERROR",
    "message": "Wrong email or password",
    "data": null
}
```

* GET api/me gets the logged user data

## Headers
```
Authorization: Bearer TOKEN
Accept: application/json
```

## Success response:
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

## Error response:
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

## Successful response:
```
{
    "status": "OK",
    "message": null,
    "data": null
}
```

## Error response:
```
{
    "message": "Unauthenticated."
}
```

* GET api/refresh refresh the jwt token (default token expire 24h)
## Headers
```
Authorization: Bearer TOKEN
Accept: application/json
```

## Successful response:
```
{
    "status": "OK",
    "message": null,
    "data":{
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6NDAwMFwvYXBpXC9yZWZyZXNoIiwiaWF0IjoxNjAxMjI5NTA5LCJleHAiOjE2MDEzMTYwMTYsIm5iZiI6MTYwMTIyOTYxNiwianRpIjoiNEFuQUhnSTYwZll5dmgwUyIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.mca9_hHFeaaIZ-CNXiTDk9iHk419hC7jmtRf9r1RF7U"
    }
}
```

## Error response:
```
{
    "message": "Unauthenticated."
}
```

* GET api/respond returns the current token basic informations
## Headers
```
Authorization: Bearer TOKEN
Accept: application/json
```

## Successful response:
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

## Error response:
```
{
    "message": "Unauthenticated."
}
```

# Wishlist

One wishlist is linked to the user. A user can have any number of wishlists each of them has a title

* GET wishlist wishlists of the autenticated user
## Headers
```
Authorization: Bearer TOKEN
Accept: application/json
```

## Successful response:
```
{
    "status": "OK",
    "message": null,
    "data":[
        {"id": 1, "name": "User 1 wishlist", "user_id": 1, "created_at": "2020-09-27T14:01:29.000000Z", "updated_at": "2020-09-27T14:01:29.000000Z"},
        {"id": 3, "name": "F7zft72EOnr28VNz", "user_id": 1, "created_at": "2020-09-27T17:19:02.000000Z","updated_at": "2020-09-27T14:01:29.000000Z"},
        ]
}
```

## Error response:
```
{
    "message": "Unauthenticated."
}
```

* GET api/wishlist/id reads a wishlist (of the logged user) by it's id
## Headers
```
Authorization: Bearer TOKEN
Accept: application/json
```

## Successful response:
```
{
    "status": "OK",
    "message": null,
    "data":{
        "wishlist":{"id": 1, "name": "User 1 wishlist", "user_id": 1, "created_at": "2020-09-27T14:01:29.000000Z",…},
        "items":[
            {"id": 1, "wishlist_id": 1, "product_id": 1, "created_at": "2020-09-27T14:01:29.000000Z",…}
    ]
}

```

## Error response:
```
{
    "message": "Unauthenticated."
}

```
## Error response if the wishlist is not owned by the logged user
```
{
    "status": "ERROR",
    "message": "This item is not public",
    "data": null
}
```

* POST api/wishlist create a new wishlist linked to the logged user with a title 
## Headers
```
Authorization: Bearer TOKEN
Accept: application/json
Content-Type: application/json
```

## Body:
```
{
  "name":"my wishlist"
}
```

## Successful response:
```
{
    "status": "OK",
    "message": null,
    "data":{
        "user_id": 1,
        "name": "my wishlist",
        "updated_at": "2020-09-28T11:02:14.000000Z",
        "created_at": "2020-09-28T11:02:14.000000Z",
        "id": 70
    }
}
```

## Error response:
```
{
    "message": "Unauthenticated."
}
```

* PATCH api/wishlist/id update a wishlist  
## Headers
```
Authorization: Bearer TOKEN
Accept: application/json
Content-Type: application/json
```

## Body:
```
{
   "name":"Questo è un nuovo nome"
}
```

## Successful response:
```
{
    "status": "OK",
    "message": null,
    "data":{
        "id": 1,
        "name": "Questo è un nuovo nome",
        "user_id": 1,
        "created_at": "2020-09-27T14:01:29.000000Z",
        "updated_at": "2020-09-28T11:08:19.000000Z"
    }
}
```

## Error response if the wishlist is not owned by the logged user
```
{
    "status": "ERROR",
    "message": "This item is not public",
    "data": null
}
```

## Error response:
```
{
    "message": "Unauthenticated."
}
```

* DELETE api/wishlist/id destroys the specified wishlist by id

## Headers
```
Authorization: Bearer TOKEN
Accept: application/json
Content-Type: application/json
```
Successful response:
```
{
    "status": "OK",
    "message": null,
    "data": null
}
```

## Error response if the wishlist is not owned by the logged user
```
{
    "status": "ERROR",
    "message": "This item is not public",
    "data": null
}
```

## Error response:
```
{
    "message": "Unauthenticated."
}
```

# Wishlist contents

The wishlist contents represent the products contained a a user's wishlist


* POST api/wishlist_contents add a product to a wishlist 
## Headers
```
Authorization: Bearer TOKEN
Accept: application/json
Content-Type: application/json
```

## Body:
```
{
  "wishlist_id":1,
  "product_id":1
}
```

## Successful response:
```
{
    "status": "OK",
    "message": null,
    "data":{
        "wishlist_id": 1,
        "product_id": 1,
        "updated_at": "2020-09-28T12:38:11.000000Z",
        "created_at": "2020-09-28T12:38:11.000000Z",
        "id": 63
    }
}
```

## Error response if the wishlist is not owned by the logged user
```
{
    "status": "ERROR",
    "message": "This item is not public",
    "data": null
}
```

## Error response:
```
{
    "message": "Unauthenticated."
}
```

* DELETE api/wishlist_contents/id destroys the specified wishlist content by id

## Headers
```
Authorization: Bearer TOKEN
Accept: application/json
Content-Type: application/json
```
Successful response:
```
{
    "status": "OK",
    "message": null,
    "data": null
}
```

## Error response if the wishlist is not owned by the logged user
```
{
    "status": "ERROR",
    "message": "This item is not public",
    "data": null
}
```

## Error response:
```
{
    "message": "Unauthenticated."
}
```


# Command line

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



# License
[MIT](https://choosealicense.com/licenses/mit/)