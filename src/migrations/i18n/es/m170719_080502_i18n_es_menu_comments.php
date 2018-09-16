<?php

/**
 * @package   Yii2-Comment
 * @author    José Peña <joepa37@gmail.com>
 * @link https://plus.google.com/+joepa37/
 * @copyright Copyright (c) 2018 José Peña
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version   1.0.0
 */

class m170719_080502_i18n_es_menu_comments extends yii\db\Migration
{
	public function up()
	{
		$this->insert('{{%menu_link_lang}}', ['link_id' => 'comment', 'label' => 'Comentarios', 'language' => 'es-ES']);
	}
}