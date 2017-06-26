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
    public function indexAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findBy(['author' => $this->getUser()], ['publishedAt' => 'DESC'], ['limit' => '10']);

        return $posts;
    }

    /**
     *
     * @Route("/page/{page}", requirements={"page": "[1-9]\d*"})
     * @Method("GET")
     * @Cache(smaxage="10")
     *
     */
    public function getAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findLatest($page);

        return $posts;
    }
}
