<?php

require_once APPLICATION_ROOT . '/core/Application.php';

/**
 * Class Storage
 */
class Storage
{
    /**
     * @var \PDO
     */
    protected $_pdo;

    /**
     * Storage constructor.
     */
    public function __construct()
    {
        $config = Application::getConfig();

        $this->_pdo = new PDO($config['db']['dsn'], $config['db']['username'], $config['db']['password'], [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }

    /**
     * @param $tableName
     * @param $data
     *
     * @return string
     */
    public function insert($tableName, $data)
    {
        $fieldNameList = [];
        $placeholderNameList = [];
        foreach ($data as $key => $value) {
            $fieldNameList[] = '`' . $key . '`';
            $placeholderNameList[] = ':' . $key;
        }

        $query = 'INSERT INTO `' . $tableName . '`('
            . implode(',', $fieldNameList)
            . ') VALUES('
            . implode(',', $placeholderNameList) . ')';
        $statement = $this->_pdo->prepare($query);

        foreach ($data as $key => $value) {
            $statement->bindValue(':' . $key, $value, PDO::PARAM_STR);
        }

        $statement->execute();

        return $this->_pdo->lastInsertId();
    }

    /**
     * @param $tableName
     * @param $id
     * @param $data
     */
    public function update($tableName, $id, $data)
    {
        $valueList = [];
        foreach ($data as $key => $value) {
            $valueList[] = '`' . $key . '` = :' . $key;
        }

        $query = 'UPDATE `' . $tableName . '` SET ' . implode(',', $valueList) . ' WHERE `' . $tableName . 'Id` = :id';
        $statement = $this->_pdo->prepare($query);

        foreach ($data as $key => $value) {
            $statement->bindValue(':' . $key, $value, PDO::PARAM_STR);
        }

        $statement->bindValue(':id', $id);

        $statement->execute();
    }

    /**
     * @param $q
     * @param $fromDate
     * @param $toDate
     *
     * @return array|null
     */
    public function select($q, $fromDate, $toDate)
    {
        $rowList = null;

        $statement = $this->_pdo->prepare(
            'SELECT * FROM `currency` WHERE `valuteId` = :q AND `date` BETWEEN :fromDate AND :toDate');

        $statement->bindValue(':q', $q);
        $statement->bindValue(':fromDate', date('Y-m-d', strtotime($fromDate)));
        $statement->bindValue(':toDate', date('Y-m-d', strtotime($toDate)));

        $statement->execute();

        $rowList = $statement->fetchAll();

        return $rowList;
    }

    /**
     * @param $tableName
     * @param $id
     */
    public function delete($tableName, $id)
    {
        $query = 'DELETE FROM `' . $tableName . '`  WHERE `' . $tableName . 'Id` = :id';

        $statement = $this->_pdo->prepare($query);

        $statement->bindValue(':id', $id);

        $statement->execute();
    }
}