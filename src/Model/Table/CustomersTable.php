<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;

/**
 * Customers Model
 *
 * @property \Cake\ORM\Association\HasMany $Orders
 * @property \Cake\ORM\Association\HasMany $Processions
 *
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('customers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Orders', [
            'foreignKey' => 'customer_id'
        ]);
        $this->hasMany('Processions', [
            'foreignKey' => 'customer_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }

    public function afterSave(\Cake\Event\Event $event, \Cake\Datasource\EntityInterface $entity, $options){
        $procession = TableRegistry::get('Processions')->newEntity();
        $req_data = $procession; //before validation 
        //debug($entity);
        //url制御
        $url = Router::url();
        $params = Router::parse($url);
        //debug($params);
        $id = $params['pass'][2];
        $req_data['event_id'] = $id; //urlの中に仕込まれてる
        $req_data['customer_id'] = $entity['id'];
        $procession = TableRegistry::get('Processions')->patchEntity($procession, $req_data);
//        debug($procession);
        if (TableRegistry::get('Processions')->save($procession)) {
//            $this->Flash->success(__('The procession has been saved.'));
        } else {
//            $this->Flash->error(__('The procession could not be saved. Please, try again.'));
        }
//        $this->set(compact('procession', 'customers', 'events'));
//        $this->set('_serialize', ['procession']);
    }

}
