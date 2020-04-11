<?php

class UserModel extends Entity 
{
  public $relations = [
    "has many" => [["table" => "articles", "key" => "user_id"], ["table" => "comments", "key" => "user_id"]],
    "has one" => [],
    "many to many" => []
  ];

  
}