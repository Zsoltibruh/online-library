<?php

namespace App\Enums;

enum UserRole: string
{
    case Member = 'member';
    case Librarian = 'librarian';
}
