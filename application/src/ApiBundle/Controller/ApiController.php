<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Comment;
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
        $posts = $em->getRepository(Post::class)->findBy([], [], Post::NUM_ITEMS);

//        return $posts;
        return $this->render('api/blog/index.html.twig', ['posts' => $posts]);
    }

    /**
     *
     * @Route("/api/posts/{page}", requirements={"page": "[1-9]\d*"}, defaults={"page" = 1})
     * @param $page
     * @return object
     */
    public function getAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findLatest($page);

//        return $posts;
        return $this->render('api/blog/index.html.twig', ['posts' => $posts]);
    }

    /**
     *
     * @Route("/api/post/{slug}")
     * @param $slug
     * @return
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findBy(['slug' => $slug], [], 1);

//        return $posts;
        return $this->render('api/blog/index.html.twig', ['posts' => $posts]);
    }

    /**
     *
     * @Route("/api/posts/comment/{slug}")
     * @param $slug
     * @return object
     */
    public function showCommentAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->findOneBy(['slug' => $slug]);

        //return $post;
        return $this->render('api/blog/comment.html.twig', ['comments' => $post->getComments()]);
    }
}
