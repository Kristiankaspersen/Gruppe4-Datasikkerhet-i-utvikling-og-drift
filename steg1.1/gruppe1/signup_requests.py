import requests

url = "http://158.39.188.203/steg1/includes/signup.inc.php"


data = "navn=hei&etternavn=hei&e_post=hei4%40hei.com&passord=12&Bpassord=12&studiekull=2&studieretning_id=1&submit="

headers_dict = {
    "Content-Type": "application/x-www-form-urlencoded"
    }



# Det er samme request cookie som på siden hele tiden 
request_cookie = {"PHPSESSID": "qu62hcibo5ujutkso6j2eogcri"}

r = requests.post(url, data=data, headers=headers_dict, cookies=request_cookie)
 

#r2 = requests.post('http://158.39.188.203/steg1/Reg2.php',cookies=request_cookie)
print(r.headers)
print(r.is_redirect)