<?php

namespace App;

class Application
{
    public $config;
    
    public $db;
    
    public $input;

    public $sess;

    public function __construct($c)
    {
        $this->config = $c;
        
        $dbconfig = $this->config->db;
        $this->db = (new \App\Database($dbconfig->host, $dbconfig->user, $dbconfig->pass, $dbconfig->dbname))->connection();
        
        $this->input = new \App\Input($this->db, $this);
    }
    
    public function addError($classifier, $message)
    {
        $this->addMsg($classifier, $message, 'error');
    }
    
    public function addMessage($classifier, $message)
    {
        $this->addMsg($classifier, $message, 'message');
    }

    public function addMsg($classifier, $message, $state)
    {
        if(!isset($_SESSION['msgbag'])) $_SESSION['msgbag'] = '{}';
        $msgbag = json_decode($_SESSION['msgbag']);
        
        if(!isset($msgbag->{$classifier})) $msgbag->{$classifier} = (object) [];
        if(!isset($msgbag->{$classifier}->{$state})) $msgbag->{$classifier}->{$state} = [];

        $msgbag->{$classifier}->{$state}[] = $message;
        $_SESSION['msgbag'] = json_encode($msgbag);
    }

    public function getMsg($classifier, $state)
    {
        if(!isset($_SESSION['msgbag'])) $_SESSION['msgbag'] = '{}';
        $msgbag = json_decode($_SESSION['msgbag']);
        $msgs = [];

        if(isset($msgbag->{$classifier}->{$state})) {
            $msgs = $msgbag->{$classifier}->{$state};
            unset($msgbag->{$classifier}->{$state});
            $_SESSION['msgbag'] = json_encode($msgbag);
        }

        return $msgs;
    }
    
    public function errors($classifier)
    {
        return $this->getMsg($classifier, 'error');
    }
    
    public function messages($classifier)
    {
        return $this->getMsg($classifier, 'message');
    }

    public function hasError($classifier)
    {
        if(!isset($_SESSION['msgbag'])) $_SESSION['msgbag'] = '{}';
        $msgbag = json_decode($_SESSION['msgbag']);

        if(isset($msgbag->{$classifier}->error) && !empty($msgbag->{$classifier}->error)) return true;
        else return false;
    }

    public function hasMessage($classifier)
    {
        if(!isset($_SESSION['msgbag'])) $_SESSION['msgbag'] = '{}';
        $msgbag = json_decode($_SESSION['msgbag']);

        if(isset($msgbag->{$classifier}->message) && !empty($msgbag->{$classifier}->message)) return true;
        else return false;
    }

    public function imageUpload($thefile, $newname, $category)
    {
        return $this->fileUpload($thefile, $newname, "/img/c/{$category}");
    }

    public function fileValidation($name, $validator = [])
    {
        if(is_array($validator)) {
            $ext = fileExtension($_FILES[$name]['name']);
            return in_array($ext, $validator);
        }
        elseif(is_numeric($validator)) {
            return $_FILES[$name]['size'] <= $validator;
        }
        else return null;
    }

    public function docUpload($thefile, $newname = null, $category = null)
    {
        $folder = "/doc";
        if($newname == null) {
            global $pubdir;
            $path = $pubdir . $folder;
            
            $ext = fileExtension($_FILES[$thefile]['name']);
            
            $prefix = $category == null ? '' : "{$category}-";
            $rand = $category == null ? 12 : 8;
    
            do {
                $filename = $prefix . randomAlphanum($rand);
                $filepath = $path . $filename . '.' . $ext;
                $exists = file_exists($filepath);
            }
            while($exists);
        }
        else $filename = $newname;

        return $this->fileUpload($thefile, $filename, $folder);
    }

    public function fileUpload($thefile, $newname, $imgfolder)
    {
        $file = $_FILES[$thefile];

        if($file['error'] != 0 || $file['size'] == 0) {
            $this->addError('fileupload', 'File Upload Gagal in Models/Application');
            return false;
        }

        global $pubdir;
        $path = $pubdir . $imgfolder;

        if(!file_exists($path)) mkdir($path);

        $ext = fileExtension($file['name']);

        $newname = $newname.date('dmyhis') . '.' . $ext;
        if(move_uploaded_file($file['tmp_name'], $path . '/' . $newname)){
            return (object) [
                'fullname' => $imgfolder . '/' . $newname,
                'filename' => $newname,
                'path' => $imgfolder,
                '__toString' => function() {
                    return $imgfolder . '/' . $newname;
                }
            ];
        }else{ return false; }
    }

    public function dateFromString($string, $format = 'd-m-Y')
    {
        $date = date_create_from_format($format, $string);
        
        if(!$date) $date = date_create_from_format('d/m/Y', $string);
        
        if(!$date) $date = date_create_from_format('Y-m-d', $string);

        return $date->format('Y-m-d');
    }
}