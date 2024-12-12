<?php

namespace php2\classes\converter;

use php2\classes\exception\FormatFileException;
use php2\classes\exception\SourceFileException;
use RuntimeException;
use SplFileObject;

class CsvConverter
{
    private string $inputFilePath;
    private string $outputFilePath;
    private array $columns;

    private array $data = [];
    private SplFileObject $fileObject;

    public function __construct(string $inputFilePath, string $outputFilePath, array $columns)
    {
        $this->inputFilePath = $inputFilePath;
        $this->outputFilePath = $outputFilePath;
        $this->columns = $columns;
    }

    public function convert()
    {
        if (!$this->validateColumns($this->columns)) {
            throw new FormatFileException("Заданы неверные заголовки столбцов");
        }

        if (!file_exists($this->inputFilePath)) {
            throw new SourceFileException("Файл не существует");
        }

        $this->fileObject = new SplFileObject($this->inputFilePath, 'r');
        $this->fileObject->setFlags(SplFileObject::READ_CSV);
        if (!$this->fileObject) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }

        $headerData = $this->getHeaderData();
        if ($headerData !== $this->columns) {
            throw new FormatFileException("Исходный файл не содержит необходимых столбцов");
        }

        while ($line = $this->getNextLine()) {
            $this->data[] = $line;
        }

        $sql = $this->convertToSql($this->data, $headerData);

        try {
            $sqlFile = new SplFileObject($this->outputFilePath, 'w');
            $sqlFile->fwrite($sql);
        } catch (RuntimeException $e) {
            throw new RuntimeException("Не удалось записать в файл: {$this->outputFilePath}. Ошибка: {$e->getMessage()}");
        }
    }

    public function getData(): array
    {
        return $this->data;
    }

    private function getHeaderData()
    {
        $this->fileObject->rewind();
        $data = $this->fileObject->fgetcsv();

        $data[0] = preg_replace('/^\xEF\xBB\xBF/', '', $data[0]);
        return $data;
    }

    private function getNextLine()
    {
        $result = null;

        if (!$this->fileObject->eof()) {
            $result = $this->fileObject->fgetcsv();
        }

        return $result;
    }

    private function validateColumns(array $columns): bool
    {
        $result = true;

        if (count($columns)) {
            foreach ($columns as $column) {
                if (!is_string($column)) {
                    $result = false;
                }
            }
        } else {
            $result = false;
        }

        return $result;
    }

    private function convertToSql(array $data, array $headerData): string
    {
        $columns = implode(', ', $headerData);
        $result = "INSERT INTO {$this->fileObject->getFilename()} ($columns) VALUES ";

        $valuesArray = array_map(
            fn($line) => '(' . implode(', ', array_map(fn($item) => "'$item'", $line)) . ')',
            $data
        );
        $result .= implode(', ', $valuesArray) . ";";
        return $result;
    }
}
