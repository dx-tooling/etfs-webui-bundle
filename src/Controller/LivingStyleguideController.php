<?php

namespace EnterpriseToolingForSymfony\WebuiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LivingStyleguideController extends AbstractController
{
    #[Route(
        path   : '/living-styleguide',
        name   : 'webui.living_styleguide.show',
        methods: [Request::METHOD_GET]
    )]
    public function showLivingStyleguideAction(): Response
    {
        return $this->render('@Webui/living_styleguide.html.twig');
    }
}
