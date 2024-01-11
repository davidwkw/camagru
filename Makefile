NAME = camagru

CLEAN_IMAGES	= --rmi all
CLEAN_ORPHANS	= --remove-orphans
CLEAN_VOLUMES	= --volumes

all:
	cd ./src && npm install && \
	npx --package typescript tsc && \
	npx tailwindcss -i ./view/css/styles.css -o ./view/css/global.css
	docker compose up --build -d

start:
	docker compose start -d

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
