import requests
import sys

url = input("Does this website use Cloudflare? Let's find out...Enter a website URL :-)")

try:
    r  = requests.get(url)
except:
    print("Domain does not exist")
    sys.exit()

response_code = r.status_code
if(response_code == 200):
    
    server = r.headers['server']

    if(server == "cloudflare"):
        print("This website uses CloudFlare!")
    else:
        print("Sorry, this website doesn't use CloudFlare :-(")
else:
    print("Response code is " + str(response_code))

