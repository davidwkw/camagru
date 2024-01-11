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
  "user_id" uuid,
  "post_id" uuid
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
  "session_id" uuid NOT NULL DEFAULT (gen_random_uuid()),
  "created_at" timestamp DEFAULT (now())
);

CREATE TABLE "password_resets" (
  "user_id" uuid,
  "password_key" uuid NOT NULL DEFAULT (gen_random_uuid()),
  "created_at" timestamp NOT NULL DEFAULT (now())
);

CREATE TABLE "registrations" (
  "user_id" uuid,
  "registration_code" uuid NOT NULL DEFAULT (gen_random_uuid()),
  "created_at" timestamp NOT NULL DEFAULT (now())
);

ALTER TABLE "posts" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id");

ALTER TABLE "users" ADD FOREIGN KEY ("user_id") REFERENCES "sessions" ("user_id");

ALTER TABLE "likes" ADD FOREIGN KEY ("post_id") REFERENCES "posts" ("post_id");

ALTER TABLE "comments" ADD FOREIGN KEY ("post_id") REFERENCES "posts" ("post_id");

ALTER TABLE "likes" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id");

ALTER TABLE "comments" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id");

ALTER TABLE "password_resets" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id");

ALTER TABLE "registrations" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id");
