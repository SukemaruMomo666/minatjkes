<?php

namespace App\Enums;

enum UserRole: string
{
    case Mahasiswa = 'mahasiswa';
    case Dosen = 'dosen';
    case Admin = 'admin';
}