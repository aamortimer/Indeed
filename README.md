Indeed API
===============================================================================

PHP interface to Indeed job search API.

Example of Usage
-------------------------------------------------------------------------------

    <?php

    use Aamortimer\Indeed\Indeed;
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
