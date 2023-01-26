<?php
namespace App;
use Exception;

class Model
{
  // Class methods
  public static function find($id)
  {
    $table_name = static::tableName();
    $model = \Flight::db()->prepare("SELECT * FROM $table_name WHERE id = ?");
    if ($model->execute([$id]) === FALSE) throw new Exception("Record not found");
    return $model->fetchObject(get_called_class());
  }

  public static function findBy($attribute, $value)
  {
    $table_name = static::tableName();
    $statement = \Flight::db()->prepare("SELECT * FROM $table_name WHERE $attribute = ? LIMIT 1");
    if ($statement->execute([$value]) === FALSE) throw new Exception("Record not found");
    return $statement->fetchObject(get_called_class());
  }

  public static function findAll()
  {
    $table_name = static::tableName();
    return \Flight::db()->query("SELECT * FROM $table_name")->fetchAll(\PDO::FETCH_CLASS, get_called_class());
  }

  public static function findAllBy($attribute, $value)
  {
    $table_name = static::tableName();
    $statement = \Flight::db()->prepare("SELECT * FROM $table_name WHERE $attribute = ?");
    $statement->execute([$value]);
    return $statement->fetchAll(\PDO::FETCH_CLASS, get_called_class());
  }
  
  // Instance methods
  public function __construct($attributes = [])
  {
    foreach($attributes as $name => $value) {
      $this->$name = $value;
    }
  }
  
  public function save()
  {
    if (isset($this->id) && $this->id)
      return $this->update();
    else
      return $this->insert();
  }
  
  public static function destroy($id)
  {
    $table_name = static::tableName();
    $statement = \Flight::db()->prepare("DELETE FROM $table_name WHERE id = $id");
    if (!$statement->execute()) return false;
    return true;
  }
  
  // Internals
  protected static function tableName()
  {
    $class_name = strtolower(get_called_class());
    preg_match('/\\\\(.+?)$/', $class_name, $matches);
    return $matches[1];
  }
  
  protected function update()
  {
    $table_name = static::tableName();
    $attributes = get_object_vars($this);
    $attribute_names = array_keys($attributes);
    
    
    
    $statement = \Flight::db()->prepare("UPDATE $table_name SET ".join(',', array_map(function ($item) { return $item.' = :'.$item;}, $attribute_names))." WHERE id = :id");
    if (!$statement->execute($attributes)) return false;
    return $this;
  }

  protected function insert()
  {
    $table_name = static::tableName();
    $attributes = get_object_vars($this);
    $attribute_names = array_keys($attributes);
    
    $statement = \Flight::db()->prepare("INSERT INTO $table_name (".join(',', $attribute_names).") VALUES (".join(',', array_map(function ($item) { return ':'.$item;}, $attribute_names)).")");
    if (!$statement->execute($attributes)) return false;
    $this->id = \Flight::db()->lastInsertId();
    return $this;
  }

}
