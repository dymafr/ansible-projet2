<?php
$articles = json_decode(file_get_contents('/var/www/app/data/articles.json'), true);

$dns = 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME');
$user = getenv('DB_USER');
$pwd = getenv('DB_PASSWORD');

$pdo = new PDO($dns, $user, $pwd);

$statements = [
	'CREATE TABLE blog.article( 
        id   INT NOT NULL AUTO_INCREMENT,
        title  VARCHAR(255) NOT NULL, 
        image  VARCHAR(255) NOT NULL, 
        content LONGTEXT NOT NULL, 
        category   VARCHAR(45) NOT NULL,
        PRIMARY KEY(id)
    );',
	];


foreach ($statements as $statement) {
	$pdo->exec($statement);
}


$statement = $pdo->prepare('
  INSERT INTO article (
    title,
    category,
    content,
    image
  ) VALUES (
    :title,
    :category,
    :content,
    :image
)');

foreach ($articles as $article) {
  $statement->bindValue(':title', $article['title']);
  $statement->bindValue(':category', $article['category']);
  $statement->bindValue(':content', $article['content']);
  $statement->bindValue(':image', $article['image']);
  $statement->execute();
}


