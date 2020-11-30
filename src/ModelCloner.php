<?php

namespace EbereOnyechere\ModelCloner;

use Illuminate\Support\Facades\DB;

class ModelCloner {

    public function clone($model, $uniqueProperties = [], $table = '') {
         //copy attributes
        $new = $model->replicate();

        if (!empty($uniqueProperties)) {
            foreach ($uniqueProperties as $property) {
                if (is_numeric(substr($new[$property], -1, 1))) {

                    $canSave = false;
                    while(!$canSave) {
                        $new->$property++;

                        if (!DB::table($table)->where($property, $new->$property)->first()) {
                            $canSave = true;
                        }
                    }
                }
                else {
                    $canSave = false;
                    $new[$property] .= '-1';

                    if (!DB::table($table)->where($property, $new->$property)->first()) {
                        $canSave = true;
                    }

                    while(!$canSave) {

                        $new->$property++;

                        if (!DB::table($table)->where($property, $new->$property)->first()) {
                            $canSave = true;
                        }
                    }
                }
            }
        }

        //save model before you recreate relations (so it has an id)
        $new->push();

        //re-sync everything
        if ($model->relations) {

            foreach ($model->relations as $relationName => $values){
                $new->{$relationName}()->sync($values);
            }
        }

        return $new;
    }

}