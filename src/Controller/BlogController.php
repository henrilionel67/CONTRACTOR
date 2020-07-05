<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $post = $this->getDoctrine()
            ->getRepository('App\Entity\Post')
            ->findAll();
            return $this->render(
                'blog/index.html.twig',
                array('post' => $post)
            );
    }
}
