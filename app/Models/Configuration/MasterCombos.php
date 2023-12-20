<?php

namespace App\Models\Configuration;

use Illuminate\Database\Eloquent\Model;

class MasterCombos extends Model
{
    protected $table = 'master_combos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'parent_id',
        'code',
        'name',
        'description',
        'is_father',
        'status',
        'orden'
    ];

    public function parent()
    {
        return $this->belongsTo(MasterCombos::class, 'parent_id');
    }

    public static function getChildrens($names)
    {
        $names = explode(',', $names);

        $responses = MasterCombos::whereIn('parent_id', function ($query) use ($names) {
            $query->select('id')
                ->from('master_combos')
                ->whereIn('code', $names);
        })
            ->where('status', true)
            ->orderBy('orden', 'asc')
            ->get()
            ->groupBy("parent_id");


        $comboResponses = [];
        foreach ($responses as $index => $value) {
            $parent = MasterCombos::find($index)->code;
            $comboResponses[$parent] = $value->toArray();
        }

        return $comboResponses;
    }
}
