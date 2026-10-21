<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case Waiting = 'waiting';
    case Payed = 'payed';
    case Error = 'error';
}
