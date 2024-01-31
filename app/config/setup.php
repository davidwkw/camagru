<?php

declare(strict_types=1);

require 'database.php';

use Camagru\PGSQLDB;

$db = new PGSQLDB(getenv('DB_HOST'), getenv('DB_PORT'), getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASSWORD'));
$dbConnection = $db->getDbConnection();

$createUsersTablequery = <<<EOT
CREATE TABLE "users" (
    "user_id" uuid PRIMARY KEY,
    "username" varchar(256) UNIQUE NOT NULL,
    "email" varchar(256) UNIQUE NOT NULL,
    "password" varchar(256) NOT NULL,
    "profile_picture" bytea,
    "registered" bool DEFAULT false,
    "registered_on" timestamp
);
EOT;

$createPostsTablequery = <<<EOT
CREATE TABLE "posts" (
    "post_id" uuid PRIMARY KEY,
    "user_id" uuid,
    "post" bytea,
    "caption" varchar(512),
    "created_at" timestamp DEFAULT (now())
);
EOT;

$createLikesTablequery = <<<EOT
CREATE TABLE "likes" (
    "likes_id" uuid PRIMARY KEY,
    "user_id" uuid UNIQUE,
    "post_id" uuid UNIQUE
);
EOT;

$createCommentsTablequery = <<<EOT
CREATE TABLE "comments" (
    "comment_id" uuid PRIMARY KEY,
    "user_id" uuid,
    "post_id" uuid,
    "comment" varchar(512),
    "created_at" timestamp DEFAULT (now())
);
EOT;

$createSessionsTablequery = <<<EOT
CREATE TABLE "sessions" (
    "user_id" uuid,
    "session_id" uuid PRIMARY KEY,
    "created_at" timestamp DEFAULT (now())
);
EOT;

$createPasswordResetsTablequery = <<<EOT
CREATE TABLE "password_resets" (
    "user_id" uuid,
    "password_id" uuid PRIMARY KEY,
    "created_at" timestamp NOT NULL DEFAULT (now())
);
EOT;

$createRegistrationsTablequery = <<<EOT
CREATE TABLE "registrations" (
    "user_id" uuid,
    "registration_id" uuid PRIMARY KEY,
    "created_at" timestamp NOT NULL DEFAULT (now())
);
EOT;

$queries = [
    $createUsersTablequery,
    $createPostsTablequery,
    $createLikesTablequery,
    $createCommentsTablequery,
    $createSessionsTablequery,
    $createPasswordResetsTablequery,
    $createRegistrationsTablequery
];

foreach ($queries as $query) {
    pg_query($dbConnection, $query);
}

$createUserPostsRelationshipQuery = <<<EOT
ALTER TABLE "posts" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;
EOT;

$createUserSessionsRelationshipQuery = <<<EOT
ALTER TABLE "sessions" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;
EOT;

$createUserRegistrationsRelationshipQuery = <<<EOT
ALTER TABLE "registrations" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;
EOT;

$createUserPasswordResetsRelationshipQuery = <<<EOT
ALTER TABLE "password_resets" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;
EOT;

$createUserLikesRelationshipQuery = <<<EOT
ALTER TABLE "likes" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;
EOT;

$createUserCommentsRelationshipQuery = <<<EOT
ALTER TABLE "comments" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;
EOT;

$createPostLikesRelationshipQuery = <<<EOT
ALTER TABLE "likes" ADD FOREIGN KEY ("post_id") REFERENCES "posts" ("post_id") ON DELETE CASCADE ON UPDATE CASCADE;
EOT;

$createPostCommentsRelationshipQuery = <<<EOT
ALTER TABLE "comments" ADD FOREIGN KEY ("post_id") REFERENCES "posts" ("post_id") ON DELETE CASCADE ON UPDATE CASCADE;
EOT;

$queries = [
    $createUserPostsRelationshipQuery,
    $createUserSessionsRelationshipQuery,
    $createUserRegistrationsRelationshipQuery,
    $createUserPasswordResetsRelationshipQuery,
    $createUserLikesRelationshipQuery,
    $createUserCommentsRelationshipQuery,
    $createPostLikesRelationshipQuery,
    $createPostCommentsRelationshipQuery
];

foreach ($queries as $query) {
    pg_query($dbConnection, $query);
}
