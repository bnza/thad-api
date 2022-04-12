<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
abstract class AbstractExportController extends AbstractController
{
    public function __invoke($data)
    {
        return $data;
    }
}
