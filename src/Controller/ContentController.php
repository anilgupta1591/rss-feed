<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Content;
class ContentController extends AbstractController
{
    /**
     * @Route("/", name="content")
     */
    public function index(Request $request)
    {
        $content = $this->getDoctrine()->getRepository(Content::class)->findBy(
            array(),
            array('id' => 'DESC')
        );


        return $this->render('content/index.html.twig', [
            'content' => $content,
        ]);
    }
}