<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

namespace gearsoftware\comment\widgets;

use gearsoftware\comment\models\search\CommentSearch;
use gearsoftware\comments\models\Comment;
use gearsoftware\models\User;
use gearsoftware\widgets\DashboardWidget;
use Yii;

class RecentComments extends DashboardWidget
{

    /**
     * Most recent comments limit
     */
    public $recentLimit = 5;
    
    public $layout = 'layout';
    public $commentTemplate = 'comment';

    public function run()
    {
        $recentComments = Comment::find()
                ->active()
                ->orderBy(['created_at' => SORT_DESC])
                ->limit($this->recentLimit)
                ->all();

        return $this->render($this->layout, [
            'recentComments' => $recentComments,
            'commentTemplate' => $this->commentTemplate,
        ]);
    }

}
