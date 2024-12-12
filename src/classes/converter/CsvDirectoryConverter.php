<?php

namespace php2\classes\converter;

use DirectoryIterator;
use php2\classes\exception\SourceFileException;
use SplFileInfo;
use SplFileObject;

class CsvDirectoryConverter
{
    /**
     * @var SplFileInfo[]
     */
    protected array $filesToConvert = [];

    public function __construct(string $directory)
    {
        if (!is_dir($directory)) {
            throw new SourceFileException("Указанной директории не существует");
        }

        $this->loadCsvFile($directory);
    }

    public function convertFiles(string $outputDirectory)
    {
        $result = [];

        foreach ($this->filesToConvert as $file) {
            $result[] = $this->convertFile($file, $outputDirectory);
        }

        return $result;
    }

    public function convertFile(SplFileInfo $file, string $outputDirectory)
    {
        $fileObject = new SplFileObject($file->getRealPath());
        $fileObject->setFlags(SplFileObject::READ_CSV);

        $column = $fileObject->fgetcsv();
        $values = [];

        while (!$fileObject->eof()) {
            $values[] = $fileObject->fgetcsv();
        }

        $tableName = $file->getBasename('.csv');

        $sqlContent = $this->getSqlContent($tableName, $column, $values);
        return $this->saveSqlContent($tableName, $outputDirectory, $sqlContent);
    }

    protected function getSqlContent(string $tableName, array $columns, array $values): string
    {
        $columnsString = implode(', ', $columns);
        $sql = "INSERT INTO $tableName ($columnsString) VALUES ";

        foreach ($values as $row) {
            array_walk($row, function (&$value) {
                $value = addslashes($value);
                $value = "'$value'";
            });

            $sql .= "( " . implode(', ', $row) . " )" . ", ";
        }

        $sql = substr($sql, 0, -2);
        return $sql;
    }

    protected function saveSqlContent(string $tableName, string $directory, string $content): string
    {
        if (!is_dir($directory)) {
            throw new SourceFileException('Директория для выходных файлов не существует');
        }

        $fileName = $directory . DIRECTORY_SEPARATOR . $tableName . '.sql';
        // file_put_contents($fileName, $content);

        $file = new SplFileObject($fileName, 'w');
        $file->fwrite($content);
        $file = null;

        return $fileName;
    }

    public function getFiles()
    {
        var_dump($this->filesToConvert);
    }

    protected function loadCsvFile(string $directory)
    {
        foreach (new DirectoryIterator($directory) as $file) {
            if ($file->getExtension() == 'csv') {
                $this->filesToConvert[] = $file->getFileInfo();
            }
        }
    }
}
