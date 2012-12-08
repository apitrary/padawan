Padawan
=======

Padawan is a CLI Client build during Hackaton@Apitrary.

Disclaimer
----------

Apitrary is an awesome backend as a service provider from Berlin, Germany. You should
check them out at http://apitrary.com

Requirements
------------

php5-cli >= 5.3
php5-curl

```
$ apt-get install php5-cli php5-curl
```

Installation
------------

Just clone the repo and you are almost ready to go.
You just need to put your api endpoint as a const:

```php
\Apitrary\Command\AbstractCommand::API_ENDPOINT
```

Change to `bin` directory give the current user right
to execute the apitrary file. Execute:

```
$ ./apitrary
```

And you should see following output:

```
Apitrary CLI Client

show    List available entities
display Display results from entity
insert  Insert data into entity
remove  Remove an object from the entity
```

You can request a help for each command by executing:

```
$ ./apitrary [COMMAND] help
```
TODO
----

* Replace the Http Client with a more robust solution
* Provide a better way of validating the command options

tl;dr
-----

Thanks to apitrary team for organizing the hackaton!