<?php namespace Aamortimer\Indeed;

/**
 * Indeed API Class
 *
 * PHP class to interact with the Indeed API
 * https://ads.indeed.com/jobroll/
 *
 * @package  indeed-class
 * @license  http://opensource.org/licenses/MIT
 * @version  1.0.0
 */
class Indeed {
  /**
   * Publisher ID for affiliates
   *
   * @var  integer
   */
  private $publisher;


   /**
   * Base URL
   *
   * @var  string
   */
  private $base_url = 'http://api.indeed.com/ads/apisearch';

  /**
   * Accepted parameters that the feed will accept; see a list of descriptions at
   * https://ads.indeed.com/jobroll/xmlfeed
   *
   * @var  array
   */
  private $accepted_params = array(
    'publisher', 'v', 'format', 'callback', 'q', 'l', 'sort', 'radius', 'st', 'jt', 'start',
    'limit', 'fromage', 'highlight', 'filter', 'latlong', 'co', 'chnl', 'jobkeys'
  );

  /**
   * Default parameters for the feed
   *
   * @var  array
   */
  private $default_params = array(
    'co' => 'gb', // default country United Kingdom
    'format' => 'json', // default format json
    'v' => '2' // use version 2 of the API
  );

  private function getRemoteAdd()
  {
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
  }

  /**
   * Accepted countries that the feed will accept; see a list of descriptions at
   * https://ads.indeed.com/jobroll/xmlfeed
   *
   * @var  array
   */
  private $accepted_countries = array(
    'us', 'ar', 'au', 'at', 'bh', 'be', 'br', 'ca', 'cl', 'cn', 'co', 'ca', 'dk', 'fi',
    'de', 'gr', 'hk', 'hu', 'in', 'id', 'ie', 'il', 'it', 'jp', 'kr', 'kw', 'lu', 'my',
    'mx', 'nl', 'nz', 'no', 'om', 'pk', 'pe', 'ph', 'pl', 'pt', 'qa', 'ro', 'ru', 'sa',
    'sg', 'za', 'es', 'se', 'ch', 'tw', 'tr', 'ae', 'gb', 've'
  );


  /**
   * Default constructor; sets the publisher ID and the format
   *
   * @param  integer  $publisher   Publisher ID from Indeed (Optional)
   * @param  string   $format      Format of data (Optional)
   */
  public function __construct($publisher = null, $format = '')
  {
    // set the publisher
    $this->publisher = (int)$publisher;

    // Check that argument is either `json` or `xml`
    if (in_array(strtolower($format), array('json', 'xml'))) {
      $this->format = strtolower($format);
    }
  }

  /**
   * Search for jobs
   *
   * @param  mixed  $params   Array of parameters or search query
   */
  public function search($params)
  {
    $uri = $this->buildURI($params);
  }

  /**
   * Get job details
   *
   * @param  mixed  $params   Array of parameters or search query
   */
  public function details($params)
  {
    if (!is_array($params) || !key_exists('jobkeys', $params)) {
      throw new \InvalidArgumentException('JobKeys parameter either invalid or empty.');
    }

    $uri = $this->buildURI($params);
    echo $uri;
  }

  /**
  * Builds the URI based on the passed parameters and default
  *
  * @param   array   $params  Array of parameters or search query
  *
  * @return  string
  */
  private function buildURI($params)
  {
    // check if params are an array or just the search query
    $params = (is_array($params)) ? $params : array('q'=>$params);

    // add user ip
    if (isset($_SERVER['REMOTE_ADDR'])) {
      $params['userip'] = urlencode($_SERVER['REMOTE_ADDR']);
    }

    // add the user agent
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
      $params['useragent'] = urlencode($_SERVER['HTTP_USER_AGENT']);
    }

    // join in the default params
    $params = array_merge($this->default_params, $params);

    // check that a publiser has been set
    if (!is_array($params) || !key_exists('publisher', $params)) {
      throw new \InvalidArgumentException('Publiseher parameter either invalid or empty.');
    }

    // build the query
    $uri = '';
    foreach ($params as $key => $value) {
      if(in_array($key, $this->accepted_params)) {
        $sep = ($uri === '') ? '?' : '&';
        $uri .= $sep . $key . '=' . urlencode($value);
      }
    }

    return $this->base_url.$uri;
  }
}
