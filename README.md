# NSI HOMEWORKS

**simple html/css/php/mysql website devellop for my school homework.
It's probably fully vulnerable if you wan't to play with him x)))
I do it in 2 weeks.**

## applications ports
	- administrator credentials : sylvain.durif@cat.com:v3ryS3cr3t@dm1nP4ssw0rd
	- apache server : http://localhost:8001
	- phpmyadmin : http://localhost:8002
if you want to connect manually to the database you can execute this command :
```docker exec -it nsi_sql mysql -uroot -proot```

## how to launch the docker

*You must have docker and docker-compose installed*

### Linux

```sh
git clone http://githubrepo
cd mediatheque_website
docker-compose -f docker-compose.yml up -d
```

### Windows 

TODO.

## todo

*check security issues
correct some bugs
(but i'm too tired to do that, was just a homework about mysql at the beginning)*