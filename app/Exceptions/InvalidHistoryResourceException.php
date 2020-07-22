<?php
namespace App\Exceptions;

class InvalidHistoryResourceException extends \Exception
{
    protected $message = 'Invalid history resource specified.';
}
