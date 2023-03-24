<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HP_Converter {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function convert($phone_number)
    {
        // Menghilangkan karakter selain angka dan plus (+)
        // $phone_number = preg_replace('/[^0-9+]/', '', $phone_number);
        $phone_number = preg_replace('/[^0-9]/', '', $phone_number);
        
        // Mengubah angka awalan "0" menjadi "+62"
        if (substr($phone_number, 0, 1) == '0') {
            // $phone_number = '+62' . substr($phone_number, 1);
            $phone_number = '62' . substr($phone_number, 1);
        }
        
        // Menghilangkan karakter "dash" (-) pada nomor telepon
        $phone_number = str_replace('-', '', $phone_number);
        
        // Mengonversi huruf "e" atau "E" menjadi ""
        $phone_number = str_ireplace('e', '', $phone_number);

        return $phone_number;
    }
}