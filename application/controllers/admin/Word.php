<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;

class Word extends CI_Controller
{

    public function index()
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText('Hello World !');

        $writer = new Word2007($phpWord);

        $filename = 'simple';

        header('Content-Type: application/msword');
        header('Content-Disposition: attachment;filename="' . $filename . '.docx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
