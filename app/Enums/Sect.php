<?php

namespace App\Enums;

enum Sect: string
{
    case Minorities = 'أقليات';
    case ArmenianOrthodox = 'أرمن ارثوذكس';
    case ArmenianCatholic = 'أرمن كاثوليك';
    case Evangelical = 'انجيلي';
    case GreekOrthodox = 'روم ارثوذكس';
    case GreekCatholic = 'روم كاثوليك';
    case Maronite = 'ماروني';
    case Alawite = 'علوي';
    case Druze = 'درزي';
    case Shia = 'شيعي';
    case Sunni = 'سني';
}
