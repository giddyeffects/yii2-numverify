<?php

namespace giddyeffects\numverify;

use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;

/*
 * Numverify.com API Wrapper Component for Yii2
 * 
 * @package giddyeffects\numverify
 * @author Gideon Nyaga
 * 2017-03-29
 * @see https://github.com/giddyeffects/yii2-numverify
 * 
*/
class Numverify extends Component
{
    /**
     * @var string Your Numverify API Key
     */
    protected $access_key;
    
    /**
     * @var string Numverify baseUrl. For paid customers you can use HTTPS 
     */
    protected $baseUrl = "http://apilayer.net/api/validate";
    
    public function __construct($config = [])
    {
        foreach ($config as $param => $value) {
            $this->$param = $value;
        }
    }
    
    /**
     * Initializes the object.
     * This method is invoked at the end of the constructor after the object is initialized with the
     * given configuration.
     * @return void
     * @throws InvalidConfigException
     */
    public function init() {
        if (empty($this->access_key)) {
            throw new InvalidConfigException('"access_key" cannot be empty.');
        }
    }
    
    /**
     * Verify a number
     * 
     * @param string $num Number to be validated
     * @param array $options Optional Parameters. i.e. country_code or format
     * @return json Validation Results
     */
    public function verify($num, $options = []) {
        $ch = curl_init();  
        $url = $this->baseUrl."?access_key=$this->access_key&number=$num";
        if(isset($options['country_code']) && strlen($options['country_code']) === 2 )$url .= "&country_code=".$options['country_code'];
        else { throw new InvalidParamException("You have specified an invalid Country Code [Required format: 2-letter Code] [Example: KE]");}
        if(isset($options['format']))$url .= "&format=".$options['format'];
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $json=curl_exec($ch);
        $response = json_decode($json);
        curl_close($ch);
        return $response;
    }
}