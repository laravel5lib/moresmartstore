<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SetCategoryActive extends Action
{
    use InteractsWithQueue, Queueable;

    public function uriKey()
    {
        return 'Set Category Active';
    }
    public function name()
    {
        return __('Set Category Active');
    }
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            if ($model->active) {
                return Action::danger('รายการนี้เผยแพร่แล้ว');
            } else {
                $model->active = 1;
            }

            $model->save();
        }
        return Action::message('ดำเนินการสมบูรณ์');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
