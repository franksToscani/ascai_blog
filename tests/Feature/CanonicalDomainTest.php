<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CanonicalDomainTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app['env'] = 'production';
        config(['app.url' => 'https://ascai-bo.it']);
    }

    public function test_onrender_host_redirects_to_main_domain_keeping_path_and_query(): void
    {
        $this->get('https://ascai-blog.onrender.com/news?search=festa&page=2')
            ->assertStatus(301)
            ->assertRedirect('https://ascai-bo.it/news?search=festa&page=2');
    }

    public function test_main_domain_is_served_normally(): void
    {
        $this->get('https://ascai-bo.it/chi-siamo')->assertOk();
    }

    public function test_render_health_check_is_not_redirected(): void
    {
        $this->get('https://ascai-blog.onrender.com/up')->assertOk();
    }

    public function test_http_to_https_redirect_keeps_query_string(): void
    {
        $this->get('http://ascai-bo.it/news?search=festa')
            ->assertStatus(301)
            ->assertRedirect('https://ascai-bo.it/news?search=festa');
    }

    public function test_no_redirect_outside_production(): void
    {
        $this->app['env'] = 'local';

        $this->get('https://ascai-blog.onrender.com/chi-siamo')->assertOk();
    }
}
