<?php


namespace App\Http\Traits;


use App\Models\Activity;

trait RecordsActivity {

    protected static function bootRecordsActivity () {

        if (auth()->guest()) return;

        foreach (static::getActivitiesToRecord() as $event) {
            //  whenever an event happen, we want to save activity about it
            static::$event(function ($model) use ($event){
                $model->recordActivity($event);
            });
        }
    }

    protected static function getActivitiesToRecord () {
        //  return event array that we will listen to in model class
        //  by default - only created event
        return ['created'];
    }

    protected function recordActivity ($event) {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event),     // App\Foo\Thread -> Thread           $this for current instance of model
        ]);
    }

    public function activity () {
        return $this->morphMany('App\Models\Activity', 'subject');
    }

    protected function getActivityType ($event) {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return $event . '_' . $type;
    }
}