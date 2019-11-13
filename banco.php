<?php
    $banco = new mysqli("localhost", "root", "", "bancoteste");
    if ($banco->connect_errno){
        echo "Erro no banco de dados.";
        die();
    }