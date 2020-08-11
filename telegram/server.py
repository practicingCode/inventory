from bot import telegram_chatbot
import datetime
import time


bot = telegram_chatbot("config.cfg")

#create event
name = ""
date = ""
time = ""
location = ""
description = "" 

update_id = None


def send_jabez(msg):
  bot.send_message(msg, 680937605)

while True:
  updates = bot.get_updates(offset=update_id)
  updates = updates["result"]
  if updates:
    for item in updates:
      print(item)
      #get JSON from Telegram, store local var
      update_id = item["update_id"]
      chat_id = item["message"]["chat"]["id"]

      if chat_id != 680937605:
        pass
      else:
        res("yes?")

      username = item["message"]["chat"]["first_name"]
      
      if username == None:
        username = item["message"]["chat"]["username"]
      try:
          message = str(item["message"]["text"])
          print(message)
          
          
          
          print("____________________")
          print("Message: ")
          print("--------------------------")
          print (update_id)
          print (chat_id)
          print (username)
          print (message)
          print("--------------------------")
      except:
        bot.get_two()
        print("message sent was not text")


        