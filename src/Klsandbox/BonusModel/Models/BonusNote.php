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
 * @property integer $site_id
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusNote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusNote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusNote whereNotes($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusNote whereBonusId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusNote whereSiteId($value)
 * @mixin \Eloquent
 */
class BonusNote extends Model {

    use SiteExtensions;

    protected $fillable = ['notes',  'bonus_id'];

	//

}
