<?php

use yii\db\Migration;

/**
 * Class m241219_071942_create_book_publisher_table
 */
class m241219_071942_create_book_publisher_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('book_publisher', [
            'book_id' => $this->integer()->notNull(),
            'publisher_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        // Внешние ключи
        $this->addForeignKey(
            'fk_book_publisher_book_id',
            'book_publisher',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_book_publisher_publisher_id',
            'book_publisher',
            'publisher_id',
            'publisher',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_book_publisher_book_id', 'book_publisher');
        $this->dropForeignKey('fk_book_publisher_publisher_id', 'book_publisher');
        $this->dropTable('book_publisher');
    }
}
