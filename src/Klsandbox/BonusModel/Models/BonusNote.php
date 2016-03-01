<?php namespace Klsandbox\BonusModel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Klsandbox\BonusModel\Models\BonusNote
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $notes
 * @property integer $bonus_id
 */
class BonusNote extends Model {

    protected $fillable = ['notes',  'bonus_id'];

	//

}
