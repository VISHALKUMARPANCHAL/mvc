<?php
class Core_Model_Resource_Abstract
{

    protected $_tableName;
    protected $_primaryKey;
    public function __construct()
    {
        $this->_construct();
    }
    public function init($tableName, $primaryKey)
    {
        $this->_tableName = $tableName;
        $this->_primaryKey = $primaryKey;
    }
    public function getTableName()
    {
        return  $this->_tableName;
    }
    protected function _construct()
    {
        return $this;
    }
    public function getAdapter()
    {
        return new Core_Model_DB_Adapter();
    }
    public function load($value)
    {
        $sql = "SELECT * FROM {$this->_tableName} WHERE {$this->_primaryKey}={$value} LIMIT 1";
        return $this->getAdapter()->fetchRow($sql);
        // echo "<pre>";
        // print_r($data);
    }
    public function save($model)
    {
        $data = $model->getData();
        // echo '<pre>';
        // print_r($data);
        // die;     
        $primaryId = 0;
        if (isset($data[$this->_primaryKey]) &&  $data[$this->_primaryKey]) {
            $primaryId = $data[$this->_primaryKey];
        }
        if ($primaryId) {
            $columns = [];
            unset($data[$this->_primaryKey]);
            foreach ($data as $key => $value) {
                $value = ($value !== null) ? $value : '';
                $columns[] = sprintf("`%s` = '%s'", $key, addslashes($value));
            }
            $sql = sprintf(
                "UPDATE %s SET %s WHERE %s = %d",
                $this->_tableName,
                implode(',', $columns),
                $this->_primaryKey,
                $primaryId
            );
            // echo $sql;
            return $this->getAdapter()->query($sql);
        } else {
            $columns = implode('`,`', array_keys($data));
            $values = implode("','", array_values($data));
            $sql = sprintf("INSERT INTO %s(`%s`) VALUES ('%s')", $this->_tableName, $columns, $values);
            // echo $sql;
            $id = $this->getAdapter()->insert($sql);
            // echo $id;
            $model->load($id);

            // echo "Insert";
        }
        // echo get_class($model);
    }
    public function delete($model)
    {
        $id = $model->getData();
        if (isset($id)) {
            $sql = sprintf("DELETE FROM %s WHERE %s = %s", $this->_tableName, $this->_primaryKey, $id);
            $this->getAdapter()->query($sql);
            $model->setData(null);
        }
    }
}
