<?php
if (!extension_loaded('curl'))
{
    trigger_error('cURL extension not installed', E_USER_ERROR);
}
class DhruFusion
{
  public static function action($options, $action, $arr = array())
  {
  	$xmlData = new DOMDocument();
      if (is_string($action))
      {
          if (is_array($arr))
          {
              if (count($arr))
              {
                  $request = $xmlData->createElement("PARAMETERS");
                  $xmlData->appendChild($request);
                  foreach ($arr as $key => $val)
                  {
                      $key = strtoupper($key);
                      $request->appendChild($xmlData->createElement($key, $val));
                  }
              }
              $posted = array(
                  'username' => $options['username'],
                  'apiaccesskey' => $options['api_key'],
                  'action' => $action,
                  'requestformat' => $options['format'],
                  'parameters' => $xmlData->saveHTML());
              $crul = curl_init();
              curl_setopt($crul, CURLOPT_HEADER, false);
              curl_setopt($crul, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
              //curl_setopt($crul, CURLOPT_FOLLOWLOCATION, true);
              curl_setopt($crul, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($crul, CURLOPT_URL, 'http://'.$options['site'].'/api/index.php');
              curl_setopt($crul, CURLOPT_POST, true);
              curl_setopt($crul, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($crul, CURLOPT_POSTFIELDS, $posted);
              $response = curl_exec($crul);
              if (curl_errno($crul) != CURLE_OK)
              {
                  echo curl_error($crul);
                  curl_close($crul);
              }
              else
              {
                  curl_close($crul);
                  // $response = XMLtoARRAY(trim($response));
                  return (json_decode($response, true));
              }
          }
      }
      return false;
  }
}