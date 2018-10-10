<?php

namespace App;

trait RecordWhoCreatesAndUpdates
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id() ?: 1;
            $model->updated_by = auth()->id() ?: 1;
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }
}
