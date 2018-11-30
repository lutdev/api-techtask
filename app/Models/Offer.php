<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Offer
 * @package App\Models
 * @property int id
 * @property int source_id
 * @property string offer_id
 * @property string|null country
 * @property string|null currency
 * @property string|null advertiser
 * @property string|null os
 * @property string|null status
 * @property object|null payload
 */
class Offer extends Model
{
    protected $table = 'offers';
    protected $guarded = ['id'];
}