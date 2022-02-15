import requests

url = "http://158.39.188.203/steg1/Reg2.php"

headers_dict = {
    "Cookie": "PHPSESSID=qu62hcibo5ujutkso6j2eogcri"
    }
 
data= {
"navn": "bobd",
"etternavn": "bobsen",
"e_post": "bobErEnFyr5@gmail.com",
"passord": "123456",
"Bpassord":	"123456",
"studiekull": "2",
"studieretning_id":	"1", 
"submit":	""
}

# Det er samme request cookie som på siden hele tiden 
request_cookie = {"PHPSESSID": "qu62hcibo5ujutkso6j2eogcri"}

with requests.session() as session:
    r1 = session.get(url)
    r2 = session.post(url, data=data, headers=headers_dict)
 

#r2 = requests.post('http://158.39.188.203/steg1/Reg2.php',cookies=request_cookie)

print(r1.status_code)
print(r2.is_redirect)
print(dir(r2.cookies))
print(r2.cookies.extract_cookies)