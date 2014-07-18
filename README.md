ahab
====

CLI tool to help manage dev environnements with docker


```
Available commands:
  build   Builds the container
  enter   Enters the container
  help    Displays help for a command
  kill    Kills the container
  list    Lists commands
  run     Run the container
  up      Builds and run the container
```



Example of a config file : 


~/.ahab/config/aperophp
```
build:
  name: agallou/aperophp
  dockerfile_dir: /home/agallou/Projets/docker-aperophp
run:
  name: agallou/aperophp
  ports:
    - 9797:80
  volumes:
    - /home/agallou/Projets/aperophp:/var/www
    - %data_dir%/mysql:/var/lib/mysql
```
