<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;

class CreateHistoryInput
{
    #[NotBlank]
    public int $first;

    #[NotBlank]
    public int $second;
}