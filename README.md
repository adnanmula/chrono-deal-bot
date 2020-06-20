# Chrono.gg daily deal notifier

Subscribe to https://telegram.me/chronoDealBot

```
/start
/subscribe
```

## Host it yourself with subscriptions.

Create an .env file and fill with the telegram bot token and database url.
```
cp .env .env.prod
```
Build and up the project.
```
make build
make up
```
Run the init command to create the database.
```
make init
```
Set up necessary cron jobs, only the getUpdates method is implemented for now, webhook might be added in the future.

```bash
# process subscriptions
00 * * * * docker-compose run php php bin/console chronogg:telegram:update
# notify current deal to subscribed users
00 18 * * * docker-compose run php php bin/console chronogg:deal:notify
```


## Host it just for you.
Clone release v1.0, use this if you want to host it just for you. Create an .env file and fill with the telegram bot token.
```
cp .env .env.prod
```
Build and up the project.
```
make build
make up
```
Set up the cron job to notify the deals.
```bash
# example in crontab
0 16 * * 1-5 docker-compose run php php bin/console c:d:n
```
