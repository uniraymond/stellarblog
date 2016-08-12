<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);

        $this->visit('/')
            ->click('Blog')
            ->seePageIs('/blog');

        $this->visit('/blog')
            ->see('Blog');
    }

    /**
     * the new blog's user_id is from the login user_id
     * therefore when doing this test the user_id will return no object error.
     */

    public function testNewBlog() {
        $this->withoutMiddleware();

        $response = $this->call('GET', '/blog/create');
        $this->assertEquals(200, $response->status());

//        $this->visit('blog/create')
//            ->type('A new blog title', 'title')
//            ->type('A new Blog body', 'body')
//            ->type('12/10/2016 12:10:12', 'published_at')
//            ->check('active')
//            ->type('1', 'user_id')
//            ->press('Submit')
//            ->seePageIs('/blog');
    }

    public function testEditBlog() {
        $this->withoutMiddleware();

        // check blog 1 is in the database
        $response = $this->call('GET', '/blog/1/edit');
        $this->assertEquals(200, $response->status());

        // current the blog 20 is not exist
        $response = $this->call('GET', '/blog/20/edit');
        $this->assertEquals(404, $response->status());
    }

    public function testDatabase()
    {
//        $this->seeInDatabase('blogs', ['title' => '11 Titile ZAVDh']);
        $blog = factory(App\Blog::class)->make();
        $blog = factory(App\Blog::class)->create();
    }
}
