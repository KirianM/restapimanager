# Rest API Manager
A little library to interact with any Rest API.

## Installation

```
composer require kirianmurgadella/restapimanager
```

## How to use it

### Initialize ApiManager

#### API without authentication

Create a new instance of ApiManager using its factory.

```
$apiManager = ApiManagerFactory::create('https://api-url.com');
```



#### API with authentication

**This package works with: [JSON Web Token](https://es.wikipedia.org/wiki/JSON_Web_Token) and [HTTP Basic Authentication](https://en.wikipedia.org/wiki/Basic_access_authentication)**

##### Create a new instance for your authentication using its factory
###### With JWT

```
$credentials = [
    'email' => 'myemail@domain.com',
    'password' => 'mypassword'
];
$apiLoginUrl = 'https://api-url.com/login';
$apiTokenRequestUrl = 'https://api-url.com/request-token';
$auth = Auth\AuthFactory::create('jwt', $credentials, $apiLoginUrl, $apiTokenRequestUrl);
```

###### With BA

```
$credentials = [
    'username' => 'myusername',
    'password' => 'mypassword'
];
$auth = Auth\AuthFactory::create('basic', $credentials);
```

##### Create a new instance of ApiManager using its factory

```
$apiManager = ApiManagerFactory::create('https://api-url.com', $auth);
```

### Use ApiManager

```
    $apiManager->get('api/get/endpoint', ['custom headers']);
    $apiManager->post('api/post/endpoint', ['request data'], ['custom headers']);
    $apiManager->put('api/put/endpoint', ['request data'], ['custom headers']);
    $apiManager->request('custom method', 'api/custom/endpoint', ['request data'], ['custom headers']);
```

### Response
Every response will have the same structure
```
[
    'status' => 'success/error',
    'statusCode => 'XXX',
    'data' => [],
    'errors' => [
        [...],
        [...],
        [...]
    ]
]
```
* **status**: Contains success if everything goes well or **error** if something failed.
* **statusCode**: Will be the HTTP Status from the cURL request.
* **data**: It has the response of the request. **Here is whatever you asked for**.
* **errors**: You want it empty, but at least it will tell you what failed.

## Changelog

**1.3.0**

* Added Http Basic Authentication

**1.2.0**

* Fixed ApiManagerFactory namespace.
* Fixed ApiManagerFactory uses.

**1.1.0**

* Added DELETE method.

**1.0.0**

* Basic API interaction (GET, POST, PUT).
* Implemented [JSON Web Token](https://es.wikipedia.org/wiki/JSON_Web_Token) authentication.
