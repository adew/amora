<?php

require_once APPPATH . 'third_party/tcpdf/tcpdf.php';
class PDF extends TCPDF{
    function __construct($orientation = 'L', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false) {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }
    


}
