<?php

namespace App\Traits;

use App\Models\Activity;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        foreach (static::getModelEventsToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity(
                    $model->formatActivityDescription($event)
                );
            });
        }
    }

    public function recordActivity($description)
    {
        $this
            ->activitySubject()
            ->activity()
            ->create(compact('description'));
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function activityChanges()
    {
        return [
            'before' => array_diff($this->old, $this->getAttributes()),
            'after' => $this->getChanges()
        ];
    }

    protected function activitySubject()
    {
        return $this;
    }

    protected static function getModelEventsToRecord()
    {
//        if (isset(static::$modelEventsToRecord)) {
//            return static::$modelEventsToRecord;
//        }

        return ['created', 'updated', 'deleted'];
    }

    protected function formatActivityDescription($event)
    {
        return "{$event}_" . strtolower(class_basename($this));
    }
}
