<?php 
declare(strict_types=1);
/**
 * Helper functions for the application.
 *
 * @package App\Helpers
 */
function formatDate(string $date): string
{
    return \Carbon\Carbon::parse($date)->format('Y-m-d H:i:s');
}