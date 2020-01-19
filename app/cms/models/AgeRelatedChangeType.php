<?php

namespace cms\models;

use cms\models\traits\RuEnActiveRecordTrait;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "age".
 *
 */
class AgeRelatedChangeType extends \common\models\AgeRelatedChangeType
{
    use RuEnActiveRecordTrait;

    public $name;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

}
