<?php

namespace App\Traits;

trait ResolvesDepartmentConnection
{
    protected function resolveConnection(string $type): string|null
    {
        return match ($type) {
           'Technical Issues' => 'technical_connection',
            'Account & Billing' => 'account_connection',
            'Product & Service' => 'product_connection',
            'General Inquiry' => 'general_connection',
            'Feedback & Suggestions' => 'feedback_connection',
            default => null,
        };
    }

    protected function shortKeyConnection(string $type): string|null
    {
        return match ($type) {
            'technical' => 'technical_connection',
            'account' => 'account_connection',
            'product' => 'product_connection',
            'general' => 'general_connection',
            'feedback' => 'feedback_connection',
            default => null,
        };
    }
}
