<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class MongoTeste extends Eloquent
{
	use SoftDeletes;
	protected $connection = 'mongodb';
	protected $collection = 'mongoteste';

	protected $guarded = [
		'_id'
	];
}
