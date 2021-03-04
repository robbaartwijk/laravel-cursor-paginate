<?php

namespace Bitsnbolts\CursorPaginate\Tests;

class RequestTest extends TestCase
{
    /** @test */
    public function it_will_return_the_next_cursor_url_in_the_response()
    {
        (new TestModelFactory)->count(11)->create();
        $response = $this->get('/');

        $response->assertJsonFragment(['next' => 'http://localhost?cursor=W251bGwsMTBd']);
    }

    /** @test */
    public function it_will_discover_the_current_cursor_url()
    {
        (new TestModelFactory)->count(11)->create();
        $response = $this->get('/?cursor=WyIyMDIxLTAzLTAzVDAwOjAwOjAwLjAwMDAwMFoiLDJd');

        $response->assertJsonFragment(['self' => 'http://localhost?cursor=WyIyMDIxLTAzLTAzVDAwOjAwOjAwLjAwMDAwMFoiLDJd']);
    }

    /** @test */
    public function it_will_discover_the_page_number_parameter()
    {
        $response = $this->get('/?page[number]=2');

        $response->assertJsonFragment(['current_page' => 2]);
    }

    /** @test */
    public function it_will_use_the_default_page_size()
    {
        $response = $this->get('/');

        $response->assertJsonFragment(['per_page' => 30]);
    }

    /** @test */
    public function it_will_use_the_configured_page_size_parameter()
    {
        config(['json-api-paginate.size_parameter' => 'modified_size']);

        $response = $this->get('/?page[modified_size]=2');

        $response->assertJsonFragment(['per_page' => 2]);
    }

    /** @test */
    public function it_will_use_the_configured_page_number_parameter()
    {
        config(['json-api-paginate.number_parameter' => 'modified_number']);

        $response = $this->get('/?page[modified_number]=2');

        $response->assertJsonFragment(['current_page' => 2]);
    }
}
