<?php

namespace App;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        static::created(function ($model) {
            $model->activity()->create([
                'user_id'   => auth()->id() ?? 1,
                'type'      => 'created_'.strtolower(class_basename($model)),
                'after'     => $model
            ]);
        });

        static::updating(function ($model) {
            $changed = array_except($model->getDirty(), 'remember_token');

            if (! empty($changed)) {
                $before = json_encode(array_intersect_key($model->fresh()->toArray(), $changed));
                $after  = json_encode($changed);

                $model->activity()->create([
                    'user_id'   => auth()->id() ?? 1,
                    'type'      => 'updated_'.strtolower(class_basename($model)),
                    'before'    => $before,
                    'after'     => $after
                ]);
            }
        });

        static::deleted(function ($model) {
            $model->activity()->create([
                'user_id'   => auth()->id() ?? 1,
                'type'      => 'deleted_'.strtolower(class_basename($model)),
                'before'    => $model,
                'after'     => ''
            ]);
        });
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
