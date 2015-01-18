Codeigniter-REST-Enabler
========================
*A skinny library for enabling REST usage in Codeigniter*

This is a small library that has the capability to act as both REST server and a client. It simply makes use of the way codeigniter routes requests to enable REST verb usage and make your application RESTful. It does not do all of the things that other REST servers does, but, it does what most applications need. My application needed only these but please feel free to fork and adapt it or extend it :)

Tested with Codeigniter 2.1.3.

Setup
-----
1. Copy application/library/rest_enabler.php to the same path in your project. There is no need to make changes to this file.
2. Copy application/config/api.ini to the same path in your project. If your application does not use authentication, no need to edit this file.

Usage
-----
REST Server: To enable your application to act as a REST server check out that functions in application/controllers/example_server.php. When done right, you can use $this->uri->uri_to_assoc() and other codeigniter functions in your controller logic to allow your app to serve APIs like...
```
GET http://yourdomain.com/user/12345
POST http://yourdomain.com/user/45678/tom
```

REST Client: You can use the enabler to make requests to similar APIs. Check out application/controllers/example_client.php.

Improvements
------------
Compared to many REST libraries for Codeigniter this is very very skinny, but also lacks many functionalities. Please point out any bugs/broken code or give feedback/suggestion by opening an issue or sending me a mail.


Cheers.