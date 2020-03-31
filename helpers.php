<?php

if(!function_exists('notfound')) {
    function notfound() {
        header("HTTP/1.0 404 Not Found");
        require 'pages/error/404.php';
        exit();
    }
}

if(!function_exists('unauthorized')) {
    function unauthorized() {
        header("HTTP/1.0 401 Unauthorized");
        require 'pages/error/401.php';
        exit();
    }
}

if(!function_exists('internalerror')) {
    function internalerror() {
        header("HTTP/1.0 500 Internal Server Error");
        require 'pages/error/500.php';
        exit();
    }
}

if(!function_exists('fileExtension')) {
    function fileExtension($filename) {
        $e = explode('.', $filename);
        return array_pop($e);
    }
}

if(!function_exists('url')) {
    function url($url='') {
        global $app;
        if($_SERVER['HTTP_HOST'] == 'localhost'){
            $base = $app->config->base_url;
        }elseif($_SERVER['HTTP_HOST'] == 'rz'){
            $base = $app->config->base_url_client;
        }elseif($_SERVER['HTTP_HOST'] == '192.168.55.228'){
            $base = $app->config->base_url_client_ip;
        }
        return $base . '/' . $url;
    }
}

if(!function_exists('redirect_url')) {
    function redirect_url() {
        return urlencode($_SERVER['REQUEST_URI']);
    }
}

if(!function_exists('randomAlphanum')) {
    function randomAlphanum($digit = 12) {
        $alpha = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        $number = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $chars = array_merge($alpha, $number);

        $strings = '';
        for($i=0;$i<$digit;$i++) {
            $strings .= $chars[rand(0, count($chars)-1)];
        }
        return $strings;
    }
}

if(!function_exists('dateResolver')) {
    function dateResolver($string) {
        $date = date_create_from_format('d-m-Y', $string);
        if(!$date) $date = date_create_from_format('Y-m-d', $string);
        if(!$date) return null;
        return $date->format('d-m-Y');
    }
    function dateCreate($string) {
        $date = date_create_from_format('Y-m-d', $string);
        if(!$date) $date = date_create_from_format('d-m-Y', $string);
        if(!$date) return null;
        return $date->format('Y-m-d');
    }
    function dateFormat($string) {
        $date_ex = explode('-', $string);
        $date = $date_ex[0]." ".namaBulan($date_ex[1])." ".$date_ex[2];
        return $date;
    }
}

if(!function_exists('queryString')) {
    function queryString($array) {
        $query = '';
        foreach($array as $key => $value) {
            $query .=
                (empty($query) ? '' : '&') .
                $key . '=' .
                $value;
        }
        return $query;
    }
}

if(!function_exists('namaBulan')) {
    function namaBulan($int) {
        $int = (int) $int;
        if(($int > 0 && $int < 13) == false) return null;
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return $bulan[$int-1];
    }
}

if(!function_exists('namaBulanSingkat')) {
    function namaBulanSingkat($int) {
        $int = (int) $int;
        if(($int > 0 && $int < 13) == false) return null;
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sept', 'Okt', 'Nov', 'Des'];
        return $bulan[$int-1];
    }
}

if(!function_exists('namaBulanRomawi')) {
    function namaBulanRomawi($int) {
        $int = (int) $int;
        if(($int > 0 && $int < 13) == false) return null;
        $bulan = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        return $bulan[$int-1];
    }
}

if(!function_exists('namaHari')) {
    function namaHari($int) {
        $int = (int) $int;
        if(($int > 0 && $int < 8) == false) return null;
        $bulan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return $bulan[$int-1];
    }
}

function pembulatan($uang)
{
    $uang = round($uang);
    //echo $uang;
    $puluhan = substr($uang, -2);
    if($puluhan<50)
    $akhir = $uang - $puluhan;
    else
    $akhir = $uang + (100-$puluhan);

    return $akhir;
}

function indo_number($number) {
    //$number = 100* round(($number/100.0));
    return 'Rp. ' . number_format($number, 0, ',', '.');
}

function trim_number($number) {
    $ind_char = array('Rp', '.', ',00');
    $int_char = array('', '', '');
    $trim_number = str_replace($ind_char, $int_char, $number);
    return $trim_number;
}

function format_decimal($number) {
    return number_format($number, 0, '.', '');
}

function indo_number_without_rp($number) {
    if (!empty($number)) {
        return number_format($number, 0, ',', '.');
    } else {
        return 0;
    }
}

function idr($number) {
    if (!empty($number)) {
        return number_format($number, 0, ',', '.');
    } else {
        return 0;
    }
}

function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = penyebut($nilai - 10). " Belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
        }     
        return $temp;
    }
 
    function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim(penyebut($nilai))." Rupiah";
        } else {
            $hasil = trim(penyebut($nilai))." Rupiah";
        }           
        return $hasil;
    }
