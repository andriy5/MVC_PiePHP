<?php

class ArticleModel extends Entity 
{
  public $relations = [
    "has many" => [["table" => "comments", "key" => "article_id"]],
    "has one" => [["table_ref" => "users" , "table" => "articles", "key" => "user_id"]],
    "many to many" => [["name" => "tags", "table" => "articles_tags", "key1" => "article_id", "key2" => "tag_id"]]
  ];
  // public $relations = null;

  
}