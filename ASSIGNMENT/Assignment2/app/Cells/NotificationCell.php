<?php

namespace App\Cells;

class NotificationCell
{
    public function show(array $params): string
    {
        return "<div class=\"alert alert-{$params['type']}\">{$params['message']} {$params['icon']}</div>";
    }
}

?>