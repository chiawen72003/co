<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = '';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The inverse of fillable is guarded, 
	 * and serves as a "black-list" instead of a "white-list".
	 *
	 * @var array
	 */
	// protected $guarded = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}
