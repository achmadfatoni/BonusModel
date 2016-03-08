<?php namespace Klsandbox\BonusModel\Models;

use Illuminate\Database\Eloquent\Model;
use Klsandbox\SiteModel\SiteExtensions;

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

    use SiteExtensions;

    protected $fillable = ['notes',  'bonus_id'];

	//

}
