<?php

use AppBundle\Entity\Post;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApiControllerTest extends PHPUnit\Framework\TestCase {

    private $post = null;

    public function setUp()
    {
        $this->post = new Post();
    }

    public function tearDown()
    {
        unset($this->post);
    }

    public function testGetPosts()
    {
        $client = new Client([
            'base_uri' => 'http://172.21.0.1/'
        ]);
        $content = $client->request('GET', 'api/posts');

        $response = json_decode($content->getBody()->getContents());
        $this->assertCount(
            Post::NUM_ITEMS,
            $response,
            "The posts number is not what is expected"
        );
    }

//    public function testGetPostsPerPage()
//    {
//        $client = new Client([
//            'base_uri' => 'http://172.21.0.1/'
//        ]);
//
//        $content = $client->request('GET', 'api/posts/{page}');
//        $response = json_decode($content->getBody()->getContents());
//
//
//    }

    public function postData() {
        $results = array(
            array(
                'author_id' => 1,
                'title' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit',
                'slug' => 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit',
                'summary' => 'Urna nisl sollicitudin id varius orci quam id turpis. Pellentesque vitae velit ex. Ubi est barbatus nix. Lorem ipsum dolor sit amet consectetur adipiscing elit. Pellentesque et sapien pulvinar consectetur. Mauris dapibus risus quis suscipit vulputate.',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor
                              incididunt ut labore et **dolore magna aliqua**: Duis aute irure dolor in
                              reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                              deserunt mollit anim id est laborum.
                              
                                * Ut enim ad minim veniam
                                * Quis nostrud exercitation *ullamco laboris*
                                * Nisi ut aliquip ex ea commodo consequat
                              
                              Praesent id fermentum lorem. Ut est lorem, fringilla at accumsan nec, euismod at
                              nunc. Aenean mattis sollicitudin mattis. Nullam pulvinar vestibulum bibendum.
                              Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                              himenaeos. Fusce nulla purus, gravida ac interdum ut, blandit eget ex. Duis a
                              luctus dolor.
                              
                              Integer auctor massa maximus nulla scelerisque accumsan. *Aliquam ac malesuada*
                              ex. Pellentesque tortor magna, vulputate eu vulputate ut, venenatis ac lectus.
                              Praesent ut lacinia sem. Mauris a lectus eget felis mollis feugiat. Quisque
                              efficitur, mi ut semper pulvinar, urna urna blandit massa, eget tincidunt augue
                              nulla vitae est.
                              
                              Ut posuere aliquet tincidunt. Aliquam erat volutpat. **Class aptent taciti**
                              sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi
                              arcu orci, gravida eget aliquam eu, suscipit et ante. Morbi vulputate metus vel
                              ipsum finibus, ut dapibus massa feugiat. Vestibulum vel lobortis libero. Sed
                              tincidunt tellus et viverra scelerisque. Pellentesque tincidunt cursus felis.
                              Sed in egestas erat.

                              Aliquam pulvinar interdum massa, vel ullamcorper ante consectetur eu. Vestibulum
                              lacinia ac enim vel placerat. Integer pulvinar magna nec dui malesuada, nec
                              congue nisl dictum. Donec mollis nisl tortor, at congue erat consequat a. Nam
                              tempus elit porta, blandit elit vel, viverra lorem. Sed sit amet tellus
                              tincidunt, faucibus nisl in, aliquet libero.',
                'publishedAt' => '2017-02-17 20:58:47',
            )
        );

        return $results;
    }

//    /**
//     *
//     */
//    public function testGetPostBySlug()
//    {
//        $mock = $this->getMock('Post');
//
//        $result = '';
//
//        $mock->expects($this->any())->method('postData')->will($this->returnValue($result));
//
//        $client = new Client([
//            'base_uri' => 'http://172.21.0.1/'
//        ]);
//
//        $post = $client->request('GET', 'api/post/{'. $this->postData['slug']. '}');
//
//        $content = json_decode($post->getBody()->getContents());
//
//        print_r($content);
//
//        $this->assertSame(
//            $content['slug'],
//            $this->postData['slug']);
//
//
//    }
}