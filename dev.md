#### default

    cd /var/www/home-www/yusam/github/yusam-hub/project-0001/client-auth-sdk
    
    composer update
    sh phpunit

#### dockers

    docker exec -it yusam-php81 bash
    docker exec -it yusam-php81 sh -c "htop"

    docker exec -it yusam-php81 sh -c "cd /var/www/data/yusam/github/yusam-hub/project-0001/client-auth-sdk && composer update"
    docker exec -it yusam-php81 sh -c "cd /var/www/data/yusam/github/yusam-hub/project-0001/client-auth-sdk && sh phpunit"

#### curl

    docker exec -it yusam-php81 sh -c "curl -vvv -X GET http://192.168.0.110:10001/api/front/app/list"
    curl -vvv -X 'GET' \
    'http://192.168.0.110:10001/api/front/app/list' \
    -H 'accept: application/json' \
    -H 'X-User-Token: eyJ1aWQiOjIsInR5cCI6IkpXVCIsImFsZyI6IlJTMjU2In0.eyJ1aWQiOjIsImlhdCI6MTY5MTE1MjQyMSwiZXhwIjoxNjkxMTU2MDgxLCJoYiI6ImQ0MWQ4Y2Q5OGYwMGIyMDRlOTgwMDk5OGVjZjg0MjdlIn0.b3K_AMO2Hhh2S3bCnPuTAl1AfMR4YVVDm55qfbcEzWUHcM0tktyzZ1QWiuUv6krywfKkvHq2qu7YWdh7nh2UHViqqjFnn2dpNxcjlNftjtq2ZcKbpJbefGQQM7LnzU6axuaXsKqFfGk3D8VklxKvq62x3Lc6HlLgfBy3nsMNsmg'
