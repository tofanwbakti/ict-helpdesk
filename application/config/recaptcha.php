<?php
defined('BASEPATH') or exit('No direct script access allowed');

// To use reCAPTCHA, you need to sign up for an API key pair for your site.
// link: http://www.google.com/recaptcha/admin
// $config['recaptcha_site_key'] = '6LdAKVEoAAAAANOSlZEUXv_XLBI97pBaWFDh2i80'; // ONLINE
$config['recaptcha_site_key'] = '6LeDC1UoAAAAAOMmeEWZ_MR5DYu7jiLJ1bxIwVJ9';
// $config['recaptcha_secret_key'] = '6LdAKVEoAAAAAE9DL4Q6ZVZm2duLQNghqZqUr0c_'; // ONLINE
$config['recaptcha_secret_key'] = '6LeDC1UoAAAAAPJlzsZlYVedPo_kepuXC3OO_qMH';

// reCAPTCHA supported 40+ languages listed here:
// https://developers.google.com/recaptcha/docs/language
$config['recaptcha_lang'] = 'en';

/* End of file recaptcha.php */
/* Location: ./application/config/recaptcha.php */
