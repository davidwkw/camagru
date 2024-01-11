CREATE TABLE "users" (
  "user_id" uuid PRIMARY KEY,
  "username" varchar(256) UNIQUE NOT NULL,
  "email" varchar(256) UNIQUE NOT NULL,
  "password" varchar(256) NOT NULL,
  "profile_picture" bytea,
  "registered" bool DEFAULT false,
  "registered_on" timestamp
);

CREATE TABLE "posts" (
  "post_id" uuid PRIMARY KEY,
  "user_id" uuid,
  "post" bytea,
  "caption" varchar(512),
  "created_at" timestamp DEFAULT (now())
);

CREATE TABLE "likes" (
  "likes_id" uuid PRIMARY KEY,
  "user_id" uuid UNIQUE,
  "post_id" uuid UNIQUE
);

CREATE TABLE "comments" (
  "comment_id" uuid PRIMARY KEY,
  "user_id" uuid,
  "post_id" uuid,
  "comment" varchar(512),
  "created_at" timestamp DEFAULT (now())
);

CREATE TABLE "sessions" (
  "user_id" uuid,
  "session_id" uuid PRIMARY KEY,
  "created_at" timestamp DEFAULT (now())
);

CREATE TABLE "password_resets" (
  "user_id" uuid,
  "password_id" uuid PRIMARY KEY,
  "created_at" timestamp NOT NULL DEFAULT (now())
);

CREATE TABLE "registrations" (
  "user_id" uuid,
  "registration_id" uuid PRIMARY KEY,
  "created_at" timestamp NOT NULL DEFAULT (now())
);

ALTER TABLE "posts" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "sessions" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "registrations" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "password_resets" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "likes" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "comments" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "likes" ADD FOREIGN KEY ("post_id") REFERENCES "posts" ("post_id") ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "comments" ADD FOREIGN KEY ("post_id") REFERENCES "posts" ("post_id") ON DELETE CASCADE ON UPDATE CASCADE;
