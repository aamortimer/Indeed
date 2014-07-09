<?php

use Aamortimer\Indeed\Indeed;

class IndeedTest extends PHPUnit_Framework_TestCase {
  /**
   * @expectedException InvalidArgumentException
   */
  public function testSearchPublisherException()
  {
     $indeed = new Indeed;
     $indeed->search(array('q'=>'Web Developer'));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testSearchQueryException()
  {
    $indeed = new Indeed;
    $indeed->search(array('publisher'=>'12345'));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testDetailsJobKeyException()
  {
    $indeed = new Indeed;
    $indeed->details(array('publisher'=>'12345'));
  }


}
