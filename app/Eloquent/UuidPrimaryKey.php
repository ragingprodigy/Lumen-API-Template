<?php
declare(strict_types=1);

/**
 * Created by: dapo <o.omonayajo@gmail.com>
 * Created on: 29/01/2019, 4:56 PM
 */

namespace DevProject\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Trait UuidPrimaryKey
 *
 * @package DevProject\Eloquent
 */
trait UuidPrimaryKey
{
    /**
     * This function is used internally by Eloquent models to test if the model has auto increment value
     * @return bool Always false
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * This function overwrites the default boot static method of Eloquent models. It will hook
     * the creation event with a simple closure to insert the UUID
     */
    public static function bootUuidPrimaryKey()
    {
        static::creating(
            function (Model $model) {
                $model->incrementing = false;
                if ($model->getKey() === null) {
                    $model->setAttribute($model->getKeyName(), Uuid::uuid4()->toString());
                }
            }
        );
    }
}
