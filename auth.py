import smtplib
import os
from sys import argv 
  
s = smtplib.SMTP('smtp.gmail.com', 587) 
   
s.starttls() 
   
s.login("gyapak.seas@gmail.com", "Gyapak.seas@789$1") 
   
message = argv[2]
   
s.sendmail("gyapak.seas@gmail.com", argv[1], message) 
   
s.quit()