<?php

namespace App;

enum UserPenjemputanEnum: string
{
    case Menunggu = 'menunggu';
    case Diproses = 'diproses';
    case Dibatalkan = 'dibatalkan';
    case Selesai = 'selesai';
}
