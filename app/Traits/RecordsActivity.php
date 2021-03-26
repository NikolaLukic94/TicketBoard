<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

trait RecordsActivity
{
    public $oldAttributes = [];

    public static function bootRecordsActivity()
    {
        foreach (static::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function($model) {
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }
    }

    protected function activityDescription($description)
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    protected static function recordableEvents()
    {
        // If $recordableEvents exist in the model, override defaults
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }

        return ['created', 'updated', 'deleted'];
    }

    public function recordActivity($description)
    {
        $modelLowercase = substr($description, strrpos($description, '_') + 1);

        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'user_id' => Auth::user() ? Auth::id() : null,
            'url' => isset(config('application.urls')[$modelLowercase])
                ? config('application.urls')[$modelLowercase]
                : null
        ]);
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => array_diff($this->oldAttributes, $this->getAttributes()),
                'after' => $this->getChanges()
            ];
        }
    }
}
