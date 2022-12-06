<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// To use reCAPTCHA, you need to sign up for an API key pair for your site.
// link: http://www.google.com/recaptcha/admin
//$config['recaptcha_site_key'] = '6LcLR8ccAAAAAMhOYFFg3q2qdmcUWm8VUtljAQsr';
//$config['recaptcha_secret_key'] = '6LcLR8ccAAAAABbEPCt-EDi5hIvAKxprgStrRGE6';

//Domain Localhost
$config['recaptcha_site_key']   = '6LdQPg4cAAAAANN2nwe-0jCk070uuaDbX9gRZ7VY'; // domain localhost
$config['recaptcha_secret_key'] = '6LdQPg4cAAAAAFGomc1JIjN0_w51SByQ7LbBQ1Bv'; // domain localhost

// reCAPTCHA supported 40+ languages listed here:
// https://developers.google.com/recaptcha/docs/language
$config['recaptcha_lang'] = 'en';

/* End of file recaptcha.php */
/* Location: ./application/config/recaptcha.php */
