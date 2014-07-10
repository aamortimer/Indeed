Indeed API
===============================================================================

PHP interface to Indeed job search API.

How to Install
-------------------------------------------------------------------------------

Using Composer (Recommended)

Install the aamortimer/Indeed package:

```shell
$ composer require "aamortimer/Indeed"
```

Example of Usage
-------------------------------------------------------------------------------

    <?php

    use aamortimer\Indeed\Indeed;
    $indeed = new Indeed(12345);

    // Pass a basic search query
    $response = $indeed->search('web developer');
    print_r($response);

    // Pass in more options to the search
    $response = $indeed->search(array(
        'q' => 'web developer',
        'l' => 'London',
        'start' => 10,
        'limit' => 3
    ));
    print_r($response);

    // Look up job details
    $response = $indeed->details(array(
      'jobkeys' => $jobkey
    ));


Releases
-------------------------------------------------------------------------------

### 1.0.0 (2014-07-09)

Initial release

* Query the job search and job details API
