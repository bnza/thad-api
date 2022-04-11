<?php

namespace App\Tests\Functional;

class VocabulariesResorcesTest extends AuthApiTestCase
{
    public function vocabulariesProvider(): array
    {
        return [
            ['/vocabulary/su/preservation_states', 4],
            ['/vocabulary/su/types', 8],
        ];
    }

    /**
     * @group wip
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
