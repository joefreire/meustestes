<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensagem extends Model
{
	use SoftDeletes;

	protected $table = 'mensagens';
	protected $guarded = [
		'id'
	];
	public function remetente()
	{
		return $this->hasOne('App\Models\User','id','remetente_id');
	}

	public function destinatario()
	{
		return $this->hasOne('App\Models\User','id','destinatario_id');
	}

}
