<?php

namespace App\Controller;
use App\Entity\Post;
use App\Form\BlogPostType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
 
    public function createPost(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(BlogPostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $post = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirect('/view-post/' . $post->getId());

        }

        return $this->render(
            'admin/update-post.html.twig',
            array('form' => $form->createView())
        );

    }

    public function viewPost($id)
    {
        $post = $this->getDoctrine()
            ->getRepository('App\Entity\Post')
            ->find($id);

        if (!$post) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }

        return $this->render(
            'admin/view-post.html.twig',
            array('post' => $post)
        );
    }

    public function showPost()
    {
        $post = $this->getDoctrine()
            ->getRepository('App\Entity\Post')
            ->findAll();

        return $this->render(
            'admin/show-post.html.twig',
            array('post' => $post)
        );
    }

    public function deletePost($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('App\Entity\Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }

        $em->remove($post);
        $em->flush();

        return $this->redirect('/show-post');
    }

    public function updatePost(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('App\Entity\Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }

        $form = $this->createForm(BlogPostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $article = $form->getData();
            $em->flush();
            return $this->redirect('/view-post/' . $id);
        }

        return $this->render(
            'admin/update-post.html.twig',
            array('form' => $form->createView())
        );
    }
}