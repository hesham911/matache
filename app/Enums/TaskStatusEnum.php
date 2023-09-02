<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case Undone     = 'undone';
    case Done       = 'done';
    case Archive    = 'archive';
}
