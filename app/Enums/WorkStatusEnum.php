<?php

namespace App\Enums;

enum WorkStatusEnum: int {

    # Запланировано
    case Planned   = 1;

    # В работе
    case InWork    = 2;

    # Выполнено
    case Completed = 3;
}
