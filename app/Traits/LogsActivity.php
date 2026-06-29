<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            static::log('created', $model);
        });

        static::updated(function ($model) {
            static::log('updated', $model);
        });

        static::deleted(function ($model) {
            static::log('deleted', $model);
        });
    }

    protected static function log(string $action, $model)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'subject_type' => get_class($model),
            'subject_id' => $model->id,
            'description' => $model->getActivityDescription($action),
            'ip_address' => Request::ip(),
        ]);
    }

    public function getActivityDescription(string $action): string
    {
        $modelName = class_basename($this);
        $identifier = $this->activityIdentifier();
        return match ($action) {
            'created' => "$modelName $identifier telah dibuat",
            'updated' => "$modelName $identifier telah diperbarui",
            'deleted' => "$modelName $identifier telah dihapus",
            default => "$modelName $identifier telah di-$action",
        };
    }

    public function activityIdentifier(): string
    {
        return $this->id ?? '';
    }
}
