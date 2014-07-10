<?php

use aamortimer\Indeed\Indeed;

class IndeedTest extends PHPUnit_Framework_TestCase {
  public function setUp()
  {
    $this->indeed = new Indeed;
    $this->q = 'Web Developer';
    $this->publisher = '444214432879792';
  }
  /**
   * @expectedException InvalidArgumentException
   */
  public function testSearchPublisherException()
  {
     $this->indeed->search(array('q'=>$this->q));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testSearchQueryException()
  {
    $this->indeed->search(array('publisher'=>$this->publisher));
  }

  public function testSearchResultsFormat()
  {
    $response = $this->indeed->search(array(
      'publisher'=>$this->publisher,
      'q'=>$this->q
    ));

    $this->assertTrue(is_object($response));
  }

  public function testDetails()
  {
    $response = $this->indeed->search(array(
      'publisher'=>$this->publisher,
      'q'=>$this->q
    ));

    $jobkey = $response->results[0]->jobkey;
    $response = $this->indeed->details(array(
      'publisher'=>$this->publisher,
      'jobkeys'=>$jobkey
    ));

    $this->assertTrue(is_object($response));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testDetailsJobKeyException()
  {
    $this->indeed->details(array('publisher'=>$this->publisher));
  }


}
