<?php

namespace App\Enums;

use PhpParser\Node\Expr\Cast\String_;

enum Position : string
{
    case Member = 'عضو مجلس بلدي';
    case Mayor = 'رئيس البلدية';
    case DeputyMayor = 'نائب رئيس البلدية';
}
