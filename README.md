# inventory

## STARTING UP
1) open a terminal and cd to the directory you want
2) git clone [ https://github.com/practicingCode/inventory.git ]

## Database
1) create a new database
2) set a password and user name in mysql
3) set a password and username in handler/auth.php
4) setup an account user name and password by filling in the auth table in the inventory

## Telegram
1) create a telegram bot and add it to telegram/config.cfg
2) command: 
     * python3 telegram/server.py
3) message your bot and see your user id
4) go into telegram/scheduler.py and add your user_id the same way as the send_jabez() function
5) test the function to see if the message is sent to self.
