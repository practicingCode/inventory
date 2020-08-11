from bot import telegram_chatbot
import datetime
import mysql.connector
import time


mydb = mysql.connector.connect(
  host="localhost",
  user="phpmyadmin",
  password="P@ssword1",
  database="inventory"
)

cursor = mydb.cursor()

bot = telegram_chatbot("config.cfg")

def send_jabez(msg):
    mess = "Hi Jabez, "
    msg = mess+msg
    bot.send_message(msg, 680937605)


def blast(msg):
    send_jabez(msg)

def check_warranty_day(today):
    #1) 7 days from today
    query = 'SELECT * FROM entries WHERE alert_warranty >= DATE(NOW()) - INTERVAL 7 DAY'
    
    cursor.execute(query)
    res = cursor.fetchall()

    message = "Your warranty will end in 7 days!"
    if res == []:
        message = ""
    else:
        #compare with existing tags
        for r in res:
            item = r[4]
            time_in = r[8]
            docs = r[9]
            aw = str(r[10])
            aec = str(r[11])
            qty = str(r[12])

            #formating timestamp
            ti = str(time_in)
        
            #getting %
            original_diff = date_diff(ti, aec)
            present_diff = date_diff(ti, str(today))

            
            percent = present_diff/original_diff
            percentage = str(100 - (100*percent))


            message += """
                item: {0}
                docs: {1} 
                 you need to be on the local network
                warranty date: {2}
                useful life remaining: {3}%
            """.format(item, docs, aw, percentage)
            
        # return message
        blast(message)

def check_expiry_day(today):
    #1) 7 days from today
    query = 'SELECT * FROM entries WHERE alert_est_consumption >= DATE(NOW()) - INTERVAL 7 DAY'
    
    cursor.execute(query)
    res = cursor.fetchall()

    message = "You item is nearly out of stock in 7 days"
    if res == []:
        message = ""
    else:
        #compare with existing tags
        for r in res:
            item = r[4]
            time_in = r[8]
            docs = r[9]
            aw = str(r[10])
            aec = str(r[11])
            qty = r[12]

            #formating timestamp
            
            ti = str(time_in)
        
            #getting %
            original_diff = date_diff(ti, aec)
            present_diff = date_diff(ti, str(today))

            
            percent = present_diff/original_diff
            qty_total = str(r[12])
            qty_left = str(qty*percent)


            message += """
                item: {0}
                docs: {1} 
                 you need to be on the local network
                estimate expiry: {2}
                quantity: {3} of {4} remaining
            """.format(item, docs, aec, qty_left, qty_total)
            
        # return message
        blast(message)

def warranty_exceed_90(today):
    #2) 90% used
    
    query = 'SELECT * FROM entries WHERE alert_warranty >= time_in AND (DATEDIFF(CURDATE(),time_in)/DATEDIFF(alert_warranty, time_in)) > 0.9;'
    
    cursor.execute(query)
    res = cursor.fetchall()

    message = "Your warranty has exceeded the 90% mark"
    if res == []:
        message = ""
    else:
        #compare with existing tags
        for r in res:
            item = r[4]
            time_in = r[8]
            docs = r[9]
            aw = str(r[10])
            aec = str(r[11])
            qty = str(r[12])

            percentage = "90"

            message += """
                item: {0}
                docs: {1} 
                 you need to be on the local network
                warranty date: {2}
                warranty used: {3}%
            """.format(item, docs, aw, percentage)
            
        # return message
        blast(message)

def expiry_exceed_90(today):
    #2) 90% used
    
    query = 'SELECT * FROM entries WHERE alert_est_consumption >= time_in AND (DATEDIFF(CURDATE(),time_in)/DATEDIFF(alert_est_consumption, time_in)) > 0.9;'
    
    cursor.execute(query)
    res = cursor.fetchall()

    message = "Your consumption has exceeded the 90% mark"
    if res == []:
        message = ""
    else:
        #compare with existing tags
        for r in res:
            item = r[4]
            time_in = r[8]
            docs = r[9]
            aw = str(r[10])
            aec = str(r[11])
            

            percentage = "90"

            qty_left = str(r[12]*0.9)
            qty_total = str(r[12])

            message += """
                item: {0}
                docs: {1} 
                 you need to be on the local network
                expiry date: {2}
                percentage: {3}%
                usage: {4} of {5}
            """.format(item, docs, aec, percentage, qty_left, qty_total)
            
        # return message
        blast(message)


def date_diff(date1, date2):
    if(len(date1) > 10):
        d1 = datetime.datetime.strptime(date1, "%Y-%m-%d %H:%M:%S")
        d2 = datetime.datetime.strptime(date2, "%Y-%m-%d")
    else:
        d1 = datetime.datetime.strptime(date1, "%Y-%m-%d")
        d2 = datetime.datetime.strptime(date2, "%Y-%m-%d")
    return abs((d2 - d1).days)

def check_mail(today):
    #1) 7 days from today
   check_warranty_day(today)
   check_expiry_day(today)

   
    #2) consumption passed 90%
   warranty_exceed_90(today)
   expiry_exceed_90(today)
   
    

today = datetime.date.today()
check_mail(today)  
# a = date_diff("2020-07-11", "2020-08-13")
# print(a)
# while True:
#     today = datetime.date.today()
#     check_mail(today)

# while True:
  
        