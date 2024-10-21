<?php

namespace App\Enums;

enum BookStatus: int
{
    case Tersedia = 1;
    case Dipinjam = 2;
    case Hilang = 0;
}
