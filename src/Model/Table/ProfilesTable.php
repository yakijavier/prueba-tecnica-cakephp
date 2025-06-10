<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Profiles Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Profile newEmptyEntity()
 * @method \App\Model\Entity\Profile newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Profile> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Profile get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Profile findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Profile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Profile> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Profile|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Profile saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Profile>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Profile>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Profile>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Profile> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Profile>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Profile>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Profile>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Profile> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProfilesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('profiles');
        $this->setDisplayField('role');
        $this->setPrimaryKey('id');

        $this->hasMany('Users', [
            'foreignKey' => 'profile_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('role')
            ->maxLength('role', 50)
            ->requirePresence('role', 'create')
            ->notEmptyString('role');

        return $validator;
    }
}
