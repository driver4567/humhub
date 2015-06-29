<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\components;

/**
 * Description of ActiveRecord
 *
 * @author luke
 */
class ActiveRecord extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {

        if ($this->isNewRecord) {
            if ($this->hasAttribute('created_at') && $this->created_at == "") {
                $this->created_at = new \yii\db\Expression('NOW()');
            }
            if ($this->hasAttribute('created_by') && $this->created_by == "") {
                $this->created_by = \Yii::$app->user->id;
            }
        }

        if ($this->hasAttribute('updated_at') && $this->updated_at != "") {
            $this->updated_at = new \yii\db\Expression('NOW()');
        }
        if ($this->hasAttribute('updated_by') && $this->updated_by != "") {
            $this->updated_at = new \yii\db\Expression('NOW()');
        }

        return parent::beforeValidate();
    }

    /**
     * Returns a unique id for this record/model
     *
     * @return String Unique Id of this record
     */
    public function getUniqueId()
    {
        return str_replace('\\', '', get_class($this)) . "_" . $this->primaryKey;
    }

}
