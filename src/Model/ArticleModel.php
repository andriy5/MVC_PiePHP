<?php

class ArticleModel extends Entity 
{
  public $relations = [
    "has many" => [["table" => "comments", "key" => "article_id"]],
    "has one" => [],
    "many to many" => []
  ];
  // public $relations = null;

  
}