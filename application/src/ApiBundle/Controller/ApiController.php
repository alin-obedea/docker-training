<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Post;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ApiController extends FOSRestController
{
    /**
     * @Route("/api/posts")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findBy(['author' => $this->getUser()], ['publishedAt' => 'DESC'], ['limit' => 10]);

        return $this->render('api/blog/index.html.twig', ['posts' => $posts]);
    }

    /**
     *
     * @Route("/api/posts/{page}", requirements={"page": "[1-9]\d*"})
     * @param $page
     * @return
     */
    public function getAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findLatest($page);

        return $this->render('api/blog/index.html.twig', ['posts' => $posts]);
    }

    /**
     *
     * @Route("/api/post/{slug}")
     * @param $slug
     * @return object
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findOneBy($slug);

        return $this->render('api/blog/index.html.twig', ['posts' => $posts]);
    }
}
