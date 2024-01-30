NAME = camagru

CLEAN_IMAGES	= --rmi all
CLEAN_ORPHANS	= --remove-orphans
CLEAN_VOLUMES	= --volumes

all:
	cd ./app && npm install && \
	npx --package typescript tsc && \
	npx tailwindcss -i ./static/styles.css -o ./static/global.css
	docker compose up --build -d

dev:
	cd ./app && npm install && \
	npx --package typescript tsc && \
	npx tailwindcss -i ./view/css/styles.css -o ./view/css/global.css
	docker compose --profile development -f compose.yml -f compose.dev.yml up --build -d

start:
	docker compose start

down:
	docker compose down

stop:
	docker compose stop

restart:
	docker compose restart

clear:
	docker compose down $(CLEAN_VOLUMES)

clean:
	docker compose down $(CLEAN_IMAGES) $(CLEAN_VOLUMES)

fclean:
	docker compose down $(CLEAN_IMAGES) $(CLEAN_ORPHANS) $(CLEAN_VOLUMES)

re:	fclean all

.PHONY:	all clean fclean re down restart stop start restart
