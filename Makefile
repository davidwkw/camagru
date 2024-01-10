NAME = camagru

CLEAN_IMAGES	= --rmi all
CLEAN_ORPHANS	= --remove-orphans
CLEAN_VOLUMES	= --volumes

NODE_DIR = node_modules

all:
	cd ./src && npm install package.json
	cd ./src && npm install -D typescript && npx tsc
	cd ./src && npm install -D tailwindcss && npx tailwindcss init && npx tailwindcss -i ./view/css/input.css -o ./view/css/input.css
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
