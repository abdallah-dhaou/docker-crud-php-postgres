#!/bin/bash

docker exec -it db_container  psql -U abdou mydb -c "
ALTER TABLE users 
RENAME COLUMN u_firs_name TO u_last_name;"