<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [''];

    protected $dates = ['created_at'];

    public function status()
    {
        return $this->belongsTo(LeadStatus::class, 'statusId');
    }

    public function probability()
    {
        return $this->belongsTo(LeadProbability::class, 'probabilityId');
    }

    public function type()
    {
        return $this->belongsTo(LeadType::class, 'typeId');
    }

    public function channel()
    {
        return $this->belongsTo(LeadChannel::class, 'channelId');
    }

    public function media()
    {
        return $this->belongsTo(LeadMedia::class, 'mediaId');
    }

    public function source()
    {
        return $this->belongsTo(LeadSource::class, 'sourceId');
    }

    public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class, 'branchOfficeId');
    }

    public static function generateNumber()
    {
        $number = 'LD';
        $number .= now()->timestamp;
        $number .= rand(11, 99);

        return $number;
    }

}
