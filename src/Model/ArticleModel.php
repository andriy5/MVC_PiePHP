<?php

class ArticleModel extends Entity 
{
  public $relations = [
    "has many" => [["table" => "comments", "key" => "article_id"]],
    "has one" => [["table_ref" => "users" , "table" => "articles", "key" => "user_id"]],
    "many to many" => []
  ];
  // public $relations = null;

  
}