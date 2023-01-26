<?php
namespace App;

class Star extends Model
{
  public static function setCountForOfferAndUser($offer_id, $user_id, $count)
  {
    $table_name = static::tableName();
    $statement = \Flight::db()->prepare("INSERT INTO $table_name (offer_id, user_id, `count`) VALUES (:offer_id, :user_id, $count)");
    $statement->execute(compact('offer_id', 'user_id'));
  }

  public static function getCountsForOffer($offer_id)
  {
    $table_name = static::tableName();
    $statement = \Flight::db()->prepare("SELECT `count` FROM $table_name WHERE offer_id = ?");
    $statement->execute([$offer_id]);
    return $statement->fetchAll(\PDO::FETCH_COLUMN);
  }
  
  public static function getTotalCountForOffer($offer_id)
  {
    $table_name = static::tableName();
    $statement = \Flight::db()->prepare("SELECT sum(`count`) FROM $table_name WHERE offer_id = ?");
    $statement->execute([$offer_id]);
    return $statement->fetchColumn();
  }
}
