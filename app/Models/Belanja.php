<?php

namespace App\Models;

class Belanja
{

    protected $app;
    
    public function __construct($app) 
    {
        $this->app = $app;
    }

    public function add($d)
    {
        $stmt = $this->app->db->prepare("INSERT INTO `shop`(id_user, id_product, id_status, jumlah, total) VALUES(?,?,?,?,?)");
        $stmt->bind_param('iiiii', $d['user'], $d['produk'], $d['status'], $d['jumlah'], $d['total']);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->affected_rows == 1) return $stmt->insert_id;
        else return null;
    }

    public function get()
    {
        $res = $this->app->db->query("SELECT s.*, u.nama, st.nama_status, p.nama_produk, p.harga FROM shop s 
                                    JOIN user u ON u.id_user = s.id_user
                                    JOIN status st ON st.id_status = s.id_status
                                    JOIN produk p ON p.id_product = s.id_product
                                    ORDER BY id_shop ASC");
        $container = [];
        if(!empty($res)){
            while($c = $res->fetch_assoc()) {
                $container[] = $c;
            }
        }
        return $container;
    }
    
    public function getInId($ids)
    {
        if(!is_array($ids) || empty($ids)) return null;

        $res = $this->app->db->query("SELECT * FROM shop WHERE id IN('". implode("','", $ids) ."')");
        $container = [];
        while($c = $res->fetch_assoc()) {
            $container[] = $c;
        }
        return $container;
    }

    public function getById($id)
    {
        $res = $this->app->db->query("SELECT * FROM shop WHERE id_shop = {$id}");
        return $res->fetch_assoc();
    }

    public function update($d)
    {
        $stmt = $this->app->db->prepare("UPDATE shop SET id_user = ?, id_product = ?, id_status = ?, jumlah = ?, total = ? WHERE id_shop = ?");
        $stmt->bind_param('iiiiii', $d['user'], $d['produk'], $d['status'], $d['jumlah'], $d['total'], $d['id_shop']);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->affected_rows == 1) return true;
        else return false;
    }

    public function delete($id)
    {
               
            $stmt = $this->app->db->prepare("DELETE FROM `shop` WHERE id_shop = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->store_result();
    
            if($stmt->affected_rows == 1) return true;
            else {
                return false;
            }
        
    }

    public function getUser()
    {
        $res = $this->app->db->query("SELECT * FROM user ORDER BY id_user ASC");
        $container = [];
        if(!empty($res)){
            while($c = $res->fetch_assoc()) {
                $container[] = $c;
            }
        }
        return $container;
    }

    public function getStat()
    {
        $res = $this->app->db->query("SELECT * FROM status ORDER BY id_status ASC");
        $container = [];
        if(!empty($res)){
            while($c = $res->fetch_assoc()) {
                $container[] = $c;
            }
        }
        return $container;
    }

    public function getProd()
    {
        $res = $this->app->db->query("SELECT * FROM produk ORDER BY id_product ASC");
        $container = [];
        if(!empty($res)){
            while($c = $res->fetch_assoc()) {
                $container[] = $c;
            }
        }
        return $container;
    }

    public function getProdid($id)
    {
        $stmt = $this->app->db->prepare("SELECT harga FROM produk WHERE id_product = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resqs = $stmt->get_result();
        $qsc = $resqs->fetch_assoc();
        return $qsc;
    }


    //----------------------------------------------------------RESTFULAPI--------------------------------------------------------------------//
    public function getApi($id=null, $nama=null)
    {
        //tanpa id dan nama produk
        if (empty($id) AND empty($nama)) {
            $res = $this->app->db->query("SELECT * FROM produk");
            $container = [];
            if(!empty($res)){
                while($c = $res->fetch_assoc()) {
                    $container[] = $c;
                }
            }
        //dengan id
        }elseif (!empty($id)) {
            $res = $this->app->db->prepare("SELECT * FROM produk WHERE id_product = ?");
            $res->bind_param('i', $id);
            $res->execute();
            $resqs = $res->get_result();
            $container = $resqs->fetch_assoc();
        //dengan nama produk
        }elseif (!empty($nama)) {
            $param = "%".$nama."%";
            $res = $this->app->db->prepare("SELECT * FROM produk WHERE nama_produk LIKE ?");
            $res->bind_param('s', $param);
            $res->execute();
            $resqs = $res->get_result();

            $container = [];
            while($c = $resqs->fetch_assoc()) {
                $container[] = $c;
            }
        }

        return $container;
    }

    public function insertApi($nama=null, $harga=null)
    {
        if(empty($nama) || empty($harga)){
            return 'mohon isikan Nama Produk dan atau Harga Produk';
        }else{
            $stmt = $this->app->db->prepare("INSERT INTO `produk` (nama_produk, harga) VALUES(?,?)");
            $stmt->bind_param('si', $nama, $harga);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->affected_rows > 0) return 1;
            else return 2;
        }
    }

    public function updateApi($id=null, $nama=null, $harga=null)
    {
        if(empty($id)){
            return 'Mohon id diisi terlebih dahulu';
        }else{
            $res = $this->app->db->prepare("SELECT * FROM produk WHERE id_product = ?");
            $res->bind_param('i', $id);
            $res->execute();
            $resqs = $res->get_result();
            $container = $resqs->fetch_assoc();

            if(empty($container)){
                return 'Maaf id salah';
            }else{
                empty($nama) ? $nama_produk = $container['nama_produk'] : $nama_produk = $nama;
                empty($harga) ? $harga_produk = $container['harga'] : $harga_produk = $harga;

                $stmt = $this->app->db->prepare("UPDATE produk SET nama_produk=?, harga=? WHERE id_product = ?");
                $stmt->bind_param('sii', $nama_produk, $harga_produk, $id);
                $stmt->execute();
                $stmt->store_result();

                if($stmt->affected_rows > 0) return 1;
                else return 2;
            }
        }
    }

    public function deleteApi($id=null)
    {
        if(empty($id)){
            return 'Mohon id diisi terlebih dahulu';
        }else{
            $res = $this->app->db->prepare("SELECT * FROM produk WHERE id_product = ?");
            $res->bind_param('i', $id);
            $res->execute();
            $resqs = $res->get_result();
            $container = $resqs->fetch_assoc();

            if(empty($container)){
                return 'Maaf id salah';
            }else{
                $stmt = $this->app->db->prepare("DELETE FROM `produk` WHERE id_product = ?");
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->store_result();
                
                if($stmt->affected_rows > 0) return 1;
                else {
                    return 2;
                }
            }
        }
    }
    
}