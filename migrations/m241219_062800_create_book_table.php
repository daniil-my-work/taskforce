<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m241219_062800_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Заголовок книги'),
            'author' => $this->string(255)->notNull()->comment('Автор книги'),
            'published_year' => $this->integer()->notNull()->comment('Год издания книги'),
            'genre' => $this->string(100)->notNull()->comment('Жанр книги'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('book');
    }
}
