<?php

namespace app\modules\CompanyA\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property integer $create_at
 * @property integer $updated_at
 * @property string $desc
 * @property string $address
 * @property integer $status
 */
class Company extends \app\models\Company
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }


}
