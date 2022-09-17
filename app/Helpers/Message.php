<?php

namespace App\Helpers;

class Message
{
    // user
    const REGISTER = array("header" => "Berhasil daftar", "body" => "Behasil Daftar Member Aplikasi GBA");
    const EMAILVERIFIED = array("header" => "email terverifikasi", "body" => "Verifikasi E-mail Berhasil");
    const JOINGROUP = array("header" => "Berhasil Daftar", "body" => "Behasil Daftar GROUP GBA Selanjutnya tunggu konfirmasi dari admin");


    // admin
    const REQUESTJOINGROUP = array("header" => "Berhasil daftar", "body" => "Behasil Daftar Member Aplikasi GBA");
}
