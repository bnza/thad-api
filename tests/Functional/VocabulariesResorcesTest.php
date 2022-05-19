<?php

namespace App\Tests\Functional;

class VocabulariesResorcesTest extends AuthApiTestCase
{
    protected function getBaseResourceIri(): string
    {
        return 'vocabulary';
    }

    public function vocabulariesProvider(): array
    {
        return [
            ['/vocabulary/su/preservation_states', 4],
            ['/vocabulary/su/su_types', 8],
        ];
    }

    /**
     * @dataProvider vocabulariesProvider
     */
    public function testGetVocabulariesCollection(string $url, int $count): void
    {
        $response = $this->getClient()->request(
            'GET',
            "/api$url"
        );
        $content = json_decode($response->getContent(), true);
        $this->assertEquals($count, $content['hydra:totalItems']);
    }
}
