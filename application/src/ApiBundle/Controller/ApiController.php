<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ApiController extends Controller
{
    /**
     * @Route("/api/posts")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findBy(['author' => $this->getUser()], ['publishedAt' => 'DESC'], ['limit' => '10']);

        return $posts;
    }

    /**
     *
     * @Route("/posts/{page}", requirements={"page": "[1-9]\d*"})
     * @Method("GET")
     * @Cache(smaxage="10")
     * @param $page
     * @return
     */
    public function getAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findLatest($page);

        return $posts;
    }

    /**
     *
     * @Route("/post/{slug}", requirements={"page": "[1-9]\d*"})
     * @Method("GET")
     * @param $slug
     * @return object
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findOneBy($slug);

        return $posts;
    }
}
