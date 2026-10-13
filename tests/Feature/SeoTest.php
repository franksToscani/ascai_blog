<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use RefreshDatabase;

    private function makePost(array $attributes = []): Post
    {
        return Post::create($attributes + [
            'title' => 'Festa della comunità',
            'content' => 'Una grande festa con musica e cibo tipico camerunense per tutta la comunità di Bologna.',
            'status' => 'published',
        ]);
    }

    private function makeEvent(array $attributes = []): Event
    {
        return Event::create($attributes + [
            'title' => 'Serata culturale',
            'description' => 'Musica dal vivo e racconti dal Camerun.',
            'starts_at' => now()->addDays(10)->setTime(20, 0),
            'location' => 'Casa delle Associazioni, Bologna',
            'is_public' => true,
            'status' => 'published',
        ]);
    }

    /** Estrae e decodifica il primo blocco JSON-LD della pagina */
    private function jsonLd(string $html): array
    {
        preg_match('#<script type="application/ld\+json">\s*(.+?)\s*</script>#s', $html, $match);
        $this->assertNotEmpty($match, 'Nessun blocco JSON-LD trovato');

        return json_decode($match[1], true, flags: JSON_THROW_ON_ERROR);
    }

    public function test_sitemap_lists_only_published_public_content(): void
    {
        $published = $this->makePost(['title' => 'News pubblicata']);
        $draft = $this->makePost(['title' => 'Bozza segreta', 'status' => 'draft']);
        $publicEvent = $this->makeEvent(['title' => 'Evento pubblico']);
        $privateEvent = $this->makeEvent(['title' => 'Evento privato', 'is_public' => false]);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee(route('posts.show', $published), false)
            ->assertSee(route('eventi.show', $publicEvent), false)
            ->assertSee(route('chi-siamo'), false)
            ->assertDontSee(route('posts.show', $draft), false)
            ->assertDontSee(route('eventi.show', $privateEvent), false);

        $this->assertNotFalse(simplexml_load_string($this->get('/sitemap.xml')->getContent()), 'Sitemap XML non valida');
    }

    public function test_robots_blocks_everything_outside_production(): void
    {
        $this->get('/robots.txt')->assertOk()->assertSee('Disallow: /');
    }

    public function test_robots_points_to_sitemap_in_production(): void
    {
        $this->app['env'] = 'production';

        // In produzione ForceHttps reindirizza HTTP → HTTPS, quindi la richiesta è in HTTPS
        $this->get('https://localhost/robots.txt')
            ->assertOk()
            ->assertSee('Disallow: /admin')
            ->assertSee('Sitemap: https://localhost/sitemap.xml');
    }

    public function test_news_page_has_its_own_description_image_and_article_data(): void
    {
        $post = $this->makePost(['cover_image' => 'posts/covers/copertina.jpg']);

        $response = $this->get(route('posts.show', $post))->assertOk();

        $response->assertSee('<meta name="description" content="Una grande festa con musica', false)
            ->assertSee('<meta property="og:type" content="article">', false)
            ->assertSee('<meta property="og:image" content="' . asset('storage/posts/covers/copertina.jpg') . '">', false)
            ->assertSee('<link rel="canonical" href="' . route('posts.show', $post) . '">', false);

        $data = $this->jsonLd($response->getContent());
        $this->assertSame('NewsArticle', $data['@type']);
        $this->assertSame('Festa della comunità', $data['headline']);
    }

    public function test_event_page_has_structured_event_data(): void
    {
        $event = $this->makeEvent();

        $response = $this->get(route('eventi.show', $event))->assertOk();

        $data = $this->jsonLd($response->getContent());
        $this->assertSame('Event', $data['@type']);
        $this->assertSame('Serata culturale', $data['name']);
        $this->assertSame($event->starts_at->toIso8601String(), $data['startDate']);
        $this->assertSame('Casa delle Associazioni, Bologna', $data['location']['name']);

        // La descrizione per Google/WhatsApp parte da data e luogo
        $response->assertSee('content="' . $event->starts_at->translatedFormat('j F Y') . ', Casa delle Associazioni', false);
    }

    public function test_pages_without_image_use_the_default_preview(): void
    {
        $this->get(route('chi-siamo'))
            ->assertOk()
            ->assertSee('<meta property="og:image" content="' . asset('images/og-default.jpg') . '">', false)
            ->assertSee('<title>Chi siamo - ASCAI Bologna</title>', false);
    }

    public function test_titles_with_quotes_or_script_tags_cannot_break_the_page(): void
    {
        $post = $this->makePost([
            'title' => 'Evento "speciale" </script><script>alert(1)</script>',
            'content' => 'Testo con "virgolette" e <b>tag</b> che non devono rompere i meta tag della pagina.',
        ]);

        $html = $this->get(route('posts.show', $post))->assertOk()->getContent();

        $this->assertStringNotContainsString('<script>alert(1)</script>', $html);
        $this->assertSame('Evento "speciale" </script><script>alert(1)</script>', $this->jsonLd($html)['headline']);
    }

    public function test_home_has_organization_data(): void
    {
        $data = $this->jsonLd($this->get('/')->assertOk()->getContent());

        $this->assertSame('NGO', $data['@type']);
        $this->assertContains('https://www.tiktok.com/@ascai2021', $data['sameAs']);
    }
}
