<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

use yii\db\Migration;

class m150727_175300_add_comments_menu_links extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link}}', ['id' => 'comment', 'menu_id' => 'admin-menu', 'link' => '/comment/default/index', 'image' => 'demo-psi-speech-bubble-3', 'created_by' => 1, 'order' => 8]);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'comment', 'label' => 'Comments', 'language' => 'en-US']);
    }

    public function down()
    {
        $this->delete('{{%menu_link_lang}}', ['like', 'link_id', 'comment']);
        $this->delete('{{%menu_link}}', ['like', 'id', 'comment']);
    }
}