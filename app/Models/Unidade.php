<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Unidade extends Eloquent
{
	use SoftDeletes;
	protected $connection = 'mongodb';
	protected $collection = 'unidades';

	protected $guarded = [
		'_id',
	];
}
