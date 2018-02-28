<?php defined('BASEPATH') OR exit('No direct script access allowed');


function mensagens(){
    if(isset($_SESSION['danger']) && $_SESSION['danger'] != ''){
        $html = '<div class="alert alert-danger">'.
                $_SESSION['danger'].'</div>';
    }if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
        $html = '<div class="alert alert-success">'.
                $_SESSION['success'].'</div>'; 
    }

    return isset($html) ? $html : '';
}