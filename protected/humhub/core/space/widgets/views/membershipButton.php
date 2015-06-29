<?php

use humhub\core\space\models\Membership;
use yii\helpers\Html;

if ($membership === null) {
    if ($space->canJoin()) {
        if ($space->join_policy == Space::JOIN_POLICY_APPLICATION) {
            echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Request membership'), $space->createUrl('/space/space/requestMembershipForm'), array('class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#globalModal'));
        } else {
            echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Become member'), $space->createUrl('/space/space/requestMembership'), array('class' => 'btn btn-primary'));
        }
    }
} elseif ($membership->status == Membership::STATUS_INVITED) {
    echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Accept Invite'), $space->createUrl('/space/space/inviteAccept'), array('class' => 'btn btn-primary'));
    echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Deny Invite'), $space->createUrl('/space/space/revokeMembership'), array('class' => 'btn btn-primary'));
} elseif ($membership->status == Membership::STATUS_APPLICANT) {
    echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Cancel pending membership application'), $space->createUrl('/space/space/revokeMembership'), array('class' => 'btn btn-primary'));
} else {
    if (!$space->isSpaceOwner()) {
        echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', "Cancel membership"), $space->createUrl('//space/space/revokeMembership'), array('class' => 'btn btn-danger'));
    }
}