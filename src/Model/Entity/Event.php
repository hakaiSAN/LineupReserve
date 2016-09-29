<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $date
 * @property string $location
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $store_id
 * @property string $name
 *
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\Procession[] $processions
 */
class Event extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
