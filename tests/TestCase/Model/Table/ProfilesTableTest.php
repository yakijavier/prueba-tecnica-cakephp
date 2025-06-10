<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProfilesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProfilesTable Test Case
 */
class ProfilesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProfilesTable
     */
    protected $Profiles;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Profiles',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Profiles') ? [] : ['className' => ProfilesTable::class];
        $this->Profiles = $this->getTableLocator()->get('Profiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Profiles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProfilesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
